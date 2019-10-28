@extends('frontend.layout.default', ['home' => true])

@section('title', 'Home')

@section('page_title', 'Home')

@section('main_content')
    <!--
     Highlight Section
     ====================================== -->

    <section class="highlight">

        <div class="container">
            <p class="lead text-center">
                Sunamganj Govt. College's Platinum Jubilee 2020 <br>
                Organized by former students and students <br><br>
                Chairman: Humayun Manjur Choudury <br>
                Co-chairman: Nurul Huda Mukut<br><br>
                2 days program 17 January, 18 January.<br>
            </p>

            <div class="countdown_wrap">

                <h6 class="countdown_title text-center">EVENT WILL START IN</h6>

                <!-- Countdown JS for the Event Date Starts here.
    TIP: You can change your event time below in the Same Format.  -->

                <ul id="countdown" data-event-date="17 january 2020 09:00:00">
                    <li class="wow zoomIn" data-wow-delay="0s"> <span class="days">00</span>
                        <p class="timeRefDays">days</p>
                    </li>
                    <li class="wow zoomIn" data-wow-delay="0.2s"> <span class="hours">00</span>
                        <p class="timeRefHours">hours</p>
                    </li>
                    <li class="wow zoomIn" data-wow-delay="0.4s"> <span class="minutes">00</span>
                        <p class="timeRefMinutes">minutes</p>
                    </li>
                    <li class="wow zoomIn" data-wow-delay="0.6s"> <span class="seconds">00</span>
                        <p class="timeRefSeconds">seconds</p>
                    </li>
                </ul>
            </div>
            <!-- end .countdown_wrap -->
        </div>
        <!-- end .container -->
    </section>
    <!-- end section.highlight -->


    @include('frontend.home.schedule')
    @include('frontend.home.contact')
    @include('frontend.home.modal')
@stop

@push('footer_middle_js')
    <script src="{{ asset('assets/website/js/plugins/countdown.js') }}"></script>
    <script src="{{ asset('assets/website/js/plugins/count-to.js') }}"></script>
    <script src="{{ asset('assets/website/js/plugins/flexslider.js') }}"></script>
@endpush
