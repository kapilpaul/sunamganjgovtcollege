@extends('frontend.layout.default')

@section('title', 'Download Ticket')

@section('page_title', 'Download Ticket')

@section('main_content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mx-50 mb-100 text-center">
                    <p class="lead">Thank you for register in Sunamganj Govt. College's Platinum Jubilee 2020</p>
                    <p>Please download and keep a copy of the ticket.</p>

                    <a class="btn btn-success btn-lg mt-20" href="{{ route('ticket.download', $uid) }}">
                        Download Ticket
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
