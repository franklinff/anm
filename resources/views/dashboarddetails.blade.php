@extends('layouts.main')

@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-title">File Details
                        <a style="margin-left: 1050px;" class="btn btn-default" href="{{ url('/') }}">Back</a>
                    </h1>

                </div>

            </div>
        </div>
    </section>

    @if($category == "Anm")
        <a style="margin-left: 988px;" class="btn btn-default" href="{{ route('weblinks_anm_export',$id) }}">Excel export Anm</a>
    @elseif($category == "Moic")
        <a style="margin-left: 988px;" class="btn btn-default" href="{{ route('weblinks_moic_export',$id) }}">Excel export Moic</a>
    @endif


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
                    <h3>Uploaded File Details</h3>
                    <table id="uploadData" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Weblink</th>
                            <th>SMS sent</th>
                            <th>Mobile no.</th>
                            <th>IP address 1</th>
                            <th>Clicked at 1</th>
                            <th>IP address 2</th>
                            <th>Clicked at 2</th>
                            <th>IP address 3</th>
                            <th>Clicked at 3</th>

                        </tr>
                        </thead>
{{--                        @php $i = 1;@endphp
                            @foreach ($anm_file_data as $key => $value)
                                <tr>
                                    <td>{{ $i++ }}</td>

                                    <td>{{ $value['weblink'] }}</td>

                                    @if($value['weblink'])
                                    <td>Yes</td>
                                    @else
                                    <td>No</td>
                                    @endif

                                    @if($value['ip_address'])
                                    <td>{{ $value['ip_address'] }}</td>
                                    @else
                                    <td>----</td>
                                    @endif

                                    @if($value['clicked_at'])
                                    <td>{{ $value['clicked_at'] }}</td>
                                    @else
                                    <td>----</td>
                                    @endif

                                </tr>
                            @endforeach--}}

                    @php $i = $file_data->perPage() * ($file_data->currentPage() -1); @endphp
                    @foreach ($file_data as $value)

                        <tr>
                            <td> {{ ++$i }} </td>

                            <td>{{ $value->weblink }}</td>

                            @if($value->sms_sent == 1)
                                <td>Yes</td>
                            @elseif($value->sms_sent == 2 || $value->sms_sent == 0)
                                <td>No</td>
                            @endif

                            @if($value->mobile_no)
                                <td>{{ $value->mobile_no }}</td>
                            @else
                                <td>----</td>
                            @endif

                            @if($value->ip_address)
                                <td>{{ $value->ip_address }}</td>
                            @else
                                <td>----</td>
                            @endif

                            @if($value->clicked_at)
                                <td>{{ $value->clicked_at }}</td>
                            @else
                                <td>----</td>
                            @endif


                            @if($value->ip_address)
                                <td>{{ $value->ip_address2 }}</td>
                            @else
                                <td>----</td>
                            @endif

                            @if($value->clicked_at)
                                <td>{{ $value->clicked_at2 }}</td>
                            @else
                                <td>----</td>
                            @endif

                            @if($value->ip_address)
                                <td>{{ $value->ip_address3 }}</td>
                            @else
                                <td>----</td>
                            @endif

                            @if($value->clicked_at)
                                <td>{{ $value->clicked_at3 }}</td>
                            @else
                                <td>----</td>
                            @endif

                        </tr>
                    @endforeach
                </table>
                {{ $file_data->links() }}

</div>
</div>
</div>
</section>

@endsection


