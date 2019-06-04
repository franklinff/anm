@extends('layouts.main')

@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-title">ANM Import</h1>
                </div>
            </div>
        </div>
    </section>

    @if (session()->has('error'))
        <p class="alert alert-danger">
            {{ session()->get('error') }}<br>
        </p>
    @endif
    @if($errors->any())
        <p class="alert alert-danger">
            @foreach($errors->all() as $error)
                {{$error}}<br>
            @endforeach
        </p>
    @endif
    @if(session()->has('success'))
        <p class="alert alert-success">
            {{ session()->get('success') }}
        </p>
    @endif

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Upload Target File</h3>
                </div>
            </div>
        </div>
    </section>

    {!!  Form::open(array('route' => 'import.file','method'=>'POST','files'=>'true','enctype'=>"multipart/form-data")) !!}
    <section>
        <div class="container">
            <div class="row">

                <div class="col-sm-2">
                    <div class="form-group">
                        <label>District</label>
                        {!! Form::select('district', $district, '',['class' => 'form-control' ,'id'=>"district"])!!}
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Month</label>
                        <select class="form-control" name="month">
                            @for($m=1; $m<=12; $m++)
                                <option value="{{$m}}">{{date('F', mktime(0,0,0,$m, 1, date('Y')))}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Year</label>
                        <select class="form-control" name="year">
                            @foreach (range(2017, 2025) as $key => $value) {
                                <option>{{$value}}</option>;
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label><input type='checkbox' name="disable_sms" onclick='handleClick(this);'>Disable sms schedule</label>
                    </div>
                </div>


                <div class="col-sm-2 schedule_at1">
                    <div class="form-group">
                        <label>SMS schedule</label>
                        <input type="text" id="schedule_at" name="schedule_at" placeholder="Select date and time" class="form-control">
                    </div>
                </div>

                <div class="col-sm-2">
                        <label>Select File to Import:</label>
                        <input type="file" class="form-control" name="sample_file" >
                </div>

                <div class="col-sm-2">
                    <div class="form-group btn-area">
                        <button type="submit" class="btn btn-primary">Upload File</button>
                    </div>
                </div>

            </div>
        </div>
    </section>
    {!! Form::close() !!}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Uploaded File Details</h3>
                            <table id="uploadData" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>File Name</th>
                                    <th>Uploaded On</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>SMS On</th>
                                    <th>Reschedule</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                </div>
            </div>
        </div>
    </section>

@endsection



@section('js')
    <script>

        $(function () {
            $('#uploadData').dataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "info": true,
                "ajax": "<?php echo url('/get-anm-target-data');?>",
                "columns": [

                    { "data": "sr_no" },
                    { "data": "filenames" },
                    { "data": "uploaded_on" },
                    { "data": "status" },
                    { "data": "actions" },
                    { "data": "schedule_at" },
                    { "data": "reschedule" },
                    { "data": "delete_file"}
                ],
                /* rowCallback: function (row, data,index){
                     var html = $.map(data['tag'], function(array){ return array['title']});
                     $("td:eq(0)", row).html(html.join(","));
                 }*/
            });
        } );

        var d1 = new Date();
        var d2 = new Date();
        //d1.setHours(+d2.getHours()+2);
        d1.setMinutes(+d2.getMinutes()+15);

        $("#schedule_at").datetimepicker({
            autoclose: true,
            format: 'yyyy-mm-dd hh:ii',
            startDate: d1
        });

        $(document).on('click','.re_schedule',function (){
            $(this).datetimepicker({
                autoclose: true,
                format: 'yyyy-mm-dd hh:ii',
                startDate: d1
            }).datetimepicker("show").on('change', function() {

                var file = $(this).prev().attr('id');
                var dat_time = $(this).val();

                $.ajax({
                    url: '{{  url('anm_sms_update') }}',
                    type: "POST",
                    data: {
                        file_name : file,
                        date_time:  dat_time,
                        "_token": '{{  csrf_token()}}'
                    },
                    success: function(result){
                        location.reload();
                    }
                });

            });
        });


        function handleClick(cb) {
            if (!cb.checked) {
                $(".schedule_at1").fadeIn();
            }
            else{
                $(".schedule_at1").fadeOut();
                $("#schedule_at").val('');
            }
        }

    </script>

@endsection