@extends('layout.app')
@section('content')
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Generate Report</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('report.print')}}" method="post">
                        @csrf
                        
                                <div class="form-group">
                                    <label for="date">Select Date</label>
                                    <input name="date" type="date" value="{{date('Y-m-d')}}" id="type" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-success w-100 mt-2">Print</button>
                            
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Default Modals -->

@endsection
