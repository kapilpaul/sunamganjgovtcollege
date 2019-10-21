@extends('frontend.layout.default')

@section('title', 'Payement')

@section('page_title', 'Payment')

@section('main_content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mx-50 mb-100 text-center">
                    <p class="lead">Thank you for register in Sunamganj Govt. College's Platinum Jubilee 2020</p>
                    <p>You are one step away from Registration. Please pay by click on the button</p>

                    <a class="btn btn-success btn-lg mt-20" href="{{ route('registration.payment.process', $participant->uid) }}">
                        Payment
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
