<!DOCTYPE html>
<html lang="en">
<head>
  <title>Invoice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ asset('icons/logo.png') }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link href="{{ asset('plugins/css/icons.css') }}" rel="stylesheet" type="text/css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="container">
        {{-- banner --}}
        <div class="row">
            <div class="col-md-12">
                <img src="{{ asset('icons/baiust-banner.jpg') }}" alt="no-image" width="100%">
            </div>
        </div>
        {{-- products --}}
        <div class="row">
            <div class="col-md-6">
                <h6><u>Department:</u> &nbsp; {{ $department = \App\Department::where('id',$requisition->department)->value('name') }}</h6>
                <h6><u>Submitted By:</u> &nbsp; {{ $requisition->submittedBy }}</h6>
                <h6><u>Submission Date:</u> &nbsp; {{ date_format($requisition->created_at, 'd M yy') }}</h6>
                <h6><u>Receiver ID:</u> &nbsp; {{ $invoice->receiver }}</h6>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap dtable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <th>Product Name</th>
                        <th>Quantity</th>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            @php
                                $name = \App\Product::where('id','=',$product->product_id)->value('name');
                                $id = Crypt::encrypt($product->id);
                            @endphp
                            <tr>
                                <td>{{ $name }}</td>
                                <td>{{ $product->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for=""><u><b>Remarks:</b></u></label>
                <p>{!! html_entity_decode($invoice->remarks, ENT_QUOTES, 'UTF-8') !!}</p>
            </div>
        </div>
        {{-- signature portion --}}
        <div class="row mt-5">
            <div class="col-md-3" style="background-color:black; width:100%; height:2px"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3" style="background-color:black; width:100%; height:2px">
            </div>
            {{-- department --}}
            <div class="col-md-3">
                <p mt-5 class="text-center">Received By</p>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <p mt-5 class="text-center">Delivered By</p>
            </div>
        </div>
        {{-- footer --}}
        <div class="row">
            <div class="col-md-12">
                <p class="text-center">BAIUST Inventory Management System <i class="fas fa-copyright"></i> ICT WING & Archive</p>
            </div>
        </div>
    </div>

</body>
</html>
