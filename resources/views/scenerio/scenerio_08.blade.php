<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        body {
            margin: 0px;
            padding: 0;
        }
        @media only screen and (max-width: 767px) {
            body+table {
                width:100% !important;
            }
        }
    </style>
</head>
<body>
<table cellpadding="0" cellspacing="0" border="0" align="center" style="font-family: Arial; background-color: #f0c94a; padding: 10px;width:100%;max-width:540px;">
    <tr>
        <td>
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="padding: 10px;background:#66ae96;">
                <tr>
                    <td align="center" valign="middle"><img style="width:143px;" src="http://design.neosofttech.in/70/bcg/img/misaal.png" alt="" alt=""></td>
                </tr>
                <tr>
                    <td style="font-size: 18px; font-weight: bold; line-height: 32px; text-align: center;">जानना चाहते है की <span style="color: #ec1d25;"> {{$current_month}}<span style="text-decoration: underline;"> {{date('Y')}}</span></span> में <span style="color: #ec1d25;">{{ $lstData['phc_name'] }} पी.एच.सी</span> के किस <span style="color: #ec1d25; font-size: 20px;">{{strtoupper($type)}}</span> ने मिसाल बन दिखाया?</td>
                </tr>
            </table>

            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding: 10px 25px;">
                <tr>
                    <td style="border-top: solid 2px #82b49b; border-bottom: solid 2px #82b49b; padding: 5px 0px;">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td align="left"><img src="http://design.neosofttech.in/50/rajesh/BCG/html/images/newsletter-img/announcment-icon-left.jpg" alt="" style="margin-left: -20px;"></td>
                                <td style="font-size: 36px; line-height: 36px; color: #08683a; font-weight: bold; text-align: center;">शाबाश ANM दीदी </td>
                                <td align="right"><img src="http://design.neosofttech.in/50/rajesh/BCG/html/images/newsletter-img/announcment-icon-right.jpg" alt="" style="margin-right: -20px;"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff;padding:20px 10px 0;">
                <tr>
                    <td align="left" style="font-weight: bold;">
                        <p style="color: #000; font-size: 15px; line-height: 25px;margin:0; margin-bottom:5px;word-spacing:4px;">इस महिने <span style="color: #ec1d25; font-size: 15px;">PHC</span> {{ $lstData['phc_name'] }} के सेक्टर मे कोई भी <span style="color: #ec1d25; font-size: 15px;">Middle</span> परफॉर्मिंग <span style="color: #ec1d25; font-size: 15px;">सबसेन्टर</span> नहीं है।</p>
                    </td>
                </tr>
            </table>

            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding-top: 20px;">
                @if(!empty($lstData['BOTTOM']))
                    <tr>
                        <td align="left" valign="middle"><img style="width:135px;" src="http://design.neosofttech.in/50/rajesh/BCG/html/images/newsletter-img/pic3-left.jpg" alt="" alt=""></td>
                        <td align="center" style="font-weight: bold;padding-right:5px;">
						<span style="color: #ec1d25; font-size: 22px;">
                            @if(isset($lstData['BOTTOM']['subcenter']) && count($lstData['BOTTOM']['subcenter']) > 0)
                                सबसेन्टर्स <span class="">{{ implode(',', $lstData['BOTTOM']['subcenter']) }}</span>
                                एवं
                                <span class="">{{ $lstData['BOTTOM']['end'] }}</span>
                            @else
                                सबसेन्टर्स <span class="">{{ $lstData['BOTTOM']['end'] }}</span>
                            @endif
                        <span>
						<p style="color: #000; font-size: 15px; line-height: 30px; margin:0;">को भी 40% से अधिक बच्चो का टीकाकरण एवं 20% से भी अधिक गर्भवती महिलाओं का चौथा ANC चैकप करके दिखाना है | थोड़ी और तैयारी करो!</p>
                        </td>
                    </tr>
                @endif
            </table>

            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #fcc73b; padding:5px;">
                <tr>
                    <td align="left" valign="middle"><img style="width:60px;" src="http://design.neosofttech.in/70/bcg/img/pic8-center.jpg" alt="" alt=""></td>
                    <td align="center">
                        <p style="color: #000; font-size: 20px; line-height: 30px; margin:0;">परिवार नियोजन के साधनो (कंडोम, कॉपर टी, अन्तरा, PPIUCD, नसबंदी आदि) का समय अनुसार उपयोग करने के लिए समुदाय को प्रेरित करें | </p>
                    </td>
                </tr>
            </table>

            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding:10px;">
                <tr>
                    <td align="center" colspan="2" style="font-size: 18px; line-height: 30px; font-weight: bold; border-top: solid 3px #808080;padding-top:8px;">

                    </td>
                </tr>
                <tr>
                    <td align="left" valign="middle"><img style="width:50px;padding-bottom:8px;" src="http://design.neosofttech.in/70/bcg/img/pic9-left.jpg" alt="" alt=""></td>
                    <td align="center">
                        <p style="color: #000; font-size: 15px; line-height: 20px; margin:0;padding-bottom:8px;"><span style="color: #ec1d25; font-size: 16px;">सभी ANM नोट करें:</span> कृपया किसी भी महिला या बच्चे को बिना उनकी सहमति के ANC, टीकाकरण या परिवार नियोजन के संमंदित साधनो का प्रयोग करने के लिए मजबूर न करें |  ऐसा पाए जाने पर सख्त कारवाई की जाएगी | </p>
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="2" style="font-size: 15px; line-height: 30px;border-top: solid 2px #000;">
                        बने रहिये: देखते है {{ $next_month }} {{ date('Y') }} में कौनसा <span style="color: #ec1d25; font-size: 15px;">सबसेंटर</span> मिसाल बनकर दिखायेगा!
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>