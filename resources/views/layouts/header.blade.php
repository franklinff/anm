<header>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" alt="" class="img-responsive"></a>
                    </div>
                    <div class="col-md-9">
                        <a href="{{ url('/') }}"><div class="tagline">Governance <span>Innovation Model</span></div></a>
                    </div>
                </div>

            </div>
            <div class="col-md-6 text-right header-links">
                        <a class="{{ (\Request::is('get-nudges') || \Request::is('nudgedetails/*')) ? "active" : ''}}" href="{{url('get-nudges')}}">Nudges</a>
                        <a class="{{ (\Request::is('get-anm') || \Request::is('processedfile/*')) ? "active" : ''}}" href="{{url('get-anm')}}">ANM Performance</a>
                        <a class="{{ (\Request::is('get-mos') || \Request::is('rankingdetails/*'))? "active" : ''}}"  href="{{url('/get-mos')}}">MOIC Performance</a>
                        <a class="{{ (\Request::is('feedback')|| \Request::is('detail_feedback/*')) ? "active" : ''}}" href="{{url('/feedback')}}">Patient Feedback</a>
                        <a class="logout-btn" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="glyphicon glyphicon-log-out"></span> Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
            </div>
        </div>
    </div>
</header>