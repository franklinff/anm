<!DOCTYPE html>
<html>
<head>
    <title>Report</title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Roboto:400,500,700" rel="stylesheet">
    <style type="text/css">
        body{
            font-family: 'Roboto', sans-serif;
        }
        *{
            margin: 0;
            padding: 0;
        }
        table{
            border-collapse: collapse;
        }
        .table-stat tr td:first-child{
            border-right: 1px solid #c9c9c9;
            width: 50%;
        }
        .table-stat tr td:last-child{
            padding-left: 65px;
            font-weight: 700;
        }
        .table-stat tr td{
            margin-bottom: 15px;
        }
        .common-prop{
            background-color:#fff;
            border: 1px solid #efefef;
            border-radius: 15px;
            box-shadow: 0px 1px 10px 0px #cccccc;
        }
        .patient-table .main-heading tr th{
            padding: 25px 5px;
        }
        .patient-table tr td{
            height: 80px;
        }
        .yellow-col,
        .red-col{
            width: 75px;
        }
        .red-col{
            background-color: #ffc7ce;
        }
        .red-col tr td{
            color: #be0006;
        }
        .yellow-col{
            background-color: #ffffcc;
        }
        .yellow-col tr td{
            color: #484848;
        }
    </style>
</head>
<body>
<table width="100%" style="max-width: 1508px;margin: 0 auto;border-collapse: collapse;background: #f1f1f1;">
    <tbody>
    <tr style="background: rgb(17,66,125);background: -moz-linear-gradient(left, rgba(17,66,125,1) 0%, rgba(32,119,174,1) 76%, rgba(42,157,208,1) 100%);background: -webkit-linear-gradient(left, rgba(17,66,125,1) 0%,rgba(32,119,174,1) 76%,rgba(42,157,208,1) 100%);background: linear-gradient(to right, rgba(17,66,125,1) 0%,rgba(32,119,174,1) 76%,rgba(42,157,208,1) 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#11427d', endColorstr='#2a9dd0',GradientType=1 );">
        <td>
            <table width="90%" style="margin: 0 auto;padding: 40px 0 80px 0; color: #fff;font-weight: 700; border-collapse: separate;">
                <tr>
                    <td style="font-size: 37px;">
                        @if($feedbackdata['phc'])
                            {{ $feedbackdata['phc'] }}
                        @endif

                        @if($feedbackdata['district'])
                            ({{ $feedbackdata['district'] }}) :
                        @endif
                        Patient Feedback Survey
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 21px;">
                      @if($feedbackdata['month'])
                        {{ $months[$feedbackdata['month']] }}
                      @endif

                      @if($feedbackdata['year'])
                            {{ $feedbackdata['year'] }}
                      @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td>
            <table cellspacing="15" class="table-stat common-prop" width="90%" style="margin: -45px auto 0; padding: 50px 35px; border-collapse: separate;">
                <tbody style="color: #11427d; font-size: 30px;">
                <tr>
                    <td>No of Patient phone no received</td>
                    <td>
                        @if ($feedbackdata['no_of_patient_phone_number_received'])
                            {{ $feedbackdata['no_of_patient_phone_number_received'] }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Out Patient Department</td>
                    <td>
                        @if($feedbackdata['opd'])
                            {{ $feedbackdata['opd'] }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Percentage fill Rate</td>
                    <td>
                        @if($feedbackdata['fill_rate'])
                            {{ Helpers::convertToPercent($feedbackdata['fill_rate']) }}%
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>

    <tr>
        <td>
            <table class="common-prop patient-table" width="90%" style="border-collapse: collapse; margin: 35px auto;">
                <thead class="main-heading" style="color: #fff; font-size: 18px;">
                <tr>
                    <th style="background-color: #c0504d; border-radius: 15px 0 0 0; width: 45%;">Patient Feedback</th>
                    <th style="background-color: #f79646; width: 25%; border-left: 5px solid #fff;border-right: 5px solid #fff;">Reported Data</th>
                    <th style="font-family: 'devanagariregular';background-color: #00b050; border-radius: 0 15px 0 0; width: 30%;">सुधार के लिए</th>
                </tr>
                </thead>
                <tbody>
                <tr style="color: #484848;font-size: 17px;">
                    <td style="border-bottom: 1px solid #d8d8d8; padding: 0 15px;">
                        <table width="100%">
                            <thead class="sub-heading">
                            <tr>
                                <th width="50%" align="center">Questions Asked</th>
                                <th width="25%" align="center">No of people Responded </th>
                                <th width="25%" align="center">Patient Feedback Score</th>
                            </tr>
                            </thead>
                        </table>
                    </td>
                    <td style="border-bottom: 1px solid #d8d8d8; padding: 0 15px;">
                        <table width="100%">
                            <thead class="sub-heading">
                            <tr>
                                <th width="70%" align="center">E Aushadi</th>
                                <th width="30%" align="center">Value</th>
                            </tr>
                            </thead>
                        </table>
                    </td>
                    <td style="border-bottom: 1px solid #d8d8d8; padding: 0 15px;">
                        <table width="100%">
                            <thead class="sub-heading">
                            <tr>
                                <th></th>
                            </tr>
                            </thead>
                        </table>
                    </td>
                </tr>

                <tr style="background-color: #f6f6f6; font-family: 'Open Sans', sans-serif; font-size: 15px; color: #484848;">
                    <td style="border-bottom: 1px solid #d8d8d8; padding: 0 15px;">
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td width="50%" style="font-size: 14px;">
                                    <p>Doctor Availability</p>
                                    <p>क्या  आपको डॉक्टर मिला ?</p>
                                </td>
                                <td width="25%" align="center">
                                    <table class="red-col">
                                        <tr>
                                            <td align="center">
                                                @if($feedbackdata['people_responded_for_doctor_availability'])
                                                    {{ $feedbackdata['people_responded_for_doctor_availability'] }}
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="25%" align="center">
                                    <table class="yellow-col">
                                        <tr>
                                            <td align="center">
                                                @if ($feedbackdata['patient_feedback_score_for_doctor_availability'])
                                                    {{ Helpers::convertToPercent($feedbackdata['patient_feedback_score_for_doctor_availability']) }}%
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="border-bottom: 1px solid #d8d8d8; padding: 0 15px;">
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td width="70%" align="center">MOIC Attendance</td>
                                <td width="30%" align="center">
                                    <table class="red-col">
                                        <tr>
                                            <td align="center">
                                                @if ($feedbackdata['moic_attendance'])
                                                    {{ Helpers::convertToPercent($feedbackdata['moic_attendance']) }}%
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="border-bottom: 1px solid #d8d8d8; padding: 0 15px;">
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td style="font-size: 14px;">
                                    @if($feedbackdata['feedback_for_doctor_availability'])
                                        {{ $feedbackdata['feedback_for_doctor_availability'] }}
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr style="font-family: 'Open Sans', sans-serif; font-family: 'Open Sans', sans-serif; font-size: 15px; color: #484848;">
                    <td style="border-bottom: 1px solid #d8d8d8; padding: 0 15px;">
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td width="50%" style="font-size: 14px;">
                                    <p>Medicine Availability</p>
                                    <p>क्या आपको लिखी दी हुई दवाइया मिली ?</p>
                                </td>
                                <td width="25%" align="center">
                                    <table class="red-col">
                                        <tr>
                                            <td align="center">
                                                @if($feedbackdata['people_responded_for_medicine_availability'])
                                                    {{ $feedbackdata['people_responded_for_medicine_availability'] }}
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="25%" align="center">
                                    <table class="yellow-col">
                                        <tr>
                                            <td align="center">
                                                @if($feedbackdata['patient_feedback_for_medicine_availibility'])
                                                    {{ Helpers::convertToPercent($feedbackdata['patient_feedback_for_medicine_availibility']) }}%</td>
                                                @endif
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="border-bottom: 1px solid #d8d8d8; padding: 0 15px;">
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td width="70%" align="center">Stock % against demand</td>
                                <td width="30%" align="center">
                                    <table class="yellow-col">
                                        <tr>
                                            <td align="center">
                                                @if($feedbackdata['stock_against_demand'])
                                                    {{ $feedbackdata['stock_against_demand'] }}%
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="border-bottom: 1px solid #d8d8d8; padding: 0 15px;">
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td style="font-size: 14px;">
                                    @if($feedbackdata['feedback_for_medicine_availability'])
                                        {{ $feedbackdata['feedback_for_medicine_availability'] }}
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr style="background-color: #f6f6f6;font-family: 'Open Sans', sans-serif; font-size: 15px; color: #484848;">
                    <td style="border-bottom: 1px solid #d8d8d8; padding: 0 15px;">
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td width="50%" style="font-size: 14px;">
                                    <p>Test Availability</p>
                                    <p>क्या आपको लिखी दी हुई दवाइया मिली ?</p>
                                </td>
                                <td width="25%" align="center">
                                    <table class="red-col">
                                        <tr>
                                            <td align="center">
                                                @if($feedbackdata['people_responded_for_test_availability'])
                                                    {{ $feedbackdata['people_responded_for_test_availability'] }}
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="25%" align="center">
                                    <table class="yellow-col">
                                        <tr>
                                            <td align="center">
                                            @if($feedbackdata['patient_feedback_score_for_test_availibility'])
                                                {{ Helpers::convertToPercent($feedbackdata['patient_feedback_score_for_test_availibility']) }}%
                                            @endif
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="border-bottom: 1px solid #d8d8d8; padding: 0 15px;">
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td width="70%" align="center">Type of tests conducted</td>
                                <td width="30%" align="center">
                                    <table class="red-col">
                                        <tr>
                                            <td align="center">
                                                @if($feedbackdata['types_of_test_conducted'])
                                                    {{ Helpers::convertToPercent($feedbackdata['types_of_test_conducted']) }}%
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="border-bottom: 1px solid #d8d8d8; padding: 0 15px;">
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td style="font-size: 14px;font-family: 'devanagariregular';">
                                    @if($feedbackdata['feedback_for_test_availability'])
                                        {{ $feedbackdata['feedback_for_test_availability'] }}
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr style="font-family: 'Open Sans', sans-serif; color: #484848;">
                    <td style="padding: 0 15px;">
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td width="50%" style="font-size: 14px;">
                                    <p>Patient Satisfaction</p>
                                    <p>क्या आपको लिखी दी हुई दवाइया मिली ?</p>
                                </td>
                                <td width="25%" align="center">
                                    <table class="red-col">
                                        <tr>
                                            <td align="center">
                                                @if ($feedbackdata['people_responded_for_patient_satisfaction'])
                                                    {{ $feedbackdata['people_responded_for_patient_satisfaction'] }}
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="25%" align="center">
                                    <table class="red-col">
                                        <tr>
                                            <td align="center">
                                                @if ($feedbackdata['patient_feedback_score_for_patient_satisfaction'])
                                                    {{ Helpers::convertToPercent($feedbackdata['patient_feedback_score_for_patient_satisfaction']) }}%
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="padding: 0 15px;">
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td width="70%" align="center"></td>
                                <td width="30%" align="center"></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="padding: 0 15px;">
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td style="font-size: 14px;">
                                   @if($feedbackdata['feedback_for_patient_satisfaction'])
                                       {{ $feedbackdata['feedback_for_patient_satisfaction'] }}
                                   @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>