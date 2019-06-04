@extends('layouts.main')

@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-title">Nudge</h1>
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
                    <h4>Upload nudge File</h4>
                </div>
            </div>
        </div>
    </section>

    {!!  Form::open(array('route' => 'import.nudgefile','method'=>'POST','files'=>'true','enctype'=>"multipart/form-data")) !!}
    <section>
        <div class="container">
            <div class="row">

                <div class="col-sm-2">
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
                    <table id="nudgeData" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>File Name</th>
                            <th>Total rows</th>
                            <th>Uploaded On</th>
                            <th>Sms Schedule</th>
                            <th>View</th>
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
            $('#nudgeData').dataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "info": true,
                "ajax": "<?php echo url('/get-nudge-data');?>",
                "columns": [
                    { "data": "sr_no" },
                    { "data": "filename" },
                    { "data": "total_rows" },
                    { "data": "uploaded_on" },
                    { "data": "schedule_at" },
                    { "data": "view" },
                    { "data": "action" },
                ],
            });
        } );

        var d1 = new Date();
        var d2 = new Date();
        d1.setMinutes(+d2.getMinutes()+15);

        $("#schedule_at").datetimepicker({
            autoclose: true,
            format: 'yyyy-mm-dd hh:ii',
            startDate: d1
        });
    </script>
@endsection