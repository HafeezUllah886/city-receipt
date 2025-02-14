@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>History</h3>
                    
                </div>
                <div class="card-body">

                    <table class="table" id="buttons-datatables">
                        <thead>
                            <th>#</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Patient</th>
                            <th>Token</th>
                            <th>Time</th>
                            <th>Consultant</th>
                            <th>Amount</th>
                            <th></th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($receipts as $key => $receipt)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ date("d M Y", strtotime($receipt->date)) }}</td>
                                    <td>{{ $receipt->type }}</td>
                                    <td>{{ $receipt->pName}}</td>
                                    <td>{{ $receipt->token_number}}</td>
                                    <td>{{ $receipt->event_time}}</td>
                                    <td>{{ $receipt->consultant}}</td>
                                    <td>{{ $receipt->details->sum('fee')}}</td>
                                    <td>
                                        @if($receipt->refunded == 'yes')
                                            <span class="badge bg-danger">Refunded <br>{{$receipt->refundedBy}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('receipt.print', $receipt->id)}}" class="btn btn-info">Print</a>
                                        @if($receipt->refunded == 'no')
                                        <a href="{{route('receipt.refund', $receipt->id)}}" class="btn btn-warning">Refund</a>
                                    @endif
                                      
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$receipts->links()}}
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('page-css')
<link rel="stylesheet" href="{{ asset('assets/libs/datatable/datatable.bootstrap5.min.css') }}" />
<!--datatable responsive css-->
<link rel="stylesheet" href="{{ asset('assets/libs/datatable/responsive.bootstrap.min.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/libs/datatable/buttons.dataTables.min.css') }}">
@endsection
@section('page-js')
    <script src="{{ asset('assets/libs/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.print.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/vfs_fonts.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/pdfmake.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/jszip.min.js')}}"></script>

    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
@endsection
