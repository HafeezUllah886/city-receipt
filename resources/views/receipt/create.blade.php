@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Create Receipt</h3>
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
                    <form action="{{route('receipt.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="type">Receipt Type</label>
                                    <select name="type" id="type" onchange="typeChanged()" class="form-control">
                                        @foreach ($types as $type)
                                            <option @selected($type->id == $id) value="{{$type->id}}">{{$type->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="consultant">Consultant</label>
                                    <input type="text" name="consultant" id="consultant" value="{{old('consultant')}}"  required class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" value="{{date('Y-m-d')}}"  required class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mt-2">
                                <div class="form-group">
                                    <label for="pName">Patient Name</label>
                                    <input type="text" name="pName" value="{{old('pName')}}" required id="pName" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3 mt-2">
                                <div class="form-group">
                                    <label for="contact">Contact</label>
                                    <input type="text" name="contact" value="{{old('contact')}}" id="contact" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3 mt-2">
                                <div class="form-group">
                                    <label for="cnic">CNIC #</label>
                                    <input type="text" name="cnic" value="{{old('cnic')}}" id="cnic" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3 mt-2">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" value="{{old('gender')}}" id="gender" class="form-control">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="charges">Charges</label>
                                    <select id="charges" class="selectize">
                                        <option value="">Select Item</option>
                                        @foreach ($charges as $charge)
                                            <option value="{{$charge->id}}" data-rate="454">{{$charge->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <table class="table">
                                    <thead>
                                        <th>Description</th>
                                        <th colspan="2">Amount</th>
                                    </thead>
                                    <tbody id="list">

                                    </tbody>
                                    <tfoot>
                                        <th class="text-end">Total</th>
                                        <th id="total" class="text-center"></th>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea name="notes" id="notes" class="form-control" cols="30" rows="5"></textarea>
                                </div>
                               
                                <button type="submit" class="btn btn-success btn-lg w-100 mt-2">Print</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Default Modals -->

@endsection

@section('page-css')
<link rel="stylesheet" href="{{ asset('assets/libs/selectize/selectize.min.css') }}">
@endsection
@section('page-js')
<script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
<script>


$(".selectize").selectize({
            onChange: function(value) {
                if (!value.length) return;
                if (value != 0) {
                    const selectedOption = this.options[value];
            addItem(selectedOption.value);
                    this.clear()
                    this.focus();
                }

            },
        });

        function typeChanged(){
            var type = $("#type").find(":selected").val();
            window.location.href = "{{ url('receipt/create/') }}" + "/" + type;
        }

        var existingItems = [];
        function addItem(id)
        {
          
        $.ajax({
            url: "{{ url('/getcharges/') }}/" + id,
            method: "GET",
            success: function(item) {
                let found = $.grep(existingItems, function(element) {
                    return element === item.id;
                });
                if (found.length > 0) {

                } else {
                    var html = '<tr id="row_' + id + '">';
                        html += '<td width="70%">' + item.name + '</td>';
                        html += '<td ><input type="number" name="rate[]" required  value="'+item.rate+'" class="form-control text-center" id="rate_' + id + '"></td>';
                        html += '<td> <span class="btn btn-sm btn-danger" onclick="deleteRow('+id+')">X</span> </td>';
                        html += '<input type="hidden" name="id[]" value="' + id + '">';
                        html += '<input type="hidden" name="text[]" value="' + item.name + '">';
                        html += '</tr>';
                        $("#list").prepend(html);
                        updateTotal(id);
                        existingItems.push(id);
                }
            }
            });
        }

        function updateTotal() {
            var total = 0;
            $("input[id^='rate_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                total += parseFloat(inputValue);
            });

            $("#total").text(total);
        }
        function deleteRow(id) {
            existingItems = $.grep(existingItems, function(value) {
                return value !== id;
            });
            $('#row_'+id).remove();
            updateTotal();
        }
 

</script>

@endsection
