@extends('layouts.main')

@section('content')

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
                    <h4>Nudge file details</h4>
                </div>
            </div>
        </div>
    </section>



    @if($location == 'nudge_file')
    <section style="margin-left: 1315px;">
        <a  class="btn btn-default" href="{{ url('get-nudges') }}">Back</a>
    </section></br>
    @elseif($location == 'dashboard')
        <section style="margin-left: 1050px;">
            <a  class="btn btn-default" href="{{ url('/') }}">Dashboard</a>
        </section></br>
    @endif


    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table id="nudge_file_detail" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Phone number</th>
                            <th>Message content</th>
                            <th>SMS sent (Yes/No)</th>
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
            $('#nudge_file_detail').dataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "info": true,
                "ajax": "<?php echo url('/nudgefile/'.$id);?>",
                "columns": [
                    { "data": "sr_no" },
                    { "data": "phone_number" },
                    { "data": "message" },
                    { "data": "sms_sent" },
                ],
            });
        } );


    </script>
@endsection