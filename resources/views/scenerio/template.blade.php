<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}">
	<script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/html2canvas.min.js')}}"></script>
	<style type="text/css">
		body {
			margin: 10px;
			padding: 0;
		}
	</style>
</head>
<body>
	<table width="540" cellpadding="0" cellspacing="0" border="0" align="center" style="font-family: Arial; background-color: #f0c94a; padding: 10px;" id="table" class="responsive-box">
		<tr>
			<td>
				<table width="100%" cellpadding="0" cellspacing="0" border="0" style="padding-bottom: 5px;">
					<tr>
						<td align="left"><img src="{{asset('images/mishaalred.png')}}" style="height: 80px;width: 80px;"></td>
						<input type="hidden" id="scenerio" value="{{$scenes}}">
						<td style="font-size: 18px; font-weight: bold; line-height: 24px; text-align: center;">
							जानना चाहते है की <span style="color: #ec1d25;">{{$current_month}} <span style="text-decoration: underline;">{{date('Y')}}</span></span>  में <br/> <span style="color: #ec1d25;">{{ $lstData['phc_name'] }} पी.एच.सी</span>  के किस {{strtoupper($type)}} ने सबसे अच्छा काम किया?</td>
					</tr>
				</table>

				@yield('body')

				<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #e8e8e8; padding: 0px 25px 5px; border-top: 1px solid #cacaca;">
					<tr>
						<td align="center" colspan="2" style="font-size: 13px; line-height: 21px; font-weight: bold; color: #4e4e4e; padding: 15px 0 10px;">
							बने रहिये: देखते है {{$next_month}} {{date('Y')}} में कौनसी {{strtoupper($type)}} अव्वल नंबर का काम करके दिखाएगी| 
						</td>
					</tr>

					<!-- <tr>
						<td align="center" colspan="2" style="padding: 20px 0;">
	                        <a style="font-size:16px; color: #ffffff; text-decoration: none; outline: none; border:none; padding: 8px 15px; display: none;" id="download">Download</a>
	                    </td>
					</tr> -->
				</table>
			</td>
		</tr>
	</table>
</body>
</html>