@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">


                    @if($category=="anm")
                        <div class="panel-heading">ANM graph</div>
                    @elseif($category=="moic")
                        <div class="panel-heading">Moic graph</div>
                    @endif

                    <div class="panel-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function(){

            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {

                type: 'pie',
                data: {
                    labels: ["Total phone nos.", "Total Sms sent", "Total Weblinks opened"],
                    datasets: [{
                        data: [{{ $list_data['total_rows'] }},{{ $list_data['countSentSms'] }},{{ $list_data['weblink_opened'] }}],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });

        });
    </script>
@endsection