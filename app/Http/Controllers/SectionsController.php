<?php

namespace App\Http\Controllers;

use App\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=sections::where('parent_id',null)->get();
        return view('sections.sections',compact('sections'));
        return view('include.footer',compact('sections'));
       
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
        $validated = $request->validate([
            'name' => 'required|unique:sections|max:255',
            'description' => 'required',
        ], [
            'name.required' => 'يرجى إدخال اسم القسم',
            'name.unique' => 'الاسم موجود مسبقا',
            'description.required' => 'يرجى إدخال الوصف ',
        ]);
            sections ::create([
                'name' => $request->name,
                'description' => $request->description,
                'parent_id' => $request->parent_id,
                'created_by' => (Auth::user()->name),
            ]);
       
        
        session()->flash('Add', 'تم إضافة القسم بنجاح');      
        return redirect('/sections');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'name' => 'required|max:255|unique:sections,name,'.$id,
            'description' => 'required',
        ],[

            'name.required' =>'يرجي ادخال اسم القسم',
            'name.unique' =>'اسم القسم مسجل مسبقا',
            'description.required' =>'يرجي ادخال البيان',

        ]);

        $sections = sections::find($id);
        $sections->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        session()->flash('edit','تم تعديل القسم بنجاج');
        return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $id = $request->id;
      sections::find($id)->delete();
       session()->flash('delete','تم حذف القسم بنجاح');
       return redirect('/sections');
    }
    

    public function getSubSections($id)
    {
        $sections=sections::All();
        $sections2=sections::where('parent_id',null)->get();
        $subsections=DB::table('sections')->where('parent_id',$id)->get();
        return view('sections.subsections',compact('subsections','sections','sections2'));
    }
    public function index2()
    {
        $sections=sections::where('parent_id',null)->get();
        return view('include.footer',compact('sections'));
    }
    
    
}
