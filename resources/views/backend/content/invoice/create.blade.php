@extends('backend.layout.master')

@section('title')
<title>Invoice | Create</title>
@endsection

@push('css')
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endpush

@section('main_content')
{{-- fetching data --}}
@php
    $req = \App\Requisition_Temp::find($id);
    $rq_products = \App\RqProducts::where('requisition_id',$id)->get();
@endphp
{{-- data fetch ends --}}
{{-- showing requistion data --}}
<div class="row">
    <h6 class="text-success">Requisition Details</h6>
    <table class="table table-striped">
        <thead>
            <th>Requisition From</th>
            <th>Requested By</th>
            <th>Submission Date</th>
        </thead>
        <tbody>
            <tr>
                <td>{{ $dept = \App\Department::where('id','=',$req->department)->value('name') }}</td>
                <td>{{ $req->submittedBy }}</td>
                <td>{{ date_format($req->created_at, 'd M yy') }}</td>
            </tr>
        </tbody>
    </table>
    {{-- requested products --}}
    <h6 class="text-success">Requested Products</h6>
    <table class="table table-striped">
        <thead>
            <th>Product Name</th>
            <th>Quantity</th>
        </thead>
        <tbody>
            @foreach ($rq_products as $rqp)
                <tr>
                    <td>{{ $dept = \App\Product::where('id','=',$rqp->product_id)->value('name') }}</td>
                    <td>{{ $rqp->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- assigning products --}}
<div class="card card-outline card-info">
    <div class="card-header">
        <h5 class="card-title">Generating Invoice</h5>
    </div>
    <!-- /.card-header -->
    <div class="card-body pad">
        <div class="mb-3">
            <div class="form-group">  
                <form method="POST" action="{{ route('invoice.store') }}">
                    @csrf  
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id">Invoice Number:</label>
                                <input type="text" class="form-control" value="{{ $req->id }}" name="reqID" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="id">Department ID:</label>
                            <input type="text" class="form-control" name="department" value="{{ $req->department }}" readonly>
                        </div>
                    </div>
                     <div class="table-responsive">  
                          <table class="table table-bordered" id="dynamic_field">
                                <thead>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </thead>
                                @php
                                    $stocks = \App\Stock::latest()->get();
                                @endphp
                                <tr>  
                                    <td>
                                        <select name="product[]" class="select2">
                                            <option value="" disabled selected>please choose....</option>
                                            @foreach ($stocks as $stock)
                                                <option value="{{ $stock->product_id }}">{{ $product = \App\Product::where('code',$stock->product_code)->value('name').' - (Stock: '.$stock->quantity.')'.' - '.$product = \App\Vendor::where('id',$stock->vendor)->value('name').' - '.$stock->price.'/=' }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" placeholder="place your number" name="quantity[]" value="1">
                                    </td>
                                    <td>
                                        <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                                    </td>  
                                </tr>  
                          </table>  
                     </div> 
                     <div class="row">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="textarea">Remarks:</label>
                                 <textarea name="remarks" class="summernote"></textarea>
                             </div>
                         </div>
                     </div>
                    {{-- submit --}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-md float-right">Submit</button>
                    </div> 
                </form>  
           </div>  
        </div>
    </div>
</div>  
@endsection

@push('js')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/datatables.init.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script>
    $(document).ready(function(){  
        var i=1;  
        $('#add').click(function(){  
            i++;  
            $('#dynamic_field').append('<tr id="row'+i+'"><td><select name="product[]" class="select2 form-control"><option value="" disabled selected>please choose....</option>@foreach ($stocks as $stock)<option value="{{ $stock->product_id }}">{{ $product = \App\Product::where('code',$stock->product_code)->value('name').' - (Stock: '.$stock->quantity.')'.' - '.$product = \App\Vendor::where('id',$stock->vendor)->value('name').' - '.$stock->price.'/=' }}</option>@endforeach</select></td><td id="number"><input type="number" class="form-control" placeholder="place your number" name="quantity[]" value="1"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
            $('.select2').select2();
        });  
        $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");   
            $('#row'+button_id+'').remove();  
        });  
    });  
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script>
  $.validate({
    lang: 'en'
  });
</script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
  </script>
@endpush
