@extends('backend.layout.master')

@section('title')
<title>Stocks</title>
@endsection

@push('css')
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

@php
    $id = Crypt::encrypt($transfer->id);
@endphp

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('transfer.execute', $id) }}">
        @method('PATCH')
        @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="rq id">Requisition ID:</label>
                        <select name="requisition_id" class="select2">
                            <option value="" selected disabled>Please Choose....</option>
                            @foreach ($newReq as $req)
                                <option value="{{ $req->id }}">{{ "Req#".$req->id." by- ".$req->submittedBy }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="rq id">Product:</label>
                        <input type="text" class="form-control" value="{{ $product->name }}" readonly>
                        <input type="text" class="form-control" name="product_id" value="{{ $product->id }}" hidden>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="rq id">Quantity:</label>
                        <input type="number" class="form-control" name="quantity" value="{{ $transfer->quantity }}" max="{{ $transfer->quantity }}" min="1">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary float-right">submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
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
