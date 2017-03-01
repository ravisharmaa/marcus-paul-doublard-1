<html>
<head>
    <style>
        {padding:0; margin:0;}
        body{font-family:arial,sans-serif;font-size:11px;}
        img{padding: 0; margin: 0px;}
    </style>
</head>
<body>
<div style='width:100%;'>
    <table width='600' align='center' cellpadding='0' cellspacing='0' border='0' style='background:#F7F7F7;margin:0 auto;'>
        <tr>
            <td valign='top' align='center' style='padding: 25px 0 25px;'>
                <img src="{{asset('assets/frontend/img/mp-logo.png')}}" alt='Marcus Paul' width='200' border='0' />
            </td>
        </tr>
        <tr>
            <td cellpadding='0' cellspacing='0'><div style='border-top:#eaeaea 1px solid; padding: 0px;'>&nbsp;</div></td>
        </tr>
        <tr>
            <td style='padding:20px 40px 10px; font-size:11px; line-height:16px;'>
                An enquiry has been received from {{$mail_data['full_name']}}
                <br /><br />

                <p class=MsoNormal style='margin-bottom:12.0pt'>
                    <b><span style='font-size:8.5pt;font-family:"Arial","sans-serif";line-height: 12.5pt;'>Enquiry Details</span></b>
                    <span style='font-size:8.5pt;font-family:"Arial","sans-serif"'><br>
                        {{$mail_data['full_name']}}<br>
                        {{$mail_data['telephone']}}<br>
                            <a href="mailto:{{$mail_data['email']}}">{{$mail_data['email']}}</a>
                            <br><br><o:p></o:p>
                        </span>
                </p>
            </td>
        </tr>
        <tr>
            <td style='padding:0px 40px 10px; font-size:11px; line-height:16px;'>
                <table width='520' align='center' cellpadding='0' cellspacing='0' border='0' style='background:#F7F7F7; margin:0 auto;'>
                    <tr>
                        <td width="200">
                            <img src="{{asset('images/colourway/th/'.$product_data->colourway_th_image)}}" width="200">
                        </td>
                        <td width="320" valign="top" style="padding-left: 30px;">
                            <table cellpadding='0' cellspacing='0' border='0'>
                                <tr>
                                    <td style="font-size:11px; line-height:16px; padding-right: 20px;"><b>Product:</b> </td>
                                    <td style="font-size:11px; line-height:16px;">{{$product_data->product->product_name}}</td>
                                </tr>
                                <tr>
                                    <td style="font-size:11px; line-height:16px; padding-right: 20px;"><b>Colourway:</b></td>
                                    <td style="font-size:11px; line-height:16px;">{{$product_data->colourway_name}}</td>
                                </tr>
                                <tr>
                                    <td style="font-size:11px; line-height:16px; padding-right: 20px;"><b>Message:</b></td>
                                    <td style="font-size:11px; line-height:16px;">{{$mail_data['message']}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style='padding:30px 40px 20px; font-size:11px; line-height:16px;'>
                Kind regards,
                <br />
                Marcus Paul
            </td>
        </tr>
        <tr>
            <td><div style='border-bottom:#eaeaea 1px solid'>&nbsp;</div></td>
        </tr>
        <tr>
            <td style='padding:25px 40px;'>
                <table>
                    <tr>
                        <td width='180' valign='top' style='font-size:10px;line-height:16px;'>
                            <b>Registered Office:</b>
                            <br />P.O. Box 454
                            <br />Theaklen Drive
                            <br /> St. Leonards-on-Sea,East Sussex
                            <br />TN38 9AZ
                            <br />United Kingdom
                            <br />Tel: +44 (0)1424 403000
                        </td>
                        <td width='220' valign='top' style='font-size:10px;line-height:16px;'>
                            <b>DISTRIBUTED BY TIM PAGE CARPETS</b>
                            <br />Design Centre Chelsea Harbour
                            <br />Lots Road
                            <br />London
                            <br />SW10 0XE
                            <br />Tel: +44 (0)20 7259 7282
                            <br />Website: www.timpagecarpets.com
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>