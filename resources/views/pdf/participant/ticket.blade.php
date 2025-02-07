<!DOCTYPE html>
<html>
<head>
    <title>Sunamganj Govt. College's Platinum Jubilee 2020</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700" rel="stylesheet">

    @include('pdf.participant.style')
</head>
<body>

<div class="header text-center fix">
    <img style="width: 80px" src="https://i.imgur.com/k5OcKkv.jpg" alt="">
    <h3 class="">Event Confirmation</h3>
</div>


<table>
    <tr>
        <td valign="top" style="width: 450px">
            <table>
                <tr>
                    <td>
                        <h1 class="nametitle mt-0" style="padding-top: 0;">{{ $participant->name }}</h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>{{ $participant->mobile_no }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>{{ $participant->address }}, {{ $participant->city }}, {{ $participant->state }}</p>
                        <p>{{ $participant->country }}</p>
                    </td>
                </tr>
            </table>
        </td>
        <td valign="top" style="width: 200px">
            <div class="full-width text-center">
                <img class="img-fluid" src="{{ public_path($participant->image) }}" alt="">
            </div>

            <div class="full-width text-center mt-20">
                {!! DNS1D::getBarcodeHTML($participant->alias_id, "C39+", 1, 50) !!}
                <p class="mt-0">{{ $participant->alias_id }}</p>
            </div>
        </td>
    </tr>
</table>

@if(count($participant->guests))

    <table>
        <tr>
            <td>
                <p style="font-weight: bold; margin-top: 15px;">Guests: {{ count($participant->guests) }}</p>
            </td>
        </tr>
        <tr>
            @foreach($participant->guests as $guest)
                <td>
                    <div class="full-width text-center" style="padding: 10px; width: 70%">
                        <img class="img-fluid" src="{{ public_path($guest->image) }}" alt="">
                        <p class="mt-2 mb-0" style="margin-bottom: 0">
                            {{ $guest->name }} <br>
                            {{ $guest->relation }} <br>
                            {{ $guest->age }} Years
                        </p>
                    </div>
                </td>
            @endforeach
        </tr>
</table>
@endif

<div class="information" style="position: absolute; bottom: 0;">
    <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                &copy; {{ date('Y') }} - {{ env('APP_NAME') }} All rights reserved.
            </td>
            <td align="right" style="width: 50%;">
                @if($participant->outside_of_bd == 1)
                NRB Former Student
                @elseif($participant->current_student == 1)
                    Current Student
                @elseif($participant->outside_of_bd == 0)
                    Former Student
                @endif
            </td>
        </tr>

    </table>
</div>
</body>
</html>
