<!DOCTYPE html>
<html>
<head>
    <title>Laravel HTML to PDF</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,600' rel='stylesheet' type='text/css'>

    <style>

        .page-break {
            page-break-after: always;
        }

        body, h1, h2, h3, h4, h5, h6 {
            font-family: 'Open Sans';
            font-weight: 400;
        }

        .fix {
            overflow: hidden;
        }

        .float-left {
            float: left;
        }

        .float-right {
            float: right;
        }

        .header_area {
            width: 100%;
        }

        .header_left, .header_right {
            display: inline-block;
            padding-top: 10px;
        }

        .header_left {
            width: 79%;
        }

        .header_right {
            width: 20%;
        }
        .full-width {
            width: 100%;
        }

        .img-fluid{
            width: 1200%;
            height: auto;
        }
        .text-center{
            text-align: center;
        }
        .mt-0, p{
            margin-top: 0;
        }
        .mb-0, p{
            margin-bottom: 0;
        }
        /*table, th, td {*/
            /*border: 1px solid black;*/
        /*}*/
    </style>
</head>
<body>
<table>
    <tr>
        <td valign="top" style="width: 450px">
            <table>
                <tr>
                    <td>
                        <h2 class="mt-0" style="padding-top: 0;">Kapil Paul</h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Lorem ipsum dolor</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Lorem ipsum dolor</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Lorem ipsum dolor</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Lorem ipsum dolor</p>
                    </td>
                </tr>
            </table>
        </td>
        <td valign="top" style="width: 200px">
            <div class="full-width text-center">
                <img class="img-fluid" src="https://www.perlara.com/wp-content/uploads/Press-release-300x300px-v1-300x300.jpg" alt="">
            </div>
        </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td valign="top" style="width: 450px">

        </td>
        <td valign="top" style="width: 200px">
            <div class="full-width text-center">
                {!! DNS1D::getBarcodeHTML("111111111111", "C39+", 1, 50) !!}
                <p class="mt-0">{{ $participantBarCodeId }}</p>
            </div>
        </td>
    </tr>
</table>
</body>
</html>
