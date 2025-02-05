@props([
    'title' => ''
])

    <!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">

    <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Quicksand:400,500&display=swap" rel="stylesheet">

    <title>{{$title}} | {{config('app.name')}}</title>
    <!--[if mso]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <style>
        table {
            border-collapse: collapse;
        }

        td, th, div, p, a {
            font-size: 16px;
            line-height: 26px;
        }

        .spacer, .divider, div, p, a, h1, h2, h3, h4, h5, h6 {
            mso-line-height-rule: exactly;
        }

        td, th, div, p, a, h1, h2, h3, h4, h5, h6 {
            font-family: "Segoe UI", Helvetica, Arial, sans-serif;
        }
    </style>
    <![endif]-->

    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700|Quicksand:400,500&display=swap');

        @media only screen {

            .col,
            td,
            th,
            div,
            p {
                font-family: -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", "Roboto", "Helvetica Neue", Arial, sans-serif;
            }

        }

        #outlook a {
            padding: 0;
        }

        img {
            border: 0;
            line-height: 100%;
            vertical-align: middle;
        }

        .col {
            font-size: 16px;
            line-height: 26px;
            vertical-align: top;
        }

        @media only screen and (max-width: 730px) {
            .wrapper img {
                max-width: 100%;
            }

            u ~ div .wrapper {
                min-width: 100vw;
            }

            .container {
                width: 90% !important;
                -webkit-text-size-adjust: 100%;
            }
        }

        @media only screen and (max-width: 699px) {
            .col {
                box-sizing: border-box;
                display: inline-block !important;
                line-height: 23px;
                width: 100% !important;
            }

            .col-sm-1 {
                max-width: 8.33333%;
            }

            .col-sm-2 {
                max-width: 16.66667%;
            }

            .col-sm-3 {
                max-width: 25%;
            }

            .col-sm-4 {
                max-width: 33.33333%;
            }

            .col-sm-5 {
                max-width: 41.66667%;
            }

            .col-sm-6 {
                max-width: 50%;
            }

            .col-sm-7 {
                max-width: 58.33333%;
            }

            .col-sm-8 {
                max-width: 66.66667%;
            }

            .col-sm-9 {
                max-width: 75%;
            }

            .col-sm-10 {
                max-width: 83.33333%;
            }

            .col-sm-11 {
                max-width: 91.66667%;
            }

            .col-sm-push-1 {
                margin-left: 8.33333%;
            }

            .col-sm-push-2 {
                margin-left: 16.66667%;
            }

            .col-sm-push-3 {
                margin-left: 25%;
            }

            .col-sm-push-4 {
                margin-left: 33.33333%;
            }

            .col-sm-push-5 {
                margin-left: 41.66667%;
            }

            .col-sm-push-6 {
                margin-left: 50%;
            }

            .col-sm-push-7 {
                margin-left: 58.33333%;
            }

            .col-sm-push-8 {
                margin-left: 66.66667%;
            }

            .col-sm-push-9 {
                margin-left: 75%;
            }

            .col-sm-push-10 {
                margin-left: 83.33333%;
            }

            .col-sm-push-11 {
                margin-left: 91.66667%;
            }

            .full-width-sm {
                display: table !important;
                width: 100% !important;
            }

            .stack-sm-first {
                display: table-header-group !important;
            }

            .stack-sm-last {
                display: table-footer-group !important;
            }

            .stack-sm-top {
                display: table-caption !important;
                max-width: 100%;
                padding-left: 0 !important;
            }

            .toggle-content {
                max-height: 0;
                overflow: auto;
                transition: max-height .4s linear;
                -webkit-transition: max-height .4s linear;
            }

            .toggle-trigger:hover + .toggle-content,
            .toggle-content:hover {
                max-height: 999px !important;
            }

            .show-sm {
                display: inherit !important;
                font-size: inherit !important;
                line-height: inherit !important;
                max-height: none !important;
            }

            .hide-sm {
                display: none !important;
            }

            .align-sm-center {
                display: table !important;
                float: none;
                margin-left: auto !important;
                margin-right: auto !important;
            }

            .align-sm-left {
                float: left;
            }

            .align-sm-right {
                float: right;
            }

            .text-sm-center {
                text-align: center !important;
            }

            .text-sm-left {
                text-align: left !important;
            }

            .text-sm-right {
                text-align: right !important;
            }

            .borderless-sm {
                border: none !important;
            }

            .nav-sm-vertical .nav-item {
                display: block;
            }

            .nav-sm-vertical .nav-item a {
                display: inline-block;
                padding: 4px 0 !important;
            }

            .spacer {
                height: 0;
            }

            .p-sm-0 {
                padding: 0 !important;
            }

            .p-sm-10 {
                padding: 10px !important;
            }

            .p-sm-20 {
                padding: 20px !important;
            }

            .p-sm-30 {
                padding: 30px !important;
            }

            .p-sm-50 {
                padding: 50px !important;
            }

            .pt-sm-0 {
                padding-top: 0 !important;
            }

            .pt-sm-10 {
                padding-top: 10px !important;
            }

            .pt-sm-20 {
                padding-top: 20px !important;
            }

            .pt-sm-30 {
                padding-top: 30px !important;
            }

            .pt-sm-50 {
                padding-top: 50px !important;
            }

            .pr-sm-0 {
                padding-right: 0 !important;
            }

            .pr-sm-10 {
                padding-right: 10px !important;
            }

            .pr-sm-20 {
                padding-right: 20px !important;
            }

            .pr-sm-30 {
                padding-right: 30px !important;
            }

            .pr-sm-50 {
                padding-right: 50px !important;
            }

            .pb-sm-0 {
                padding-bottom: 0 !important;
            }

            .pb-sm-10 {
                padding-bottom: 10px !important;
            }

            .pb-sm-20 {
                padding-bottom: 20px !important;
            }

            .pb-sm-30 {
                padding-bottom: 30px !important;
            }

            .pb-sm-50 {
                padding-bottom: 50px !important;
            }

            .pl-sm-0 {
                padding-left: 0 !important;
            }

            .pl-sm-10 {
                padding-left: 10px !important;
            }

            .pl-sm-20 {
                padding-left: 20px !important;
            }

            .pl-sm-30 {
                padding-left: 30px !important;
            }

            .pl-sm-50 {
                padding-left: 50px !important;
            }

            .px-sm-0 {
                padding-right: 0 !important;
                padding-left: 0 !important;
            }

            .px-sm-10 {
                padding-right: 10px !important;
                padding-left: 10px !important;
            }

            .px-sm-20 {
                padding-right: 20px !important;
                padding-left: 20px !important;
            }

            .px-sm-30 {
                padding-right: 30px !important;
                padding-left: 30px !important;
            }

            .px-sm-50 {
                padding-right: 50px !important;
                padding-left: 50px !important;
            }

            .py-sm-0 {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }

            .py-sm-10 {
                padding-top: 10px !important;
                padding-bottom: 10px !important;
            }

            .py-sm-20 {
                padding-top: 20px !important;
                padding-bottom: 20px !important;
            }

            .py-sm-30 {
                padding-top: 30px !important;
                padding-bottom: 30px !important;
            }

            .py-sm-50 {
                padding-top: 50px !important;
                padding-bottom: 50px !important;
            }

            .sm-title-text {
                font-size: 22px !important;
                line-height: 28px !important;
            }

            .paragraph-center {
                margin: 0 auto !important;
                width: 90% !important;
            }

        }


    </style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" bgcolor="#E9EBEE"
      style="box-sizing:border-box;margin:0;padding:0;width:100%;word-break:break-word;-webkit-font-smoothing:antialiased;">

<div lang="en" style="display:none;font-size:0;line-height:0;">
    Email Object Here
</div>


<!-- Section : Logo -->
<table class="wrapper" cellpadding="0" cellspacing="0" role="presentation" width="100%">
    <tr>
        <td class="px-sm-20" align="center" bgcolor="#F5F5F5" style="padding: 0px 0;">
            <!-- 500px Box -->
            <table class="container" cellpadding="0" cellspacing="0" role="presentation" width="500">
                <tr>
                    <td class="col" align="left">
                        <!-- Logo -->
                        <table cellpadding="0" cellspacing="0" role="presentation" width="100%">
                            <tr>
                                <td class="col py-sm-0" width="500" style="padding: 20px 50px;">
                                    <table align="center">
                                        <tr>
                                            <td class="spacer" height="20"
                                                style="font-size: 20px; line-height: 20px; mso-line-height-rule: exactly;">
                                                &nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="{{route('welcome')}}">
                                                    <img src="{{asset('assets/icons/mainLogo.png')}}" width="150"
                                                         alt="Header Logo"
                                                         style="border: 0; width: 100%; max-width: 150px;">
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="spacer" height="20"
                                                style="font-size: 20px; line-height: 20px; mso-line-height-rule: exactly;">
                                                &nbsp;
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <!-- end Logo -->
                    </td>
                </tr>
            </table>
            <!-- end 500px box -->
        </td>
    </tr>
</table>
<!-- end Section : Logo -->


<!-- Section : Banner -->
<table class="wrapper" cellpadding="0" cellspacing="0" role="presentation" width="100%">
    <tr>
        <td align="center" bgcolor="#F5F5F5" style="padding: 0px 0;">
            <!-- 500px Box -->
            <table class="container" cellpadding="0" cellspacing="0" role="presentation" width="500">
                <tr>
                    <td class="col" align="left">
                        <!-- Banner -->
                        <table cellpadding="0" cellspacing="0" role="presentation" width="100%">
                            <tr>
                                <td width="500">
                                    <img src="{{asset('email/banner.png')}}" width="500" alt="Header Logo"
                                         style="border: 0; width: 100%;">
                                </td>
                            </tr>
                        </table>
                        <!-- end Banner -->
                    </td>
                </tr>
            </table>
            <!-- end 500px box -->
        </td>
    </tr>
</table>
<!-- end Section : Banner -->

{{$slot}}

<!-- Section : Footer -->
<table class="wrapper" cellpadding="0" cellspacing="0" role="presentation" width="100%">
    <tr>
        <td align="center" bgcolor="#F5F5F5">
            <!-- 500px Box -->
            <table class="container" cellpadding="0" cellspacing="0" role="presentation" width="500">
                <tr>
                    <td class="col px-sm-30 py-sm-30" align="left" style="padding:30px 50px;">
                        <!-- Content -->
                        <table cellpadding="0" cellspacing="0" role="presentation" width="100%">
                            <tr>
                                <td class="col" width="400"
                                    align="left">
                                    <table cellpadding="0" cellspacing="0" role="presentation" width="100%">
                                        <tr>
                                            <td class="" width="17" style="padding-right: 10px;">
                                                <a href="#" style="text-decoration: none;padding-right: 10px;">
                                                    <img src="{{asset('email/facebook.png')}}" alt="facebook"
                                                         style="width: 17px;">
                                                </a>
                                                <a href="#" style="text-decoration: none;padding:0 10px;">
                                                    <img src="{{asset('email/twitter.png')}}" alt="twitter"
                                                         style="width: 17px;">
                                                </a>
                                                <a href="#" style="text-decoration: none;padding-left: 10px;">
                                                    <img src="{{asset('email/instagram.png')}}" alt="instagram"
                                                         style="width: 17px;">
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="spacer py-sm-10" style="line-height: 20px;">‌</div>
                                    <div style="background: #d0d8de; height: 1px; line-height: 1px;">‌</div>
                                    <div class="spacer py-sm-10" style="line-height: 20px;">‌</div>
                                    <div class="spacer py-sm-10" style="line-height: 10px;">‌</div>
                                    <p style="font-family: 'Karla', Arial, sans-serif;font-size: 13px;line-height: 22px;font-weight: 400; color:#7E7E7E; margin: 0; margin-bottom: 0px ;">
                                        <span style="color: #292929; font-weight: 600;">Address</span> , 110 William
                                        Street, 28th Floor, New York, NY 10038
                                    </p>
                                </td>
                            </tr>
                        </table>
                        <!-- end Content -->
                    </td>
                </tr>
            </table>
            <!-- end 500px box -->
        </td>
    </tr>
</table>
<!-- end Section : Footer -->


</body>

</html>
