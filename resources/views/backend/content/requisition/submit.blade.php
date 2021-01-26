@extends('backend.layout.master')

@section('title')
<title>Submitted Requisitions</title>
@endsection

@push('css')
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('page_index')
    {{$modelname}}
@endsection

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
@can('create-requisition')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <button type="button" class="btn btn-primary waves-effect waves-light float-right" data-toggle="modal" data-target=".bs-example-modal-xl"> <i class="fas fa-user-plus"></i> New</button>
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
                            <th>Serial</th>
                            <th>Department</th>
                            <th>Submitted By</th>
                            <th>Date</th>
                            <th>Approval (Head)</th>
                            <th>Delivery Status</th>
                            <th>Receiver</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                            $dept = Auth::user()->department;
                            $department = App\Department::where('id','=',$dept)->value('name');
                        @endphp
                        @foreach ($requisitions as $requisition)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $department }}</td>
                                <td>{{ $requisition->submittedBy }}</td>
                                <td>{{ $requisition->created_at }}</td>
                                <td>
                                    @if ($requisition->app_head == '0')
                                        <span class="text-danger">Not Approved Yet</span>
                                    @else
                                        <span class="text-success">Approved</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($requisition->delivery_status == '0')
                                        <span class="text-warning">Processing</span>
                                    @else
                                        <span class="text-success">Delivered</span>
                                    @endif
                                </td>
                                <td>
                                    @if (empty($requisition->receiver))
                                        {{ 'N/A' }}
                                    @else
                                        {{ $requisition->receiver }}
                                    @endif
                                </td>
                                <td>
                                    {{-- we have encrypted out id here so that in the url it will be converted into an encrypted text  --}}
                                    @php
                                        $editID = $requisition->id;//assigning into the variable
                                        $editID = Crypt::encrypt($editID);//perform encryption
                                    @endphp
                                    @can('view-requisition', Model::class)
                                        <a class="btn btn-success" href="{{ route('approved.view',$editID) }}"> <i class="fas fa-eye"></i> </a>
                                    @endcan
                                    @can('receive-requisition', Model::class)
                                        @if ($requisition->delivery_status == 1 && $requisition->receiver == null)
                                            <a class="btn btn-success" href="{{ route('final.receive', $editID) }}"> <i class="fas fa-check"></i> Receive</a>
                                        @endif
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
                <h4 class="modal-title">Requisitions</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h5 class="card-title">Submit a Requisition</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pad">
                        <div class="mb-3">
                            <div class="form-group">  
                                <form method="POST" action="{{ route('submit.store') }}">
                                    @csrf  
                                    <div class="row">
                                        <div class="col-md-3">
                                            @php
                                                $reqID = \App\Requisition_Temp::all()->last();
                                            @endphp
                                            <div class="form-group">
                                                <label for="id">Requisition Number:</label>
                                                @if (empty($reqID))
                                                    <input type="text" class="form-control" value="1" readonly>
                                                @else
                                                    <input type="text" class="form-control" value="{{ $reqID->id+1 }}" readonly>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="id">Department:</label>
                                                <select name="department" class="form-control">
                                                    <option value="{{ $dept }}">{{ $department }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="lab_id">For:</label>
                                                @php
                                                    $d_id = Auth::user()->department;
                                                    $labs = \App\Department::where('parent_id',$d_id)->get();
                                                @endphp
                                                <select name="lab_id" class="form-control">
                                                    <option value="0">department</option>
                                                    @foreach ($labs as $lab)
                                                        <option value="{{ $lab->id }}">{{ $lab->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="id">Submitted By:</label>
                                                @php
                                                    $user = Auth::user()->name;
                                                @endphp
                                                <input type="text" class="form-control" value="{{ $user }}" name="submittedBy" readonly>
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
                                                                <option value="{{ $product->id }}">{{ $product->name.' - '.$product->brand }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" placeholder="place your number" name="quantity[]" value="1">
                                                    </td>
                                                    {{-- <td>
                                                        <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                                                    </td>   --}}
                                                </tr>  
                                          </table>  
                                     </div> 
                                     <div class="col-6">
                                        <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
    $(document).ready(function(){  
        var i=1;  
        $('#add').click(function(){  
            i++;  
            $('#dynamic_field').append('<tr id="row'+i+'"><td><select name="product[]" class="select2 form-control"><option value="" disabled selected>please choose....</option>@foreach ($products as $product)<option value="{{ $product->id }}">{{ $product->name.' - '.$product->brand }}</option>@endforeach</select></td><td id="number"><input type="number" class="form-control" placeholder="place your number" name="quantity[]" value="1"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
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
@endpush
