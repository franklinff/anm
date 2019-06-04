@extends('scenerio.template')

@section('body')
	<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding: 10px 25px;">
		<tr>
			<td style="border-top: solid 1px #08683a; border-bottom: solid 1px #08683a; padding: 5px 0px;">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td align="left"><img src="{{ asset('images/newsletter-img/announcment-icon-left.jpg') }}" alt="" style="margin-left: -20px; max-width: 50px;"></td>
						 <td style="font-size: 32px; line-height: 36px; color: #08683a; font-weight: bold; text-align: center;">शाबाश {{ strtoupper($type) }}
                            @if($type == 'anm')
                            {{ 'दीदी' }}
                            @endif
                        </td>
						<td align="right"><img src="{{ asset('images/newsletter-img/announcment-icon-right.jpg') }}" alt="" style="margin-right: -20px; max-width: 50px;"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

	<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff;">
		<tr>
			<td align="left" valign="middle" class="d-block"><img src="{{ asset('images/newsletter-img/pic1.jpg')}}" alt="" alt=""></td>
			<td align="center" style="font-weight: bold;" class="d-block">
				<span style="color: #ec1d25; font-size: 20px;">
					@if(isset($lstData['TOP']['subcenter']) && count($lstData['TOP']['subcenter']) > 0)
                        <span class=""> {{ implode(',', $lstData['TOP']['subcenter']) }}</span>
                                और
                        <span class=""> {{ $lstData['TOP']['end'] }}</span>
                    @else
                        <span class=""> {{ $lstData['TOP']['end'] }}</span>
                    @endif
				<span>
				<p style="color: #000; font-size: 14px; line-height: 24px; margin:0;">आपने {{$current_month}} में अव्वल दर्जे का काम कर दिखाया! आप में से कुछ {{ strtoupper($type) }}s ने 80% बच्चो का टीकाकरण पूरा कर दिखाया तथा कुछ ने 30% गर्भवती महिलाओ का चौथा ANC चैकप भी पूरा किया!</p>
			</td>
		</tr>
	</table>

	<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding: 30px 0 10px;">
		<tr class="row-reverse">
			<td align="center" style="font-weight: bold;" class="d-block">
				<span style="color: #ec1d25; font-size: 20px;"><span style="font-size:20px; color: #000; display: block;">हमारी</span>
					@if(isset($lstData['MIDDLE']['subcenter']) && count($lstData['MIDDLE']['subcenter']) > 0)
                        <span style="color: #ec1d25; font-size: 20px;" class=""> {{ implode(',', $lstData['MIDDLE']['subcenter']) }}</span>
                                और
                        <span style="color: #ec1d25; font-size: 20px;" class=""> {{ $lstData['MIDDLE']['end'] }}</span>
                    @else
                        <span style="color: #ec1d25; font-size: 20px;" class=""> {{ $lstData['MIDDLE']['end'] }}</span>
                    @endif
				<span>
				<p style="color: #000; font-size: 14px; line-height: 24px; margin:0;">दीदी ने भी अच्छा करने प्रयास किया 30% - 80% बच्चो का टीकाकरण कर दिखाया साथ ही साथ 10% - 30% गर्भवती महिलाओ का चौथा ANC चैकप भी पूरा किया!</p>
			</td>
			<td align="right" valign="middle" class="d-block"><img src="{{ asset('images/newsletter-img/pic2-right.jpg')}}" alt="" alt=""></td>
		</tr>
	</table>
@endsection