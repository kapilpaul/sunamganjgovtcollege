<?php

namespace App\Http\Controllers\Participant;

use App\Models\Participant\Guest;
use App\Models\Participant\Participants;
use Milon\Barcode\DNS1D;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Validator;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\QueryException;
use PDOException;
use Illuminate\Session\TokenMismatchException;

class ParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $studentStatus
     * @return \Illuminate\Http\Response
     */
    public function index($studentStatus = "all")
    {
        $perPage = 100;

        if ($studentStatus == 'current-students') {
            $participants = Participants::where('current_student', 1)->where('outside_of_bd', 0)->paginate($perPage);
        } else if ($studentStatus == 'nrb-former-students') {
            $participants = Participants::where('current_student', 0)->where('outside_of_bd', 1)->paginate($perPage);
        } else if ($studentStatus == 'former-students') {
            $participants = Participants::where('current_student', 0)->where('outside_of_bd', 0)->paginate($perPage);
        } else {
            $participants = Participants::paginate($perPage);
        }

        return view('admin.participants.index', compact('participants'));
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
        } else if ($studentStatus == 'nrb-former-student') {
            $immigrantStudent = "true";
        } else if ($studentStatus == 'former-student') {
        } else {
            abort(404);
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
            $input = $request->all();
            $input['uid'] = Str::uuid();
            $imagename = $this->storeImage($request->image, $input['uid']);

            $input['image'] = Storage::url('public/images/' . $imagename);
            $input['occupation_details'] = json_encode($request->occupation_details);

            if ($participant = Participants::create($input)) {
                if (count($request->guests)) {
                    foreach ($request->guests as $guest) {
                        $guest['participant_id'] = $participant->id;
                        Guest::create($guest);
                    }
                }
                return response()->json(['participant' => $participant], 200);
            }

            return response()->json(['errors' => "Something went wrong!"], 500);
        } catch (\Exception $e) {
            return response()->json(['errors' => "Server Error!"], 500);
        }
    }

    /**
     * @param $base64_image
     * @param $name
     * @return bool
     */
    public function storeImage($base64_image, $name)
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
            $pos = strpos($base64_image, ';');
            $type = explode(':', substr($base64_image, 0, $pos))[1];
            $fileType = explode('/', $type)[0];
            $extension = explode('/', $type)[1];

            if ($fileType == 'image') {
                if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
                    $name = $name . '.jpg';
                    $data = substr($base64_image, strpos($base64_image, ',') + 1);

                    $data = base64_decode($data);
                    $store = Storage::disk('local')->put("public/images/" . $name, $data);
                    return $name;
                }
            }
        }

        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $participant = Participants::where('uid', "09673b58-1bf4-4975-8703-b3303c7787aa")->first();
        $participantBarCodeId = Str::limit("09673b58-1bf4-4975-8703-b3303c7787aa", 13, '');
        $participant = [];
        PDF::setOptions([
            'debugCss' => true,
            'debugLayout' => true,
            'debugLayoutLines' => true,
            'debugLayoutBlocks' => true,
            'debugLayoutInline' => true,
            'debugLayoutPaddingBox' => true,
        ]);
        return $pdf = PDF::loadView('pdf.participant', compact('participant', 'participantBarCodeId'))->stream();
        return $pdf->download('participant.pdf');
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
        $rules = [
            'title' => 'required',
            'name' => 'required',
            'image' => 'required',
            'year_of_birth' => ['required', 'numeric', Rule::notIn(["-1"])],
            'admission_year' => ['required', 'numeric', Rule::notIn(["-1"])],
            'class' => ['required', Rule::notIn(["-1"])],
            'group' => ['required', Rule::notIn(["-1"])],
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => ['required', Rule::notIn(["-1"])],
            'zip_code' => 'required',
            'mobile_no' => 'required',
            'email' => 'required|email',
            'occupation' => ['required', Rule::notIn(["-1"])],
        ];

        if (count($request->guests) > 0) {
            $rules['guests.*.name'] = 'required';
            $rules['guests.*.relation'] = ['required', Rule::notIn(["-1"])];
            $rules['guests.*.age'] = 'required';
        }

        $customMessages = [
            'required' => 'The :attribute field can not be blank.',
            'numeric' => 'The :attribute field must be numeric.'
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function filter(Request $request)
    {
        $this->validate($request, [
            'register_type' => 'required',
            'student_type' => 'required',
            'payment_status' => 'required',
        ]);

        try {
            $perPage = 100;
            $registerType = $currentStudent = $immigrantStudent = $paymentStatus = 0;

            if ($request->register_type == 'only_register') {
                $registerType = 1;
            }

            if ($request->student_type == 'current-student') {
                $currentStudent = 1;
            } elseif ($request->student_type == 'nrb-former-student') {
                $immigrantStudent = 1;
            }

            if ($request->payment_status == 'paid') {
                $paymentStatus = 1;
            }

            $participants = Participants::where('current_student', $currentStudent)
                                ->where('outside_of_bd', $immigrantStudent)
                                ->where('only_register', $registerType)
                                ->where('paid', $paymentStatus)
                                ->paginate($perPage);

            return view('admin.participants.index', compact('participants', 'request'));

        } catch (PDOException $e) {
            return redirect()->back()->with(['error' => "PDOException Error!"]);
        } catch (QueryException $e) {
            return redirect()->back()->with(['error' => "QueryException Error!"]);
        } catch (TokenMismatchException $e) {
            return redirect()->route('participant.index');
        } catch (MethodNotAllowedHttpException $e) {
            return redirect()->route('participant.index');
        }
    }
}
