@extends('backend.layout.master')

@section('title')
<title>Stocks</title>
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
            <li>{{ $error }}</li>
        @endforeach
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Download Types</h4>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap dtable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Product Category</th>
                            <th>Product Code</th>
                            <th>Current Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($products as $product)
                            <tr>
                                <td>{{$i}}</td>
                                @php
                                    $category = \App\Category::where('id','=',$product->category)->value('category_name');
                                @endphp
                                <td>{{$product->name}}</td>
                                <td>{{ $category }}</td>
                                <td>{{ $product->code }}</td>
                                <td>
                                    @php
                                        $current_stock = \App\Stock::where('product_code',$product->code)->sum('quantity');
                                    @endphp 
                                    {{ $current_stock }}
                                </td>
                                <td>
                                    {{-- we have encrypted out id here so that in the url it will be converted into an encrypted text  --}}
                                    @php
                                        $editID = $product->id;//assigning into the variable
                                        $editID = Crypt::encrypt($editID);//perform encryption
                                    @endphp
                                    @can('view-stock')
                                        <a class="btn btn-success" href="{{ route('product.stock',$editID) }}"> <i class="fas fa-eye"></i> view stock</a>
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
<script type="text/javascript">
    //fetch and assign to select2
    $('#category').change(function(){
        var input_value = $(this).children("option:selected").val();
        var path = "{{ route('product_fetch') }}";
        console.log(path);
        $.ajax({
            type : "get",
            url : path,
            data : {value: input_value},
            dataType: "html",
            success : function(data){
                //console.log(data);
                $('#product_name').empty().html(data);
            }
        });
    })
</script>
<script type="text/javascript">
    //fetch and assign to select2
    $('#product_name').change(function(){
        var input_value = $(this).children("option:selected").val();
        var path = "{{ route('color_fetch') }}";
        $.ajax({
            type : "get",
            url : path,
            data : {value: input_value},
            dataType: "json",
            success : function(data){
                //console.log(data);
                $('#product_price').val(data.price);
            }
        });
    })
</script>
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
