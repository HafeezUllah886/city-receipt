@extends('layout.popups')
@section('content')
        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="card" id="demo">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end d-print-none p-2 mt-4">
                                <a href="javascript:window.print()" class="btn btn-success ml-4"><i class="ri-printer-line mr-4"></i> Print</a>
                            </div>
                            <div class="card-header border-bottom-dashed p-4">
                                <h4 class="text-center fw-bold">DR ABDUL BARI KAKAR</h4>
                                <p class="text-center fw-bold">DAILY COLLECTION REPORT</p>
                            </div>
                            <!--end card-header-->
                        </div><!--end col-->
                        <div class="col-lg-12 px-4 py-2">
                            <table class="w-100" >
                                <tbody>
                                    <tr>
                                        <td width="15%" class="fw-bold">Date:</td>
                                        <td width="35%" class="fw-bold">{{ date('d-m-Y', strtotime($receipts[0]->date)) }}</td>
                                        <td width="15%" class="fw-bold">User: </td>
                                        <td width="35%" class="fw-bold">{{auth()->user()->name}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        <div class="col-lg-12">
                            <div class="card-body p-1">
                                <div class="">
                                    <table class="table table-borderless text-center table-nowrap align-middle mb-0 w-100">
                                        <thead>
                                            <tr class="table" style="border-top: 1px solid black !important; border-bottom: 1px solid black !important;">
                                                <th scope="col" class="text-start fw-bold">Ser</th>
                                                <th scope="col" class="text-start fw-bold">Receipt #</th>
                                                <th scope="col" class="text-start fw-bold ">Patient Name</th>
                                                <th scope="col" class="text-start fw-bold">Patient CNIC</th>
                                                <th scope="col" class="text-start fw-bold">Patient Contact</th>
                                                <th scope="col" class="text-start fw-bold">Cosultant Name</th>
                                                <th scope="col" class="text-start fw-bold">Type</th>
                                                <th scope="col" class="text-start fw-bold" style="max-width:150px;">Notes</th>
                                                <th scope="col" class="text-end fw-bold">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody id="products-list fw-bold" style="border-bottom: 1px solid black !important;">
                                            @php
                                                $total = 0;
                                            @endphp
                                          @foreach ($receipts as $key => $receipt)
                                          @php
                                              $total += $receipt->details->sum('fee');
                                          @endphp
                                              <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$receipt->id}}</td>
                                                <td class="text-start">{{$receipt->pName}}</td>
                                                <td>{{$receipt->cnic}}</td>
                                                <td>{{$receipt->contact}}</td>
                                                <td class="text-start">{{$receipt->consultant}}</td>
                                                <td class="text-start">{{$receipt->type}}</td>
                                                <td class="text-start">{{$receipt->desc}}</td>
                                                <td class="text-end">{{$receipt->details->sum('fee')}}</td>
                                              </tr>
                                          @endforeach
                                        </tbody>
                                        <tfoot>
                                          <tr>
                                            <th colspan="8" class="text-end">Total</th>
                                            <th class="text-end">{{number_format($total)}}</th>
                                          </tr>
                                        </tfoot>
                                    </table><!--end table-->
                                </div>
                                
                            </div>
                           
                            <!--end card-body-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <h5>Refunded Receipts</h5>
                            <div class="card-body p-1">
                                <div class="">
                                    <table class="table table-borderless text-center table-nowrap align-middle mb-0 w-100">
                                        <thead>
                                            <tr class="table" style="border-top: 1px solid black !important; border-bottom: 1px solid black !important;">
                                                <th scope="col" class="text-start fw-bold">Ser</th>
                                                <th scope="col" class="text-start fw-bold">Receipt #</th>
                                                <th scope="col" class="text-start fw-bold">Patient Name</th>
                                                <th scope="col" class="text-start fw-bold">Patient CNIC</th>
                                                <th scope="col" class="text-start fw-bold">Patient Contact</th>
                                                <th scope="col" class="text-start fw-bold">Cosultant Name</th>
                                                <th scope="col" class="text-start fw-bold">Type</th>
                                                <th scope="col" class="text-start fw-bold" style="max-width:150px;">Notes</th>
                                                <th scope="col" class="text-end fw-bold">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody id="products-list fw-bold" style="border-bottom: 1px solid black !important;">
                                            @php
                                                $rtotal = 0;
                                            @endphp
                                          @foreach ($refunded as $key => $refund)
                                          @php
                                              $rtotal += $refund->details->sum('fee');
                                          @endphp
                                              <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$refund->id}}</td>
                                                <td class="text-start">{{$refund->pName}}</td>
                                                <td>{{$refund->cnic}}</td>
                                                <td>{{$refund->contact}}</td>
                                                <td class="text-start">{{$refund->consultant}}</td>
                                                <td class="text-start">{{$refund->type}}</td>
                                                <td class="text-start">{{$refund->desc}}</td>
                                                <td class="text-end">{{$refund->details->sum('fee')}}</td>
                                              </tr>
                                          @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              <th colspan="8" class="text-end">Total</th>
                                              <th class="text-end">{{number_format($rtotal)}}</th>
                                            </tr>
                                          </tfoot>
                                    </table><!--end table-->
                                </div>
                                <table class="table mt-2">
                                    <tr>
                                        <td class="text-start fw-bold">Collected Amount</td>
                                        <td class="text-start fw-bold">{{number_format($total)}}</td>
                                   
                                        <td class="text-start fw-bold">Refunded Amount</td>
                                        <td class="text-start fw-bold">{{number_format($rtotal)}}</td>
                                    
                                        <td class="text-start fw-bold">Net Amount</td>
                                        <td class="text-end fw-bold">{{number_format($total - $rtotal)}}</td>
                                    </tr>
                                </table>
                                <table class="table mt-3">
                                    <tbody>
                                        <tr>
                                            <th class="fw-bold">
                                                Operator<br><br>
                                                ____________________<br>
                                                {{auth()->user()->name}}
                                            </th>
                                            <th class="fw-bold">
                                                
                                            </th>
                                            <th class="fw-bold">
                                                Received By<br><br>
                                                ____________________<br>
                                                
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                           
                            <!--end card-body-->
                        </div><!--end col-->

                    </div><!--end row-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->

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

