@extends('backend.layout.master')

@section('title')
<title>Requisition Slip - {{ $department->name }}</title>
@endsection

@push('css')
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
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
{{-- approved list --}}
<div class="card">
    <div class="card-body">
        <h4 class="mt-0 header-title">Requisition Slip of {{ $department->name }}</h4>
        @php
            $id = Crypt::encrypt($requisition->id);
        @endphp
        
        <div class="row">
            <div class="form-group col-md-6">
                <label>Department:</label>
                <input type="text" class="form-control" name="department" value="{{ $department->name }}" readonly>
            </div>
            <div class="form-group col-md-6">
                <label>Submitted By:</label>
                <input type="text" name="submittedBy" class="form-control" value="{{ $requisition->submittedBy }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap dtable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <th>Product Name</th>
                        <th>Product Code</th>
                        <th>Quantity(Requested)</th>
                        <th>Quantity(Current)</th>
                        <th>Unit</th>
                    </thead>
                    <tbody>
                        {{-- req_products from RqProducts Table --}}
                        @foreach ($req_products as $product)
                            @php
                                $name = \App\Product::where('id','=',$product->product_id)->first();
                                $id = Crypt::encrypt($product->id);
                                $cStock = App\DlProduct::where('department',$department->id)
                                                        ->where('product_id',$product->id)
                                                        ->sum('quantity');
                                $unit = App\Stock::where('product_id',$product->id)->value('unit')
                            @endphp
                            <tr>
                                <td>{{ $name->name}}</td>
                                <td>{{ $name->code}}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $cStock }}</td>
                                <td>{{  $unit }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
@endpush

