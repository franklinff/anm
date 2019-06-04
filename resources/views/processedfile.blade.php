@extends('layouts.main')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Processed File Details</h1>
                </div>
            </div>

            @if($status['status'] == 'Y')
                <div class="row mb-1">
                    <div class="col-md-12 text-right">
                        <a  class="btn btn-primary" id="export-btn" href="{{ route('excel_import',$id) }}">Export to excel</a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table id="processfile" width="100%" border="0">
                        <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Block</th>
                            <th>PHC Name</th>
                            <th>Subcenter</th>
                            <th>Web Link</th>
                            <th>ANM Customised Message</th>
                            <th>MOIC Customised Message</th>
                            <th>Beneficiary Customised Message</th>
                        </tr>
                        </thead>
                    </table>
                    <a  class="btn btn-default" href="{{ url('get-anm') }}">Back</a>
                </div>
            </div>
        </div>
    </section>

@endsection


@section('js')
    <script>
        $(function () {
            $('#processfile').dataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "info": true,
                "ajax": "<?php echo url('/fetch-process-data/'.$id);?>",
                "columns": [
                    { "data": "sr_no" },
                    { "data": "block" },
                    { "data": "phc_name" },
                    { "data": "subcenter"  },
                    { "data": "weblink",
                        "render": function(data, type) {
                            if (type === 'display') {
                                data = '<a href="' + data + '">' + data + '</a>';
                            }
                            return data;
                        }
                    },
                    {"data":"anm_sms_span"},
                    {"data":"moic_sms_span"},
                    {"data":"benef_sms_span"},
                ],
            });
        });
    </script>
@endsection














