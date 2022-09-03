<?php

namespace App\Http\Controllers;

use App\Notifications\Add_service;
use App\sections;
use App\services;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $sections = sections::all();
        $services = services::all();
        $sections2 = DB::table('sections')->whereNotNull('parent_id')->get();
        return view('services.services', compact('sections', 'services', 'sections2'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        services::create([
            'name' => $request->name,
            'section_id' => $request->section_id,
            'description' => $request->description,
            'service_provider_id' =>auth()->user()->id,    
            'status' => 'معلقة',
            'Value_status' => 2,
        ]);
        $user = User::get();  
        $services=services::latest()->first();
        Notification::send($user, new Add_service($services));

        session()->flash('Add', 'تم اضافة الخدمة بنجاح ');
        return redirect('/services');
    }

    /**
     * Display the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $services = services::where('id',$id)->first();
        return view('services.details_service',compact('services'));  
    }
    /**
     * Show the form for editing the specified resource.
     *
     
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }
    public function update(Request $request)
    {
        $sectionId = $request->section_id;
        $service = services::findOrFail($request->service_id);
        $service->update([
            'name' => $request->service_name,
            'description' => $request->description,
            'section_id' =>  $sectionId,
        ]);

        session()->flash('Edit', 'تم تعديل الخدمة بنجاح');
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
    
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $service = services::findOrFail($request->service_id);
        $service->delete();
        session()->flash('delete', 'تم حذف الخدمة بنجاح');
        return back();
    }
    public function getServicesSubSections($id)
    {
        $sections = DB::table('sections')->whereNotNull('parent_id')->get();        
        $ServicesSubSections = services::with('section')->where('section_id', $id)->get();
       return view('sections.ServicesSubSections', compact('ServicesSubSections', 'sections'));
    }
    public function getServicesDetails($id)
    {
       
    $services = services::where('section_id', $id)->first();
    return view('services.ServiceDetails',compact('services'));
    }

    public function MarkAsReadAll ()
    {
        $userUnreadNotification= auth()->user()->unreadNotifications;
        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }


    }
}
