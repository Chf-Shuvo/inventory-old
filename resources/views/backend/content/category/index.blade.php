@extends('backend.layout.master')

@section('title')
<title>Category List</title>
@endsection

@push('css')
<link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('page_index')
{{$modelname}}
@endsection

@section('main_content')
@can('add-category')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <button type="button" class="btn btn-primary waves-effect waves-light float-right" data-toggle="modal" data-target=".bs-example-modal-xl"> <i class="fas fa-plus"></i> Add Category</button>
            <br><br>
        </div>
    </div>
@endcan

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Download Types</h4>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap dtable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($categories as $category)
                            <tr>
                            <td>{{$i}}</td>
                                <td>{{$category->category_name}}</td>
                                <td>
                                    {{-- we have encrypted out id here so that in the url it will be converted into an encrypted text  --}}
                                    @php
                                        $editID = $category->id;//assigning into the variable
                                        $editID = Crypt::encrypt($editID);//perform encryption
                                    @endphp
                                    @can('edit-category')
                                        <a class="btn btn-primary" href="{{ route('category.edit', $editID) }}"> <i class="fas fa-edit"></i> </a>
                                    @endcan
                                    @can('delete-category')
                                        <a class="btn btn-danger" href="{{ route('category.delete', $editID) }}" onclick="return confirm('Are you sure to delete the item?')"> <i class="fas fa-trash"></i> </a> 
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
    <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Vendors - Panel</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-info">
                        <div class="card-header">
                            <h5 class="card-title">
                            ADD Vendor
                            <small>to the user panel</small>
                            </h5>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pad">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="POST" action="{{ route('category.store') }}">
                                            @csrf
                                            {{-- name --}}
                                            <div class="form-group">
                                                <label for="name">Category Name:</label>
                                                <input type="text" class="form-control" data-validation="required" name="category_name">
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
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
  $.validate({
    lang: 'en'
  });
</script>
@endpush
