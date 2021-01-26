@extends('backend.layout.master')

@section('title')
<title>Requisition Approval</title>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('main_content')
<div class="row">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <button type="button" class="btn btn-primary waves-effect waves-light float-right" data-toggle="modal" data-target=".bs-example-modal-xl"> <i class="fas fa-user-plus"></i> add new product</button>
        <br><br>
    </div>
</div>
{{-- approved list --}}
<div class="card">
    <div class="card-body">
        <h4 class="mt-0 header-title">Requisition Approval</h4>
        @php
            $id = Crypt::encrypt($req_pen->id);
            $department = App\Department::where('id','=',$req_pen->department)->value('name')
        @endphp
        
        <div class="row">
            <div class="form-group col-md-6">
                <label>Department:</label>
                <input type="text" class="form-control" name="department" value="{{ $department }}" readonly>
            </div>
            <div class="form-group col-md-6">
                <label>Submitted By:</label>
                <input type="text" name="submittedBy" class="form-control" value="{{ $req_pen->submittedBy }}" readonly>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($req_products as $product)
                        @php
                            $name = \App\Product::where('id','=',$product->product_id)->value('name');
                            $id = Crypt::encrypt($product->id);
                        @endphp
                        <tr>
                            <td>{{ $name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td><a class="btn btn-danger" href="{{ route('submit.approve_product_remove',$id) }}" onclick="return confirm('Are you sure to delete the item?')"> <i class="fas fa-trash"></i> </a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" onchange="document.getElementById('submit').disabled = !this.checked;" >
                    <label class="form-check-label" for="inlineCheckbox2">I have gone through the requisition slip</label>
                </div>
                @php
                    $req_id = Crypt::encrypt($req_pen->id);
                @endphp
                <button id="submit" class="btn btn-primary btn-md float-right" disabled><a href="{{ route('submit.approve_head',$req_id) }}">Confirm</a></button>
            </div>
        </div>
    </div>
</div>

{{-- form modal --}}
<div class="modal fade bs-example-modal-xl" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Requisitions</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h5 class="card-title">Adding Products</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pad">
                        <div class="mb-3">
                            <div class="form-group">  
                                <form method="POST" action="{{ route('submit.approve_product_add') }}">
                                    @csrf  
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="id">Requisition Number:</label>
                                                <input type="text" class="form-control" value="{{ $req_pen->id }}" name="requisition_id" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="id">Department:</label>
                                                <input type="text" class="form-control" name="department" value="{{ $req_pen->department }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="id">Submitted By:</label>
                                                <input type="text" class="form-control" value="{{ $req_pen->submittedBy }}" name="submittedBy" readonly>
                                            </div>
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
                                                    $products = \App\Product::latest()->get();
                                                @endphp
                                                <tr>  
                                                    <td>
                                                        <select name="product[]" class="select2">
                                                            <option value="" disabled selected>please choose....</option>
                                                            @foreach ($products as $product)
                                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
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
                                    {{-- submit --}}
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-md float-right">Submit</button>
                                    </div> 
                                </form>  
                           </div>  
                        </div>
                    </div>
                </div>  
                <!-- ./row -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@push('js')

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){  
        var i=1;  
        $('#add').click(function(){  
            i++;  
            $('#dynamic_field').append('<tr id="row'+i+'"><td><select name="product[]" class="select2 form-control"><option value="" disabled selected>please choose....</option>@foreach ($products as $product)<option value="{{ $product->id }}">{{ $product->name }}</option>@endforeach</select></td><td id="number"><input type="number" class="form-control" placeholder="place your number" name="quantity[]" value="1"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
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
@endpush

