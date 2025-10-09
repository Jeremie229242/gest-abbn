<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware(["auth", "auth.admin"]);
    }
    public function index()
    {
        $emails = Email::all();
        return view('Admin.e-mails.index', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.e-mails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([ 'user_id'=> auth()->id()]);
        Email::create($request->all());

        return redirect()->route('Admin.e-mails.index')->with('success', 'Email ajoute avec succes');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Email  $mail
     * @return \Illuminate\Http\Response
     */
    public function show(Email $site)
    {
        return view('Admin.e-mails.show', compact('site'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\email  $email
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mail = Email::findOrFail($id);

        return view('Admin.e-mails.edit', compact('mail'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\email  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mail = Email::findOrFail($id);
        $request->merge([ 'user_id'=> auth()->id()]);


        $mail->update($request->all());

        return redirect()->route('Admin.e-mails.index')->with('success', 'Mail modifié avec succes');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(email $email)
    {
        //
    }
}
