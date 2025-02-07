<!-- Fixed navbar -->
{{--reveal-menu js-reveal-menu reveal-menu-hidden--}}
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('frontend.home') }}">
                <h5 class="m-0 fz-17">Sunamganj College</h5>
                <p class="m-0 fz-11">Organized by former students and students</p>
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#top">Home</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Registration (Participate) <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('participant.create', 'current-student') }}">
                                Current Student
                            </a>
                        </li>
                        <li><a href="{{ route('participant.create', 'former-student') }}">Former Student</a></li>
                        <li><a href="{{ route('participant.create', 'nrb-former-student') }}">Non Resident Bangladeshi Former Student</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Only Registration (Magazine) <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('participant.create', 'former-student') }}?registeronly=true">Former Student</a></li>
                        <li><a href="{{ route('participant.create', 'nrb-former-student') }}?registeronly=true">Non Resident Bangladeshi Former Student</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>
<!-- // End Fixed navbar -->
