@extends('frontend.layout.default')

@section('title', 'Register')

@section('page_title', 'Register')

@section('main_content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mx-50 text-center">
                    <p class="lead">Sunamganj Govt. College's Platinum Jubilee 2020 Organized by former students and students</p>
                </div>

                {{--<participant-create :current-student="true"></participant-create>--}}
                <participant-create></participant-create>
            </div>
        </div>
    </div>
@stop
