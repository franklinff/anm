@extends('layouts.main')

@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-title">Dashboard</h1>

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

    {!!  Form::open(array('route' => 'listfile','method'=>'GET','files'=>'true')) !!}
    <section>

        <div class="container">
            <div class="row">

                <div class="col-sm-2">
                    <div class="form-group">
                        <label>From date</label>
                        <input type="text" id="from_date" name="from_date" placeholder="Select Date" class="form-control">
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label>To date</label>
                        <input type="text" id="to_date" name="to_date" placeholder="Select Date" class="form-control">
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                    <label>Module</label>
                     <select class="form-control" id='category_module' name='category_module'>
                      @foreach (config('app.modules') as $key => $value)
                       <option value='{{$value}}'>{{ $value }}</option>
                      @endforeach
                      </select>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group btn-area">
                        <button type="submit" class="btn btn-primary">Search</button>
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

                            @if($category=="Anm")
                                <h3>Anm files</h3>
                            @elseif($category=="Moic")
                                <h3>Moic files</h3>
                            @elseif($category=="Feedback")
                                <h3>Feedback files</h3>
                            @elseif($category=="Nudges")
                                <h3>Nudge files</h3>
                            @endif

                    <table id="uploadData" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>File Name</th>
                            <th>Uploaded On</th>
                            <th>Total rows</th>
                            <th>Number of sms sent</th>

                            @if($category != "Nudges")
                            <th>Weblinks Opened</th>
                            @endif

                            <th>Action</th>

                            @if($category != "Nudges")
                            <th>View graph</th>
                            @endif
                        </tr>
                        </thead>

                        @if($list_data)
                        @php $i = 1;@endphp
                        @foreach ($list_data as $key => $value)
                        <tr>
                            <td> {{ $i++ }}</td>
                            <td>{{ $value['og_filename'] }}</td>
                            <td>{{ $value['uploaded_on'] }}</td>
                            <td>{{ $value['total_rows'] }}</td>
                            <td>{{ $value['countSentSms'] }}</td>

                            @if(isset($value['weblink_opened']))
                            <td>{{ $value['weblink_opened'] }}</td>
                            @endif

                            <td> <a href="{{ url($category.'/'.$value['id']) }}">View details</a></td>
                            @if($category != "Nudges")
                            <td> <a href="{{ url($category.'graph/'.$value['id']) }}">Graph view</a></td>
                            @endif
                        </tr>
                        @endforeach
                        @endif
                    </table>

                       {{--@if($list_data)--}}
                           {{--@php $i = 1;@endphp--}}
                            {{--@foreach ($list_data as  $value)--}}
                                {{--<tr>--}}
                                    {{--<td>{{ $i++ }}</td>--}}
                                    {{--<td>{{ $value->og_filename }}</td>--}}
                                    {{--<td>{{ $value->uploaded_on }}</td>--}}
                                    {{--<td>{{ $value->total_rows }}</td>--}}
                                    {{--<td>{{ $value->countSentSms }}</td>--}}
                                    {{--<td>{{ $value->weblink_opened }}</td>--}}
                                    {{--<td> <a href="{{ url($category.'/'.$value->id) }}">View details</a></td>--}}
                                {{--</tr>--}}
                            {{--@endforeach--}}
                        {{--@endif--}}

                    {{--@if($list_data)--}}
                    {{--{{ $list_data->links() }}--}}
                    {{--@endif--}}

                </div>
            </div>
        </div>
    </section>

@endsection


@section('js')
   <script>

    $(document).ready(function(){

        $("#from_date").datepicker({
            autoclose: true,
            dateFormat: 'yy-mm-dd',
            onSelect: function(selected) {
                $("#to_date").datepicker("option","minDate", selected)
            }
        });

        $("#to_date").datepicker({
            autoclose: true,
            dateFormat: 'yy-mm-dd',
            onSelect: function(selected) {
                $("#from_date").datepicker("option","maxDate", selected)
            }
        });

    });

   </script>
@endsection
