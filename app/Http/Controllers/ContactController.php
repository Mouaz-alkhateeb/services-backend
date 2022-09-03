<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Notifications\Add_message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $contacts=contact::all();
       return view('contacts.messagesBox',compact('contacts'));
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
        Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'title'=>$request->title,
            'content'=>$request->content,
        ]);
        $user = User::get();  
        $contacts=contact::latest()->first();
        Notification::send($user, new Add_message($contacts));
        return back();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        $contacts= Contact::where('id',$id)->first();
        return view('contacts.message_details',compact('contacts'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $Contacts = Contact::findOrFail($request->id);
        $Contacts->delete();
        session()->flash('delete');
        return redirect('/messagesBox');
       
    }
}
