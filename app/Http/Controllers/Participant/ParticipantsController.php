<?php

namespace App\Http\Controllers\Participant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use Validator;

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
        if ($studentStatus == 'current-student') {
            $currentStudent = "true";
        } else if ($studentStatus == 'immigrant-former-student') {
            $immigrantStudent = "true";
        }

        if (Input::get('registeronly')) {
            $registerOnly = "true";
        }

        return view('frontend.participants.create', compact('currentStudent', 'immigrantStudent', 'registerOnly'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($validation = $this->customRules($request)) {
            return $validation;
        }

        try {

        } catch (\Exception $e) {
            return response()->json(['error' => "Server Error!"], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function customRules($request)
    {
//        participantData: {
//        title: "Mr.",
//        name: "",
//        year_of_birth: -1,
//        admission_year: -1,
//        class: -1,
//        group: -1,
//        subject: "",
//        address: "",
//        city: "",
//        state: "",
//        country: -1,
//        zip_code: "",
//        mobile_no: "",
//        email: "",
//        occupation: -1,
//        occupation_details: {
//            designation: "",
//          department: "",
//          company_name: "",
//          occupation_name: ""
//        },
//      },
        $rules = [
            'title' => 'required',
            'name' => 'required',
            'year_of_birth' => ['required', 'numeric', Rule::notIn(["-1"])],
            'admission_year' => ['required', 'numeric', Rule::notIn(["-1"])],
            'class' => ['required', Rule::notIn(["-1"])],
            'group' => ['required', Rule::notIn(["-1"])],
        ];
        $customMessages = [
            'required' => 'The :attribute field can not be blank.',
            'numeric' => 'The :attribute field must be numeric.'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 500);
        }
    }
}
