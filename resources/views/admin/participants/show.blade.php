@extends('layouts.default')

@section('main_content')

    <div class="block pt-20 pb-20 pl-10 pr-10">
        <div class="row">
            <div class="col-md-9">
                <div class="widget-simple">
                    <h4 class="widget-content widget-content-light text-left">
                        <strong>{{ $participant->name }}</strong>
                    </h4>
                    <div class="fz-14">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="mb-5">Mobile No</p>
                                <p class="mb-5">Address</p>
                                <p class="mb-5">City</p>
                                <p class="mb-5">State</p>
                                <p class="mb-5">Country</p>
                                <p class="mb-5">Zip Code</p>
                                <p class="mb-5">Year Of Birth</p>
                                <p class="mb-5">Year of Admission</p>
                                <p class="mb-5">Class of Admission</p>
                                <p class="mb-5">Group</p>
                                <p class="mb-5">Subject</p>
                                <p class="mb-5">Email</p>
                                <p class="mb-5">Occupation</p>
                                <p class="mb-5">Designation</p>
                                <p class="mb-5">Department</p>
                                <p class="mb-5">Company Name</p>

                                @if($participant->occupation == 'other')
                                <p class="mb-5">:: &nbsp;&nbsp; Occupation Name</p>
                                @endif

                                <p class="mb-5">Student Status</p>

                                @if($participant->outside_of_bd == 1)
                                <p class="mb-5">NRB</p>
                                @endif

                                @if($participant->only_register == 1)
                                <p class="mb-5">Register For Magazine</p>
                                @endif
                            </div>
                            <div class="col-md-9">
                                <p class="mb-5">:: &nbsp;&nbsp; {{ $participant->mobile_no }}</p>
                                <p class="mb-5">:: &nbsp;&nbsp; {{ $participant->address }}</p>
                                <p class="mb-5">:: &nbsp;&nbsp; {{ $participant->city }}</p>
                                <p class="mb-5">:: &nbsp;&nbsp; {{ $participant->state }}</p>
                                <p class="mb-5">:: &nbsp;&nbsp; {{ $participant->country }}</p>
                                <p class="mb-5">:: &nbsp;&nbsp; {{ $participant->zip_code }}</p>
                                <p class="mb-5">:: &nbsp;&nbsp; {{ $participant->year_of_birth }}</p>
                                <p class="mb-5">:: &nbsp;&nbsp; {{ $participant->admission_year }}</p>
                                <p class="mb-5">:: &nbsp;&nbsp; {{ $participant->class }}</p>
                                <p class="mb-5">:: &nbsp;&nbsp; {{ $participant->group }}</p>
                                <p class="mb-5">:: &nbsp;&nbsp; {{ $participant->subject }}</p>
                                <p class="mb-5">:: &nbsp;&nbsp; {{ $participant->email }}</p>
                                <p class="mb-5">:: &nbsp;&nbsp; {{ $participant->occupation }}</p>
                                <p class="mb-5">:: &nbsp;&nbsp; {{ $occupationDetails->designation }}</p>
                                <p class="mb-5">:: &nbsp;&nbsp; {{ $occupationDetails->department }}</p>
                                <p class="mb-5">:: &nbsp;&nbsp; {{ $occupationDetails->company_name }}</p>

                                @if($participant->occupation == 'other')
                                <p class="mb-5">:: &nbsp;&nbsp; {{ $occupationDetails->occupation_name }}</p>
                                @endif

                                @if($participant->current_student == 1)
                                <p class="mb-5" style="color: #00ff00;">:: &nbsp;&nbsp; Current Student</p>
                                @else
                                <p class="mb-5" style="color: #ff0000;">:: &nbsp;&nbsp; Former Student</p>
                                @endif

                                @if($participant->outside_of_bd == 1)
                                <p class="mb-5">:: &nbsp;&nbsp; YES</p>
                                @endif

                                @if($participant->only_register == 1)
                                <p class="mb-5">:: &nbsp;&nbsp; YES</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <img src="{{ asset($participant->image) }}" alt="" class="img-responsive">

                <div class="text-center mt-15 mb-10">
                    <p class="mb-15">Payment Status</p>

                    @if($participant->paid == 1)
                    <p class="label label-success fz-18">PAID</p>
                    @else
                    <p class="label label-warning fz-18">NOT PAID</p>
                    @endif
                </div>
            </div>
        </div>

        @if(count($participant->guests))
        <div class="row p-15">
            <div class="col-md-12">
                <h4 class="mb-25">Possible Accompanies</h4>
            </div>


            @foreach($participant->guests as $guest)
            <div class="col-md-2 text-center">
                <img src="{{ asset($guest->image) }}" alt="" class="img-responsive mb-10">
                <p class="mb-5 fz-15">Name: {{ $guest->name }}</p>
                <p class="mb-5">Age: {{ $guest->age }}</p>
                <p class="mb-5">Relation: {{ $guest->relation }}</p>
            </div>
            @endforeach
        </div>
        @endif
    </div>
@stop
