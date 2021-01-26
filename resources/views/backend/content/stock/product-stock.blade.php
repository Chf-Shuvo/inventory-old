@extends('backend.layout.master')

@section('title')
<title>Product | Stock</title>
@endsection

@push('css')
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('page_index')
{{$modelname}}
@endsection

@section('main_content')
<div class="row">
    <div class="col-md-12">
        @foreach ($errors->all() as $error)
            <li class="text-danger">{{ $error }}</li>
        @endforeach
    </div>
</div>
{{-- button --}}
@can('add-stock')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <button type="button" class="btn btn-primary waves-effect waves-light float-right" data-toggle="modal" data-target=".bs-example-modal-xl"> <i class="fas fa-user-plus"></i> Add Product</button>
            <br><br>
        </div>
    </div>
@endcan

{{-- table --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Download Types</h4>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap dtable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Vendor</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Price(buying)</th>
                            <th>Date</th>
                            <th>Storage</th>
                            <th>Note</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                            $product = \App\Product::where('id','=',$product_id)->first();
                            $vendors = \App\Vendor::all();
                            $storages = \App\IStorage::all();
                        @endphp
                        @foreach ($stocks as $stock)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{ $stock->product_code }}</td>
                                @php
                                    $category = \App\Category::where('id','=',$stock->category)->value('category_name');
                                    $vendor = \App\Vendor::where('id','=',$stock->vendor)->value('name');
                                    $storage_name = \App\IStorage::where('id','=',$stock->storage)->value('name');
                                @endphp
                                <td>{{ $product->name }}</td>
                                <td>{{ $vendor }}</td>
                                <td>{{ $stock->quantity }}</td>
                                <td>{{ $stock->unit }}</td>
                                <td>{{ $stock->price }}</td>
                                <td>{{ $stock->date }}</td>
                                <td>{{ $storage_name }}</td>
                                <td>{{ $stock->note }}</td>
                                <td>
                                    {{-- we have encrypted out id here so that in the url it will be converted into an encrypted text  --}}
                                    @php
                                        $editID = $stock->id;//assigning into the variable
                                        $editID = Crypt::encrypt($editID);//perform encryption
                                    @endphp
                                    
                                    @can('edit-stock')
                                        <a class="btn btn-primary" href="{{ route('stock.edit', $editID) }}"> <i class="fas fa-edit"></i> </a>
                                    @endcan
                                    @can('delete-stock')
                                        <a class="btn btn-danger" href="{{ route('stock.delete', $editID) }}" onclick="return confirm('Are you sure to delete the item?')"> <i class="fas fa-trash"></i> </a>
                                    @endcan            
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<!-- /.modal form-->
<div class="modal fade bs-example-modal-xl" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Products</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h5 class="card-title">ADD Product</h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form method="POST" action="{{ route('stock.store') }}">
                                                @csrf
                                                {{-- name --}}
                                                <div class="form-group">
                                                    <label for="name">Product Name:</label>
                                                    <input type="text" class="form-control" data-validation="required" name="product_id" value="{{ $product->name }}" disabled>
                                                    <input type="text" class="form-control" data-validation="required" name="product_id" value="{{ $product->id }}" hidden>
                                                </div>
                                                 {{-- code --}}
                                                 <div class="form-group">
                                                    <label for="name">Product Code:</label>
                                                    <input type="text" class="form-control" data-validation="required" name="product_code" value="{{ $product->code }}" readonly>
                                                </div>
                                                {{-- vendors --}}
                                                <div class="form-group">
                                                    <label for="name">Vendor Name:</label>
                                                    <select name="vendor" class="select2">
                                                        <option value="" selected disabled>Please choose.....</option>
                                                        @foreach ($vendors as $vendor)
                                                            <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {{-- quantity --}}
                                                <div class="form-group">
                                                    <label for="name">Quantity:</label>
                                                    <input type="number" class="form-control" value="1" data-validation="required" name="quantity">
                                                </div>
                                                {{-- unit --}}
                                                <div class="form-group">
                                                    <label for="name">Unit:</label>
                                                    <input type="text" class="form-control" data-validation="required" name="unit">
                                                </div>
                                                {{-- price --}}
                                                <div class="form-group">
                                                    <label for="name">Price:</label>
                                                    <input type="number" class="form-control" value="1" data-validation="required" name="price">
                                                </div>
                                                {{-- vendors --}}
                                                <div class="form-group">
                                                    <label for="name">Location:</label>
                                                    <select name="storage" class="select2">
                                                        <option value="" selected disabled>Please choose.....</option>
                                                        @foreach ($storages as $storage)
                                                            <option value="{{ $storage->id }}">{{ $storage->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {{-- date --}}
                                                <div class="form-group">
                                                    <label for="name">Date:</label>
                                                    <input type="text" class="form-control datepicker" name="date" autocomplete="off">
                                                </div>
                                                {{-- note --}}
                                                <div class="form-group">
                                                    <label for="name">Note:</label>
                                                    <textarea name="note" class="form-control"></textarea>
                                                </div>
                                                {{-- submit --}}
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success btn-md float-right">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
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
<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

<script>
    $(function () {
   // date only
   $('.datepicker').datepicker({
        format: 'd M yyyy',
        autoclose: true,
        orientation: "auto",
        todayHighlight: true,
        clearBtn:true
    });
  });
</script>

<script>
  $.validate({
    lang: 'en'
  });
</script>
@endpush
