<?php

namespace App\Http\Controllers\Participant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param bool $studentStatus
     * @return \Illuminate\Http\Response
     */
    public function create($studentStatus = false)
    {
        $currentStudent = $immigrantStudent = $registerOnly = "false";
        if($studentStatus == 'current-student') {
            $currentStudent = "true";
        } else if($studentStatus == 'immigrant-former-student') {
            $immigrantStudent = "true";
        }

        if(Input::get('registeronly')) {
            $registerOnly = "true";
        }

        return view('frontend.participants.create', compact('currentStudent', 'immigrantStudent', 'registerOnly'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
