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
                                <td style="font-size: 18px; font-weight: bold; line-height: 32px; text-align: center;">जानना चाहते है की <span style="color: #ec1d25;">{{$current_month}} <span style="text-decoration: underline;">{{date('Y')}}</span></span> में <span style="color: #ec1d25;">{{ $lstData['phc_name'] }} पी.एच.सी</span> के किस <span style="color: #ec1d25; font-size: 20px;">{{strtoupper($type)}}</span> ने मिसाल बन दिखाया?</td>
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

            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff;">
                @if(!empty($lstData['TOP']))
                <tr>
                    <td align="left" valign="middle"><img style="width:143px;" src="http://design.neosofttech.in/50/rajesh/BCG/html/images/newsletter-img/pic1-left.jpg" alt="" alt=""></td>
                    <td align="center" style="font-weight: bold;padding-right:5px;">
						<span style="color: #ec1d25; font-size: 22px;">
                            @if(isset($lstData['TOP']['subcenter']) && count($lstData['TOP']['subcenter']) > 0)
                        सबसेन्टर्स <span style="color: #ec1d25; font-size: 20px;" class=""> {{ implode(',', $lstData['TOP']['subcenter']) }}</span>
                                और
                                <span style="color: #ec1d25; font-size: 20px;" class=""> {{ $lstData['TOP']['end'] }}</span>
                            @else
                        सबसेन्टर्स <span style="color: #ec1d25; font-size: 20px;" class=""> {{ $lstData['TOP']['end'] }}</span>
                            @endif
                        <span>
						<p style="color: #000; font-size: 15px; line-height: 30px; margin:0;">ने {{$current_month}} में सब के लिए एक मिसाल बन दिखाया है!<br> आपकी <span style="color: #ec1d25; font-size: 24px;">ANMs</span> ने आस पास के 90% से भी अधिक बच्चो का टीकाकरण पूरा कर दिखाया, साथ ही साथ 45% से अधिक गर्भवती महिलाओं का चौथा ANC चैकप भी पूरा किया! बने रहिये - हम अगले महीने फिर आपको मिसाल बनते देखने के लिए उत्तेजित है!</p>
                    </td>
                </tr>
                @endif
            </table>

            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding-top: 30px;">
                @if(!empty($lstData['MIDDLE']))
                <tr>
                    <td align="center" style="font-weight: bold;padding-left:5px;">
						<span style="color: #ec1d25; font-size: 22px;">
                            @if(isset($lstData['MIDDLE']['subcenter']) && count($lstData['MIDDLE']['subcenter']) > 0)
                        सबसेन्टर्स <span class="">{{ implode(',', $lstData['MIDDLE']['subcenter']) }}</span>
                                एवं
                                <span class="">{{ $lstData['MIDDLE']['end'] }}</span>
                            @else
                        सबसेन्टर्स <span class="">{{ $lstData['MIDDLE']['end'] }}</span>
                            @endif
                        <span>
						<p style="color: #000; font-size: 15px; line-height: 30px; margin:0;">ने अच्छा करने का प्रयास किया 60% से अधिक बच्चो का टीकाकरण कर दिखाया, साथ ही साथ 15% से अधिक गर्भवती महिलाओं का चौथा ANC चैकप भी पूरा किया!</p>
                    </td>
                    <td align="right" valign="middle"><img  style="width:143px;" src="http://design.neosofttech.in/50/rajesh/BCG/html/images/newsletter-img/pic2-right.jpg" alt="" alt=""></td>
                </tr>
                @endif
            </table>

            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding-top: 30px;">
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
						<p style="color: #000; font-size: 15px; line-height: 30px; margin:0;">को भी 60% से अधिक बच्चो का टीकाकरण एवं 15% से भी अधिक गर्भवती महिलाओं का चौथा ANC चैकप करके दिखाना है | थोड़ी और तैयारी करो!</p>
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