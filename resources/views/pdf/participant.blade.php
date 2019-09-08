<!DOCTYPE html>
<html>
<head>
    <title>Laravel HTML to PDF</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,600' rel='stylesheet' type='text/css'>

    <style>
        body{
            font-family: 'Open Sans';
            font-weight: 400;
        }
        .fix{
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="header_title fix">
                <h4 style="float: left;">{{ $participant->name }}</h4>
                <img style="float: right;width: 30%" src="{{ public_path($participant->image) }}" alt="">
                <hr>
            </div>
            <div class="col-md-6 fix">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto corporis debitis distinctio dolores harum, magnam necessitatibus nisi, numquam possimus, quidem tempora. Alias aliquam, asperiores autem dolore ea excepturi unde?</p>
            </div>

            <div class="fix">
                <p>{!! html_entity_decode(DNS1D::getBarcodeHTML(md5($participant->uid), "C39+", 1, 60)) !!}
                </p>
            </div>
        </div>
    </div>
</body>
</html>
