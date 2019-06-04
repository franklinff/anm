@extends('scenerio.template')

@section('body')
	<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding: 10px 25px;">
		<tr>
			<td style="border-top: solid 1px #08683a; border-bottom: solid 1px #08683a; padding: 5px 0px;">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td align="left"><img src="{{ asset('images/newsletter-img/announcment-icon-left.jpg')}}" alt="" style="margin-left: -20px; max-width: 50px;"></td>
						 <td style="font-size: 32px; line-height: 36px; color: #08683a; font-weight: bold; text-align: center;">
						 	शाबाश {{ strtoupper($type) }}
                            @if($type == 'anm')
                            {{ 'दीदी' }}
                            @endif
                        </td>
						<td align="right"><img src="{{ asset('images/newsletter-img/announcment-icon-right.jpg')}}" alt="" style="margin-right: -20px; max-width: 50px;"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

	<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding-top: 40px;">
		<tr>
			<td align="center" valign="middle"><img src="{{ asset('images/newsletter-img/pic6-center.jpg')}}" alt="" alt=""></td>
		</tr>
		<tr>
			<td align="center" style="font-weight: bold; padding: 20px 60px;">
				<span style="color: #ec1d25; font-size: 20px;">
					<span style="font-size:20px; color: #000; display: block;">हमारी</span>
					@if(isset($lstData['MIDDLE']['subcenter']) && count($lstData['MIDDLE']['subcenter']) > 0)
					    <span class="">{{ implode(',', $lstData['MIDDLE']['anm_name']) }}</span>

					    एवं

					    <span class="">{{ $lstData['MIDDLE']['end'] }}</span>
					@else
					    <span class="">{{ $lstData['MIDDLE']['end'] }}</span>
					@endif
				<span>
				<p style="color: #000; font-size: 14px; line-height: 24px; margin:0;">दीदी ने भी अच्छा करने प्रयास किया 30% - 80% बच्चो का टीकाकरण कर दिखाया साथ ही साथ 10% - 30% गर्भवती महिलाओ का चौथा ANC चैकप भी पूरा किया!</p>
			</td>
		</tr>
	</table>
@endsection