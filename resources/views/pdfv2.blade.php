
<!DOCTYPE html>
<html style="margin:0; padding:0;">
<head>
<meta charset="UTF-8">
<title>ANM</title>
<style type="text/css" media="screen">
        /*@media all {
            .page-break{display:none;}
        }
        @media print {
            .page-break{display:block; page-break-before:always;}
        }*/
    </style>
</head>

<body style="padding: 0px; margin: 0px; font-family: Arial, Helvetica, sans-serif;"> 
    <!-- Main Header -->
    <div style="background-color: #17568F; padding:20px 10px;">
        <div style="width:95%; margin: 0 auto;">
            <h1 style="color: #ffffff; margin: 0px; font-size: 1.5em;">PHC {{$report->phc_name}} : Performance Review</h1>
            <h5 style="color: #ffffff; margin: 0px; font-size: 1.2em;">{{$months[$report->month]}} {{$report->year}}</h5>
            <div style="background-color: #ffffff; border-radius: 18px;">
                <ul style="list-style: none; padding-left: 0px; padding:20px;">
                    <li style="width:9%; display: inline-block; vertical-align:middle;">
                        <img src="images/trophy.png" width="40px" alt="" border="0" style="display: inline-block; margin-right:10px;">
                    </li>
                    <li style="width: 25%; display: inline-block; vertical-align:middle;">
                        <label style="font-size:0.9em; color: #11427d; margin: 0px; padding:0px;"><strong>PHC Ranking:</strong></label>
                    </li>
                    <li style="width: 25%; display: inline-block; vertical-align:middle;">
                        <p style="font-size:0.9em ; color: #11427d; margin: 0px; padding:0;"><strong>{{Helpers::ordinal($report->phc_rank_in_block)}}</strong> in block (of {{$report->phcs_in_the_block}})</p>
                    </li>
                    <li style="width: 25%; display: inline-block; vertical-align:middle;">
                            <p style="font-size:0.9em ; color: #11427d; margin: 0px;  padding:0;"><strong>{{Helpers::ordinal($report->phc_rank_in_district)}} </strong>in district (of {{$report->phcs_in_the_block}})</p>
                    </li>
                    <li style="width: 16%; display: inline-block; vertical-align:middle;">
                        <img src="images/mishaal-logo.png" class="img-responsive" style="height: 70px;width: 70px;">
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Main Header -->

    <br>
    <br>
    <div style="background-color: #fff;">
        <div style="width:95%; margin: 0 auto;">
            <!-- Table Header -->
            <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
               <li style="background-color: #3d9bd8; font-size:0.8em; color: #fff; display: table-cell; padding: 10px 20px; text-align: center; width: 40%;">{{$months[$report->month]}} {{$report->year}} Report Card</li>
               <li style="background-color: #69b0e1; font-size:0.8em; color: #fff; display: table-cell; padding: 10px 20px; text-align: center; width: 24%;">MOIC Name: {{$report->moic_name}}</li>
               <li style="background-color: #c7c7c7; font-size:0.8em; color: #fff; display: table-cell; padding: 10px 20px; text-align: center; width: 36%;">Best Performing PHC</li>
            </ul>
            <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width:100%;">
                <li style="font-size:0.7em; font-weight:bold; color: #025fad; display: table-cell; padding:5px 20px; margin:0px; text-align: center; width: 15%">Program</li>
                <li style="font-size:0.7em; font-weight:bold; color: #025fad; display: table-cell; padding: 5px 20px; margin:0px;  text-align: center; width: 25%">Metric</li>
                <li style="font-size:0.7em; font-weight:bold; color: #025fad; display: table-cell; padding: 5px 20px; margin:0px;  text-align: center; width: 25%">Max score that can be achieved</li>
                <li style="font-size:0.7em; font-weight:bold; color: #025fad; display: table-cell; padding: 5px 20px; margin:0px;  text-align: center; width: 25%">Score achieved</li>
                <li style="font-size:0.7em; font-weight:bold; color: #670f31; display: table-cell; padding: 5px 20px; margin:0px;  text-align: center; width: 12%">Target</li>
                <li style="font-size:0.7em; font-weight:bold; color: #025fad; display: table-cell; padding: 5px 20px; margin:0px;  text-align: center; width: 12%">{{$months[$report->month]}}'s {{$report->year}} Performance</li>
                <li style="font-size:0.7em; font-weight:bold; color: #03522d; display: table-cell; padding: 5px 20px; margin:0px;  text-align: center; width: 12%">In the block   </li>
                <li style="font-size:0.7em; font-weight:bold; color: #03522d; display: table-cell; padding: 5px 20px;  margin:0px; text-align: center; width: 12%">In Alwar   </li>
                <li style="font-size:0.7em; font-weight:bold; color: #03522d; display: table-cell; padding: 5px 20px;  margin:0px; text-align: center; width: 12%">In Rajasthan </li>
            </ul>
            <!-- Table Header -->


            <!-- Table Row Utilization-->
            <div style="display: table; table-layout: fixed; padding: 0px; width: 100%;  border: 1px solid #d1d1d1; margin-bottom: 20px;">
                <div style="display: table-cell; font-size:0.7em; font-weight:bold; width: 15%; padding:5px 20px; text-align: center; vertical-align: middle; color: #fff; background-color: #2a9dd0">
                   <p>Utilization</p>
                </div>
                <div style="display: table-cell; width: 85%;">
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell; padding:5px 20px;  margin:0px; text-align: center; width: 25%">OPDs/day (>40)</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell; padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->opd_max_score_achieved, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell; padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->opd_score_achieved, 1, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell; padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->opd_target, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell; padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->opd_performance, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell; padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->opd_block, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell; padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->opd_district, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell; padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->opd_state, 0, '.' ,'') }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell; padding:5px 20px;  margin:0px; text-align: center; width: 25%">Proportion of Institutional Delivery</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pid_max_score_achieved, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pid_score_achieved, 1, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pid_target, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pid_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pid_block, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pid_district, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pid_state, 0, '.' ,'') }}%</li>
                    </ul>
                </div>
            </div>

            <!-- Table Row RMNCH + A div-->
            <div style="display: table; table-layout: fixed; padding: 0px; width: 100%;  border: 1px solid #d1d1d1; margin-bottom: 20px;">
                <div style="display: table-cell; width: 15%; font-size:0.7em; font-weight:bold;  padding:5px 20px;  margin:0px; text-align: center; vertical-align: middle; color: #fff; background:#2a9dd0">
                    <p>RMNCH + A</p>
                </div>
                <div style="display: table-cell; width: 85%;">
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Full Immunization Coverage * </li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fic_max_score_achieved, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fic_score_achieved, 1, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fic_target, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fic_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fic_block, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fic_district, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fic_state, 0, '.' ,'') }}%</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">ANC 3 Coverage * </li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc3_max_score_achieved, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc3_score_achieved, 1, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc3_target, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc3_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc3_block, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc3_district, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc3_state, 0, '.' ,'') }}%</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">ANC 4 Coverage * </li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc4_max_score_achieved, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc4_score_achieved, 1, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc4_target, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc4_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc4_block, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc4_district, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc4_state, 0, '.' ,'') }}%</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">ANC Registration (within 12 weeks) * </li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc12_max_score_achieved, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc12_score_achieved, 1, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc12_target, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc12_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc12_block, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc12_district, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->anc12_state, 0, '.' ,'') }}%</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Proportion of LBW among new born</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->plb_max_score_achieved, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->plb_score_achieved, 1, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ $report->plb_target }}</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->plb_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->plb_block, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->plb_district, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->plb_state, 0, '.' ,'') }}%</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">FP - IUCD Insertion %</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fpiucd_max_score_achieved, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fpiucdscore_achieved, 1, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fpiucd_target, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fpiucd_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fpiucd_block, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fpiucd_district, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fpiucd_state, 0, '.' ,'') }}%</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">FP - PPIUCD Insertion %</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->ppiucd_max_score_achieved, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->ppiucd_score_achieved, 1, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->ppiucd_target, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->ppiucd_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->ppiucd_block, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->ppiucd_district, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->ppiucd_state, 0, '.' ,'') }}%</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">FP - Sterilization %</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fp_max_score_achieved, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fp_score_achieved, 1, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fp_sterilization_target, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fp_sterilization_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fp_sterilization_block, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fp_sterilization_district, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fp_sterilization_state, 0, '.' ,'') }}%</li>
                    </ul>
                </div>
            </div>

            <!--CDs div-->
            <div style="display: table; table-layout: fixed; padding: 0px; width: 100%;  border: 1px solid #d1d1d1; margin-bottom: 20px;">
                <div style="display: table-cell; width: 15%; font-size:0.7em; font-weight:bold;  padding:5px 20px;  margin:0px; text-align: center; vertical-align: middle; color: #fff; background:#2a9dd0">
                    <p>CDs</p>
                </div>
                <div style="display: table-cell; width: 85%;">
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Pneumonia prevalence</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pneumonia_max_score_achieved, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pneumonia_score_achieved, 1, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pneumonia_target, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pneumonia_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pneumonia_block, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pneumonia_district, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pneumonia_state, 0, '.' ,'') }}%</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Malaria slides collected</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->malaria_max_score_achieved, 0, '.' ,'')  }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->malaria_score_achieved, 1, '.' ,'')  }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->malaria_target, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->malaria_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->malaria_block, 0, '.' ,'')  }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->malaria_district, 0, '.' ,'')  }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->malaria_state, 0, '.' ,'')  }}%</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Diarrhea prevalence</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->diarrhea_max_score_achieved, 0, '.' ,'')  }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->diarrhea_score_achieved, 1, '.' ,'')  }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->diarrhea_target, 0, '.' ,'')  }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->diarrhea_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->diarrhea_block, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->diarrhea_district, 0, '.' ,'')  }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->diarrhea_state, 0, '.' ,'')  }}%</li>
                    </ul>

                    {{--<ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">--}}
                        {{--<li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Dengue</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->dengue_max_score_achieved)  }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->dengue_score_achieved)  }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->dengue_target)  }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->dengue_performance)  }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->dengue_block) }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->dengue_district)  }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->dengue_state)  }}</li>--}}
                    {{--</ul>--}}
                </div>
            </div>

            <!-- NCD's div-->
            {{--<div style="display: table; table-layout: fixed; padding: 0px; width: 100%;  border: 1px solid #d1d1d1; margin-bottom: 20px;">--}}
                {{--<div style="display: table-cell; width: 15%; font-size:0.7em; font-weight:bold;  padding:5px 20px;  margin:0px; text-align: center; vertical-align: middle; color: #fff; background:#2a9dd0">--}}
                    {{--<p>NCDs</p>--}}
                {{--</div>--}}
                {{--<div style="display: table-cell; width: 85%;">--}}
                    {{--<ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">--}}
                        {{--<li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">prevalence (old and new cases) %Hypertension</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->hp_max_score_achieved)  }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->hp_score_achieved)  }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->hp_target) }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->hp_performance) }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->hp_block)  }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->hp_district)  }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->hp_state)  }}</li>--}}
                    {{--</ul>--}}
                    {{--<ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">--}}
                        {{--<li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Diabetes prevalence (old and new cases) %</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->diabetes_max_score_achieved)  }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->diabetes_score_achieved)  }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->diabetes_target) }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->diabetes_performance) }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->diabetes_block)  }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->diabetes_district)  }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->diabetes_state)  }}</li>--}}
                    {{--</ul>--}}
                    {{--<ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">--}}
                        {{--<li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">CVD diagnosis (old and new cases) %</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->cvd_max_score_achieved)  }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->cvd_score_achieved)  }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->cvd_target) }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->cvd_performance) }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->cvd_block) }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->cvd_district)  }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->cvd_state)  }}</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div style="display:block; page-break-before:always;"></div>

            <!--Gevernance div -->
            <div style="display: table; table-layout: fixed; padding: 0px; width: 100%;  border: 1px solid #d1d1d1; margin-bottom: 20px;">
                <div style="display: table-cell; width: 15%; font-size:0.7em; font-weight:bold;  padding:5px 20px;  margin:0px; text-align: center; vertical-align: middle; color: #fff; background:#2a9dd0">
                    <p>Governance</p>
                </div>
                <div style="display: table-cell; width: 85%;">
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%"># Days patient vouchers were updated this month </li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->days_patient_voucher_max_score_achieved, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->days_patient_voucher_score_achieved, 1, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->days_patient_voucher_target, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->days_patient_voucher_performance, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->days_patient_voucher_block, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->days_patient_voucher_district, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->days_patient_voucher_state, 0, '.' ,'') }}</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">% Patient Vouchers recorded vs OPD for the month</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->patient_vouchers_max_score_achieved, 0, '.' ,'')  }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->patient_vouchers_score_achieved, 1, '.' ,'')  }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->patient_vouchers_target, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->patient_vouchers_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->patient_vouchers_block, 0, '.' ,'')  }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->patient_vouchers_district, 0, '.' ,'')  }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->patient_vouchers_state, 0, '.' ,'')  }}%</li>
                    </ul>
                    {{--<ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">--}}
                        {{--<li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">CVD diagnosis (old and new cases) %</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->cvd_max_score_achieved)  }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->cvd_score_achieved)  }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->cvd_target) }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->cvd_performance) }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->cvd_block) }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->cvd_district)  }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->cvd_state)  }}</li>--}}
                    {{--</ul>--}}
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Med Availability >80% &verified by Patient Feedback</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->med_avail_feedback_max_score_achieved, 0, '.' ,'')  }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->med_avail_feedback_score_achieved, 1, '.' ,'')  }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->med_avail_feedback_target, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->med_avail_feedback_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->med_avail_feedback_block, 0, '.' ,'')  }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->med_avail_feedback_district, 0, '.' ,'')  }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->med_avail_feedback_state, 0, '.' ,'')  }}%</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Test Availability >80% & verified by Patient Feedback </li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->test_avail_feedback_max_score_achieved, 0, '.' ,'')  }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->test_avail_feedback_score_achieved, 1, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->test_avail_target, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->test_avail_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->test_avail_block, 0, '.' ,'')  }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->test_avail_district, 0, '.' ,'')  }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->test_avail_state, 0, '.' ,'') }}%</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Doctor Attendance >80% & verified by Patient Feedback</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->doc_avail_feedback_max_score_achieved, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->doc_avail_feedback_score_achieved, 1, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->doc_avail_target, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->doc_avail_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->doc_avail_block, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->doc_avail_district, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->doc_avail_state, 0, '.' ,'') }}%</li>
                    </ul>
                    {{--<ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">--}}
                        {{--<li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Rajdhara: % Fill Rate</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->rajdharaa_max_score_achieved) }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->rajdharaa_score_achieved) }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->rajdhara_target) }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->rajdhara_performance) }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->rajdhara_block) }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->rajdhara_district) }}</li>--}}
                        {{--<li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ Helpers::convertToPercent($report->rajdhara_state) }}</li>--}}
                    {{--</ul>--}}
                </div>
            </div>

            <!--Reporting div-->
            <div style="display: table; table-layout: fixed; padding: 0px; width: 100%;  border: 1px solid #d1d1d1; margin-bottom: 20px;">
                <div style="display: table-cell; width: 15%; font-size:0.7em; font-weight:bold;  padding:5px 20px;  margin:0px; text-align: center; vertical-align: middle; color: #fff; background:#2a9dd0">
                    <p>Reporting</p>
                </div>
                <div style="display: table-cell; width: 85%;">
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Pregnant Women registered on PCTS - line list vs. expected PW</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->linelist_vs_expected_max_score_achieved, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->linelist_vs_expected_score_achieved, 1, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->linelist_vs_expected_target, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->linelist_vs_expected_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->linelist_vs_expected_block, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->linelist_vs_expected_district, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->linelist_vs_expected_state, 0, '.' ,'') }}%</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Live births registered on PCTS vs. expected * </li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pcts_vs_expected_max_score_achieved, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pcts_vs_expected_score_achieved, 1, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pcts_vs_expected_target, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pcts_vs_expected_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pcts_vs_expected_block, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pcts_vs_expected_district, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->pcts_vs_expected_state, 0, '.' ,'') }}%</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Institutional Deliveries (Summary(Form6,7) - LL) * </li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->id_max_score_achieved, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->id_score_achieved, 1, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->id_target, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->id_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->id_block, 0, '.' ,'')}}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->id_district, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->id_state, 0, '.' ,'') }}%</li>
                    </ul>
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 25%">Full Immunization (Summary – Line List) </li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fi_max_score_achieved, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fi_score_achieved, 1, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fi_target, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fi_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fi_block, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fi_district, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 12%">{{ number_format((float)$report->fi_state, 0, '.' ,'') }}%</li>
                    </ul>
                </div>
            </div>

            <!-- patient satisfaction score -->
            <div style="display: table; table-layout: fixed; padding: 0px; width: 100%;  border: 1px solid #d1d1d1; margin-bottom: 20px;">
                <div style="display: table-cell; width: 40%; font-size:0.7em; font-weight:bold;  padding:5px 20px;  margin:0px; text-align: center; vertical-align: middle; color: #fff; background:#2a9dd0">
                    <p>Patient Satisfaction Score</p>
                </div>
                <div style="display: table-cell; width: 60%;">
                    <ul style="list-style: none; display: table; table-layout: fixed; padding: 0px; margin:0px; width: 100%;">
                        <li style="font-size: 0.6em; color: #000; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 14%">{{ number_format((float)$report->patient_satisfaction_max_score_achieved, 0, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 14%">{{ number_format((float)$report->patient_satisfaction_score_achieved, 1, '.' ,'') }}</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 14%">{{ number_format((float)$report->patient_satisfaction_cut_off, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #670f31; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 14%">{{ number_format((float)$report->patient_satisfaction_performance, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #025fad; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 14%">{{ number_format((float)$report->patient_satisfaction_block, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 15%">{{ number_format((float)$report->patient_satisfaction_district, 0, '.' ,'') }}%</li>
                        <li style="font-size: 0.6em; color: #03522d; display: table-cell;  padding:5px 20px;  margin:0px; text-align: center; width: 15%">{{ number_format((float)$report->patient_satisfaction_state, 0, '.' ,'') }}%</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</body>

</html>