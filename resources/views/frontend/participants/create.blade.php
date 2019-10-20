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
                <button class="your-button-class" id="sslczPayBtn"
                        order="abcde"
                        postdata="your javascript arrays or objects which requires in backend"
                        endpoint="{{ route('api.payment.process') }}">
                    Pay Now
                </button>

                <participant-create
                        :current-student="{!! $currentStudent !!}"
                        :immigrant-student="{!! $immigrantStudent !!}"
                        :register-only="{!! $registerOnly !!}"
                ></participant-create>
            </div>
        </div>
    </div>
@stop

@push('footer_js')
    <script>
        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
    </script>
@endpush
