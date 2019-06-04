<!DOCTYPE html>
<html>
   <head>
      <title></title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      {{--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">--}}
      <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
      {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}">--}}
   </head>
   <body class="internal-page">
      <header class="internal-header navbar-fixed-top">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h4>PHC {{$report->phc_name}} : Performance Review</h4>
                  <div class="date-area">{{$months[$report->month]}} {{$report->year}}</div>
               </div>
            </div>
            <div class="box-area mt-1">
               <div class="row">
                  <div class="col-md-12 performance-review-area">
                     <div class="phc-ranking-title">
                        <img src="{{asset('images/trophy-icon.png')}}" alt="" border="0"> 
                        PHC Ranking:
                     </div>
                     <div class="phc-ranking-content"> 
                        {{Helpers::ordinal($report->phc_rank_in_block)}} <span>in block (of {{$report->phcs_in_the_block}})</span>
                     </div>
                     <div class="phc-ranking-content">
                        {{Helpers::ordinal($report->phc_rank_in_district)}} <span>in district (of {{$report->phcs_in_the_district}})</span>
                     </div>
                     <div class="site-logo pull-right">
                        <img src="{{asset('images/mishaal-logo.png')}}" class="img-responsive" style="height: 72px;margin: 5px 0;">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- <section class="reports-area navbar-fixed-top">
         <div class="container">
         	<div class="row">
         		<div class="col-md-12">
         			<div class="outer-area">
         				<div class="inner-area">
         					<table width="100%" class="table report-card-table fancy-table">
         						<tr>
         							<td colspan="2" class="blue-bg">{{$months[$report->month]}} 2018 Report Card</td>
         							<td colspan="4">MOIC Name: {{$report->moic_name}}</td>
         							<td colspan="3" class="grey-bg">Best Performing PHC</td>
         						</tr>
         						<tr>
         							<td width="10%" class="dark-blue">Program</td>
         							<td width="20%" class="text-left dark-blue" align="left">Metric</td>
         							<td width="12%" class="velvet-color">Max scene that can be achieved</td>
         							<td width="9%" class="velvet-color">Scene achieved</td>
         							<td width="10%" class="velvet-color">Target</td>
         							<td width="9%" class="blue">May'18 Performance</td>
         							<td width="10%" class="dark-green">In the block</td>
         							<td width="10%" class="dark-green">In Alwar</td>
         							<td width="10%" class="dark-green">In Rajasthan</td>
         						</tr>
         					</table>
         				</div>
         			</div>
         		</div>
         	</div>
         </div>
         </section> -->
      <section class="internal-table-area">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                    <div class="outer-area">
                       <div class="inner-area">
                       	<div class="reports-area navbar-fixed-top">
                          	<div class="container">
                          		<table width="100%" class="table report-card-table fancy-table">
	                             <tr>
	                                <td colspan="2" class="blue-bg">{{$months[$report->month]}} {{$report->year}} Report Card</td>
	                                <td colspan="4">MOIC Name: {{$report->moic_name}}</td>
	                                <td colspan="3" class="grey-bg">Best Performing PHC</td>
	                             </tr>
	                             <tr>
	                                <td width="10%" class="dark-blue">Program</td>
	                                <td width="20%" class="text-left dark-blue" align="left">Metric</td>
	                                <td width="12%" class="velvet-color">Max score that can be achieved</td>
	                                <td width="9%" class="velvet-color">Score achieved</td>
	                                <td width="10%" class="velvet-color">Target</td>
	                                <td width="9%" class="blue">{{$months[$report->month]}} {{$report->year}} Performance</td>
	                                <td width="10%" class="dark-green">Best in block</td>
	                                <td width="10%" class="dark-green">Best in Alwar</td>
	                               {{-- <td width="10%" class="dark-green">Best in Rajasthan</td>--}}
	                             </tr>
	                          </table>
                          	</div>
                          </div>
                          <table width="100%" class="table fancy-table">
                             <tr data-title-attribute="{{$months[$report->month]}} {{$report->year}} Report Card">
                                <th width="10%" rowspan="2" valign="middle" data-title-attribute="Program">Utilization</th>
                                <td width="20%" data-title-attribute="Metric">OPDs/day (>40)</td>
                                <td width="12%" data-title-attribute="Max score that can be achieved" class="velvet-color">{{ number_format((float)$report->opd_max_score_achieved, 0, '.' ,'') }}</td>
                                <td width="9%" data-title-attribute="Score achieved" class="velvet-color">{{ number_format((float)$report->opd_score_achieved, 1, '.' ,'') }}</td>
                                <td width="10%" data-title-attribute="Target" class="velvet-color">{{ number_format((float)$report->opd_target, 0, '.' ,'') }}</td>
                                <td width="9%" data-title-attribute="May'18 Performance" class="blue">{{ number_format((float)$report->opd_performance, 0, '.' ,'') }}</td>
                                <td width="10%" data-title-attribute="In the block" class="dark-green">{{ number_format((float)$report->opd_block, 0, '.' ,'') }}</td>
                                <td width="10%" data-title-attribute="In Alwar" class="dark-green">{{ number_format((float)$report->opd_district, 0, '.' ,'') }}</td>
                               {{-- <td width="10%" data-title-attribute="In Rajasthan" class="dark-green">{{ number_format((float)$report->opd_state, 0, '.' ,'') }}</td>--}}
                             </tr>
                             <tr>
                                <td data-title-attribute="Metric">% Institutional Deliveries</td>
                                <td data-title-attribute="Max score that can be achieved" class="velvet-color">{{ number_format((float)$report->pid_max_score_achieved, 0, '.' ,'') }}</td>
                                <td data-title-attribute="Score achieved" class="velvet-color">{{ number_format((float)$report->pid_score_achieved, 1, '.' ,'') }}</td>
                                <td data-title-attribute="Target" class="velvet-color">{{ number_format((float)$report->pid_target, 0, '.' ,'') }}%</td>
                                <td data-title-attribute="May'18 Performance" class="blue">{{ number_format((float)$report->pid_performance, 0, '.' ,'') }}%</td>
                                <td data-title-attribute="In the block" class="dark-green">{{ number_format((float)$report->pid_block, 0, '.' ,'') }}%</td>
                                <td data-title-attribute="In Alwar" class="dark-green">{{ number_format((float)$report->pid_district, 0, '.' ,'') }}%</td>
                               {{-- <td data-title-attribute="In Rajasthan" class="dark-green">{{ number_format((float)$report->pid_state, 0, '.' ,'') }}%</td>--}}
                             </tr>
                          </table>
                          <table width="100%" class="table fancy-table">

                             <tr data-title-attribute="{{$months[$report->month]}} {{$report->year}} Report Card">
                                <th width="10%" rowspan="8" valign="middle">RMNCH + A</th>
                                <td width="20%">% Full Immunization</td>
                                <td width="12%" class="velvet-color">{{ number_format((float)$report->fic_max_score_achieved, 0, '.' ,'') }}</td>
                                <td width="9%" class="velvet-color">{{ number_format((float)$report->fic_score_achieved, 1, '.' ,'') }}</td>
                                <td width="10%" class="velvet-color">{{ number_format((float)$report->fic_target, 0, '.' ,'') }}%</td>
                                <td width="9%" class="blue">{{ number_format((float)$report->fic_performance, 0, '.' ,'') }}%</td>
                                <td width="10%" class="dark-green">{{ number_format((float)$report->fic_block, 0, '.' ,'') }}%</td>
                                <td width="10%" class="dark-green">{{ number_format((float)$report->fic_district, 0, '.' ,'') }}%</td>
                                {{--<td width="10%" class="dark-green">{{ number_format((float)$report->fic_state, 0, '.' ,'') }}%</td>--}}
                             </tr>

                             <tr>
                                <td>ANC 3 Coverage  </td>
                                <td class="velvet-color">{{ number_format((float)$report->anc3_max_score_achieved, 0, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->anc3_score_achieved, 1, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->anc3_target, 0, '.' ,'') }}%</td>
                                <td class="blue">{{ number_format((float)$report->anc3_performance, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->anc3_block, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->anc3_district, 0, '.' ,'') }}%</td>
                                {{--<td class="dark-green">{{ number_format((float)$report->anc3_state, 0, '.' ,'') }}%</td>--}}
                             </tr>
                             <tr>
                                <td>ANC 4 Coverage  </td>
                                <td class="velvet-color">{{ number_format((float)$report->anc4_max_score_achieved, 0, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->anc4_score_achieved, 1, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->anc4_target, 0, '.' ,'') }}%</td>
                                <td class="blue">{{ number_format((float)$report->anc4_performance, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->anc4_block, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->anc4_district, 0, '.' ,'') }}%</td>
                                {{--<td class="dark-green">{{ number_format((float)$report->anc4_state, 0, '.' ,'') }}%</td>--}}
                             </tr>
                             <tr>
                                <td>ANC Registration (within 12 weeks)  </td>
                                <td class="velvet-color">{{ number_format((float)$report->anc12_max_score_achieved, 0, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->anc12_score_achieved, 1, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->anc12_target, 0, '.' ,'') }}%</td>
                                <td class="blue">{{ number_format((float)$report->anc12_performance, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->anc12_block, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->anc12_district, 0, '.' ,'') }}%</td>
                                {{--<td class="dark-green">{{ number_format((float)$report->anc12_state, 0, '.' ,'') }}%</td>--}}
                             </tr>


                             <tr>
                                <td>Proportion of LBW among new born</td>
                                <td class="velvet-color">{{ number_format((float)$report->plb_max_score_achieved, 0, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->plb_score_achieved, 1, '.' ,'') }}</td>
                                <td class="velvet-color">{{ $report->plb_target }}</td>
                                <td class="blue">{{ number_format((float)$report->plb_performance, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->plb_block, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->plb_district, 0, '.' ,'') }}%</td>
                                {{--<td class="dark-green">{{ number_format((float)$report->plb_state, 0, '.' ,'') }}%</td>--}}
                             </tr>



                             <tr>
                                <td>IUCD Insertion %</td>
                                <td class="velvet-color">{{ number_format((float)$report->fpiucd_max_score_achieved, 0, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->fpiucdscore_achieved, 1, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->fpiucd_target, 0, '.' ,'') }}%</td>
                                <td class="blue">{{ number_format((float)$report->fpiucd_performance, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->fpiucd_block, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->fpiucd_district, 0, '.' ,'') }}%</td>
                                {{--<td class="dark-green">{{ number_format((float)$report->fpiucd_state, 0, '.' ,'') }}%</td>--}}
                             </tr>
                             <tr>
                                <td>PPIUCD Insertion %</td>
                                <td class="velvet-color">{{ number_format((float)$report->ppiucd_max_score_achieved, 0, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->ppiucd_score_achieved, 1, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->ppiucd_target, 0, '.' ,'') }}%</td>
                                <td class="blue">{{ number_format((float)$report->ppiucd_performance, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->ppiucd_block, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->ppiucd_district, 0, '.' ,'') }}%</td>
                                {{--<td class="dark-green">{{ number_format((float)$report->ppiucd_state, 0, '.' ,'') }}%</td>--}}
                             </tr>
                             <tr>
                                <td>Sterilization %</td>
                                <td class="velvet-color">{{ number_format((float)$report->fp_max_score_achieved, 0, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->fp_score_achieved, 1, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->fp_sterilization_target, 0, '.' ,'') }}%</td>
                                <td class="blue">{{ number_format((float)$report->fp_sterilization_performance, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->fp_sterilization_block, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->fp_sterilization_district, 0, '.' ,'') }}%</td>
                               {{-- <td class="dark-green">{{ number_format((float)$report->fp_sterilization_state, 0, '.' ,'') }}%</td>--}}
                             </tr>
                          </table>

                          <table width="100%" class="table fancy-table">
                             <tr data-title-attribute="{{$months[$report->month]}} {{$report->year}} Report Card">
                                <th width="10%" rowspan="3" valign="middle">NCDs</th>
                                <td width="21%">%Hypertension prevalence</td>
                                <td width="12%" class="velvet-color">{{ number_format((float)$report->hp_max_score_achieved, 0, '.' ,'') }}</td>
                                <td width="10%" class="velvet-color">{{ number_format((float)$report->hp_score_achieved, 1, '.' ,'') }}</td>
                                <td width="10%" class="velvet-color">{{ number_format((float)$report->hp_target, 0, '.' ,'') }}</td>
                                <td width="10%" class="blue">{{ number_format((float)$report->hp_performance, 1, '.' ,'') }}</td>
                                <td width="10%" class="dark-green">{{ number_format((float)$report->hp_block, 1, '.' ,'') }}</td>
                                <td width="10%" class="dark-green">{{ number_format((float)$report->hp_district, 1, '.' ,'') }}</td>
                                {{--<td width="10%" class="dark-green">{{ $report->hp_state }}</td>--}}
                             </tr>
                             
                             <tr>
                                <td>%Diabetes prevalence</td>
                                <td class="velvet-color">{{ number_format((float)$report->diabetes_max_score_achieved, 0, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->diabetes_score_achieved, 1, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->diabetes_target, 0, '.' ,'') }}</td>
                                <td class="blue">{{ number_format($report->diabetes_performance, 1, '.' ,'') }}</td>
                                <td class="dark-green">{{ number_format((float)$report->diabetes_block, 1, '.' ,'') }}</td>
                                <td class="dark-green">{{ number_format((float)$report->diabetes_district, 1, '.' ,'') }}</td>
                               {{-- <td class="dark-green">{{ $report->diabetes_state }}</td>--}}
                             </tr>
                             <tr>
                                <td>%CVD diagnosis</td>
                                <td class="velvet-color">{{ number_format((float)$report->cvd_max_score_achieved, 0, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->cvd_score_achieved, 1, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->cvd_target, 0, '.' ,'') }}</td>
                                <td class="blue">{{ number_format((float)$report->cvd_performance, 1, '.' ,'') }}</td>
                                <td class="dark-green">{{ number_format((float)$report->cvd_block, 1, '.' ,'') }}</td>
                                <td class="dark-green">{{ number_format((float)$report->cvd_district, 1, '.' ,'') }}</td>
                              {{--  <td class="dark-green">{{ $report->cvd_state }}</td>--}}
                             </tr>
                          </table>

                          <table width="100%" class="table fancy-table">
                             <tr data-title-attribute="{{$months[$report->month]}} {{$report->year}} Report Card">
                                <th width="10%" rowspan="4" valign="middle">CDs</th>
                                <td width="20%">Pneumonia prevalence</td>
                                <td width="12%" class="velvet-color">{{ number_format((float)$report->pneumonia_max_score_achieved, 0, '.' ,'') }}</td>
                                <td width="9%" class="velvet-color">{{ number_format((float)$report->pneumonia_score_achieved, 1, '.' ,'') }}</td>
                                <td width="10%" class="velvet-color">{{ number_format($report->pneumonia_target, 2, '.' ,'') }}%</td>
                                <td width="9%" class="blue">{{ number_format($report->pneumonia_performance, 2, '.' ,'') }}%</td>
                                <td width="10%" class="dark-green">{{  number_format($report->pneumonia_block, 2, '.' ,'') }}%</td>
                                <td width="10%" class="dark-green">{{   number_format($report->pneumonia_district, 2, '.' ,'') }}%</td>
                                {{--<td width="10%" class="dark-green"> {{  number_format($report->pneumonia_state, 2, '.' ,'') }}%</td>--}}
                             </tr>
                             <tr>
                                <td>% Malaria slides collected</td>
                                <td class="velvet-color">{{ number_format((float)$report->malaria_max_score_achieved, 0, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->malaria_score_achieved, 1, '.' ,'')}}</td>
                                <td class="velvet-color">{{ number_format((float)$report->malaria_target, 0, '.' ,'') }}%</td>
                                <td class="blue">{{ number_format((float)$report->malaria_performance, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->malaria_block, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->malaria_district, 0, '.' ,'') }}%</td>
                                {{--<td class="dark-green">{{ number_format((float)$report->malaria_state, 0, '.' ,'') }}%</td>--}}
                             </tr>

                             <tr>
                                <td>Diarrhea prevalence</td>
                                <td class="velvet-color">{{ number_format((float)$report->diarrhea_max_score_achieved, 0, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->diarrhea_score_achieved, 1, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format($report->diarrhea_target, 2, '.' ,'') }}%</td>
                                <td class="blue">{{ number_format($report->diarrhea_performance, 2, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format($report->diarrhea_block, 2, '.' ,'')}}%</td>
                                <td class="dark-green">{{ number_format($report->diarrhea_district, 2, '.' ,'') }}%</td>
                                {{--<td class="dark-green">{{ number_format($report->diarrhea_state, 2, '.' ,'') }}%</td>--}}
                             </tr>
                          </table>

                          <table width="100%" class="table fancy-table">
                             <tr data-title-attribute="{{$months[$report->month]}} {{$report->year}} Report Card">
                                <th width="10%" rowspan="6" valign="middle">Governance</th>
                                <td width="20%"># Days patient vouchers were updated</td>
                                <td width="12%" class="velvet-color">{{ number_format((float)$report->days_patient_voucher_max_score_achieved, 0, '.' ,'') }}</td>
                                <td width="9%" class="velvet-color">{{ number_format((float)$report->days_patient_voucher_score_achieved, 1, '.' ,'') }}</td>
                                <td width="10%" class="velvet-color">{{ number_format((float)$report->days_patient_voucher_target, 0, '.' ,'') }}</td>
                                <td width="9%" class="blue">{{ number_format((float)$report->days_patient_voucher_performance, 0, '.' ,'') }}</td>
                                <td width="10%" class="dark-green">{{ number_format((float)$report->days_patient_voucher_block, 0, '.' ,'') }}</td>
                                <td width="10%" class="dark-green">{{ number_format((float)$report->days_patient_voucher_district, 0, '.' ,'') }}</td>
                               {{-- <td width="10%" class="dark-green">{{ number_format((float)$report->days_patient_voucher_state, 0, '.' ,'') }}</td>--}}
                             </tr>



                             <tr>
                                <td>% Patient Vouchers recorded vs OPD</td>
                                <td class="velvet-color">{{ number_format((float)$report->patient_vouchers_max_score_achieved, 0, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->patient_vouchers_score_achieved, 1, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->patient_vouchers_target, 0, '.' ,'') }}%</td>
                                <td class="blue">{{ number_format((float)$report->patient_vouchers_performance, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->patient_vouchers_block, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->patient_vouchers_district, 0, '.' ,'') }}%</td>
                               {{-- <td class="dark-green">{{ number_format((float)$report->patient_vouchers_state, 0, '.' ,'') }}%</td>--}}
                             </tr>
                             <tr>
                                <td>Med Availability >80%</td>
                                <td class="velvet-color">{{ number_format((float)$report->med_avail_feedback_max_score_achieved, 0, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->med_avail_feedback_score_achieved, 1, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->med_avail_feedback_target, 0, '.' ,'') }}%</td>
                                <td class="blue">{{ number_format((float)$report->med_avail_feedback_performance, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->med_avail_feedback_block, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->med_avail_feedback_district, 0, '.' ,'') }}%</td>
                               {{-- <td class="dark-green">{{ number_format((float)$report->med_avail_feedback_state, 0, '.' ,'') }}%</td>--}}
                             </tr>
                             <tr>
                                <td>Test Availability >80%</td>
                                <td class="velvet-color">{{ number_format((float)$report->test_avail_feedback_max_score_achieved, 0, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->test_avail_feedback_score_achieved, 1, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->test_avail_target, 0, '.' ,'') }}%</td>
                                <td class="blue">{{ number_format((float)$report->test_avail_performance, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->test_avail_block, 0, '.' ,'') }}%</td>
                                <td>{{ number_format((float)$report->test_avail_district, 0, '.' ,'') }}%</td>
                                {{--<td>{{ number_format((float)$report->test_avail_state, 0, '.' ,'')}}%</td>--}}
                             </tr>
                             <tr>
                                <td>Doctor Attendance > 80%</td>
                                <td class="velvet-color">{{ number_format((float)$report->doc_avail_feedback_max_score_achieved, 0, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->doc_avail_feedback_score_achieved, 1, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->doc_avail_target, 0, '.' ,'') }}%</td>
                                <td class="blue">{{ number_format((float)$report->doc_avail_performance, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->doc_avail_block, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->doc_avail_district, 0, '.' ,'') }}%</td>
                               {{-- <td class="dark-green">{{ number_format((float)$report->doc_avail_state, 0, '.' ,'') }}%</td>--}}
                             </tr>

                          </table>
                          <table width="100%" class="table fancy-table">
                             <tr data-title-attribute="{{$months[$report->month]}} {{$report->year}} Report Card">
                                <th width="10%" rowspan="4" valign="middle">Reporting</th>
                                <td width="20%">Pregnant Women registered on PCTS - line list vs. expected PW </td>
                                <td width="12%" class="velvet-color">{{ number_format((float)$report->linelist_vs_expected_max_score_achieved, 0, '.' ,'') }}</td>
                                <td width="9%" class="velvet-color">{{ number_format((float)$report->linelist_vs_expected_score_achieved, 1, '.' ,'') }}</td>
                                <td width="10%" class="velvet-color">{{ number_format((float)$report->linelist_vs_expected_target, 0, '.' ,'') }}%</td>
                                <td width="9%" class="blue">{{ number_format((float)$report->linelist_vs_expected_performance, 0, '.' ,'') }}%</td>
                                <td width="10%" class="dark-green">{{ number_format((float)$report->linelist_vs_expected_block, 0, '.' ,'') }}%</td>
                                <td width="10%" class="dark-green">{{ number_format((float)$report->linelist_vs_expected_district, 0, '.' ,'') }}%</td>
                                {{--<td width="10%" class="dark-green">{{ number_format((float)$report->linelist_vs_expected_state, 0, '.' ,'') }}%</td>--}}
                             </tr>
                             <tr>
                                <td>Live births registered on PCTS vs. expected  </td>
                                <td class="velvet-color">{{ number_format((float)$report->pcts_vs_expected_max_score_achieved, 0, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->pcts_vs_expected_score_achieved, 1, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->pcts_vs_expected_target, 0, '.' ,'') }}%</td>
                                <td class="blue">{{ number_format((float)$report->pcts_vs_expected_performance, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->pcts_vs_expected_block, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->pcts_vs_expected_district,0, '.' ,'') }}%</td>
                               {{-- <td class="dark-green">{{ number_format((float)$report->pcts_vs_expected_state, 0, '.' ,'') }}%</td>--}}
                             </tr>
                             <tr>
                                <td>Institutional Deliveries (Summary - LL/Target)  </td>
                                <td class="velvet-color">{{ number_format((float)$report->id_max_score_achieved, 0, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->id_score_achieved, 1, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->id_target, 0, '.' ,'') }}%</td>
                                <td class="blue">{{ number_format((float)$report->id_performance, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->id_block, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->id_district, 0, '.' ,'') }}%</td>
                                {{--<td class="dark-green">{{ number_format((float)$report->id_state, 0, '.' ,'') }}%</td>--}}
                             </tr>
                             <tr>
                                <td>FI(Summary -LL/Target) </td>
                                <td class="velvet-color">{{ number_format((float)$report->fi_max_score_achieved, 0, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->fi_score_achieved, 1, '.' ,'') }}</td>
                                <td class="velvet-color">{{ number_format((float)$report->fi_target, 0, '.' ,'') }}%</td>
                                <td class="blue">{{ number_format((float)$report->fi_performance, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->fi_block, 0, '.' ,'') }}%</td>
                                <td class="dark-green">{{ number_format((float)$report->fi_district, 0, '.' ,'') }}%</td>
                               {{-- <td class="dark-green">{{ number_format((float)$report->fi_state, 0, '.' ,'') }}%</td>--}}
                             </tr>
                          </table>


                          <table width="100%" class="table fancy-table footer-table">
                             <tr data-title-attribute="{{$months[$report->month]}} {{$report->year}} Report Card">
                                <th width="30%" valign="middle">Patient Satisfaction Score</th>
                                <td width="12%" class="velvet-color">{{ number_format((float)$report->patient_satisfaction_max_score_achieved, 0, '.' ,'') }}</td>
                                <td width="9%" class="velvet-color">{{ number_format((float)$report->patient_satisfaction_score_achieved, 1, '.' ,'') }}</td>
                                <td width="10%" class="velvet-color">{{ number_format((float)$report->patient_satisfaction_cut_off, 0, '.' ,'') }}%</td>
                                <td width="9%" class="blue">{{ number_format((float)$report->patient_satisfaction_performance, 0, '.' ,'') }}%</td>
                                <td width="10%" class="dark-green">{{ number_format((float)$report->patient_satisfaction_block, 0, '.' ,'') }}%</td>
                                <td width="10%" class="dark-green">{{ number_format((float)$report->patient_satisfaction_district, 0, '.' ,'') }}%</td>
                               {{-- <td width="10%" class="dark-green">{{ number_format((float)$report->patient_satisfaction_state, 0, '.' ,'') }}%</td>--}}
                             </tr>
                          </table>

                    </div>
                 </div>
               </div>
            </div>
         </div>
      </section>
      <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
      <script type="text/javascript">
         $(window).scroll(function() {
            var scroll = $(window).scrollTop();
         
            if (scroll >= 100) {
                $(".reports-area.navbar-fixed-top").addClass("darkHeader");
            } else {
                $(".reports-area.navbar-fixed-top").removeClass("darkHeader");
            }
         
            if( $( window ).width() <= 767 ){
            	if (scroll >= 200) {
                 $(".reports-area.navbar-fixed-top").addClass("darkHeader");
             } else {
                 $(".reports-area.navbar-fixed-top").removeClass("darkHeader");
             }
            }
         
         });
      </script>
   </body>
</html>