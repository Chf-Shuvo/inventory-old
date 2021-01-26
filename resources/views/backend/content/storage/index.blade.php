@extends('backend.layout.master')

@section('title')
<title>Storages</title>
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
@can('add-storage')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <button type="button" class="btn btn-primary waves-effect waves-light float-right" data-toggle="modal" data-target=".bs-example-modal-xl"> <i class="fas fa-user-plus"></i> Add Storage</button>
            <br><br>
        </div>
    </div>   
@endcan

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Download Types</h4>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Storage Name</th>
                            <th>Storage Location</th>
                            <th>Types Of Product</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($storages as $storage)
                            <tr>
                            <td>{{$i}}</td>
                                <td>{{$storage->name}}</td>
                                <td>{{$storage->location}}</td>
                                @php
                                    $category = \App\Category::where('id','=',$storage->product_category)->value('category_name');
                                @endphp
                                <td>{{ $category }}</td>
                                <td>
                                    {{-- we have encrypted out id here so that in the url it will be converted into an encrypted text  --}}
                                    @php
                                        $editID = $storage->id;//assigning into the variable
                                        $editID = Crypt::encrypt($editID);//perform encryption
                                    @endphp
                                    {{-- <a class="btn btn-success" href="#"> <i class="far fa-eye"></i> </a> --}}
                                    {{-- sending encrypted data into FacultyCRUDcontroller edit function --}}
                                    @can('view-storage', Model::class)
                                        <a class="btn btn-primary" href="{{ route('storage.show', $editID) }}"> <i class="fas fa-eye"></i> </a> 
                                    @endcan
                                    @can('edit-storage', Model::class)
                                        <a class="btn btn-primary" href="{{ route('storage.edit', $editID) }}"> <i class="fas fa-edit"></i> </a>
                                    @endcan
                                    @can('delete-storage', Model::class)
                                        <a class="btn btn-danger" href="{{ route('storage.delete', $editID) }}" onclick="return confirm('Are you sure to delete the item?')"> <i class="fas fa-trash"></i> </a>
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

{{-- form modal --}}
<div class="modal fade bs-example-modal-xl" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Storages</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h5 class="card-title">ADD storage</h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form method="POST" action="{{ route('storage.store') }}">
                                                @csrf
                                                {{-- name --}}
                                                <div class="form-group">
                                                    <label for="name">Storage Name:</label>
                                                    <input type="text" class="form-control" data-validation="required" name="name" value="{{ old('name') }}">
                                                </div>

                                                {{-- location --}}
                                                <div class="form-group">
                                                    <label for="location">Location:</label>
                                                    <input type="text" class="form-control" data-validation="required" name="location" value="{{ old('location') }}">
                                                </div>

                                                {{-- product_category --}}
                                                <div class="form-group">
                                                    <label for="product_category">Types of Product:</label>
                                                    <select name="product_category" class="select2" data-validation="required">
                                                        <option value="" selected disabled>Please choose....</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                        @endforeach
                                                    </select>
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
        <!-- /.modal -->
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
