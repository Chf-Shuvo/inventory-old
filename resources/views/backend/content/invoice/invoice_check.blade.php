@extends('backend.layout.master')

@section('title')
<title>Product | Delivery</title>
@endsection

@section('main_content')
{{-- approved list --}}
<div class="card">
    <div class="card-body">
        {{-- products --}}
        <div class="row">
            <div class="col-md-6">
                <h6><u>Department:</u> &nbsp; {{ $department = \App\Department::where('id',$requisition->department)->value('name') }}</h6>
                <h6><u>Submitted By:</u> &nbsp; {{ $requisition->submittedBy }}</h6>
                <h6><u>Submission Date:</u> &nbsp; {{ date_format($requisition->created_at, 'd M yy') }}</h6>
                <h6><u>Invoice ID:</u> &nbsp; {{ "Invoice#".$invoice->id }}</h6>
            </div>
        </div>
        <form action="{{ route('invoice.print', $id=Crypt::encrypt($invoice->id)) }}" method="post">
            @csrf
            @method("PATCH")
            <div class="row mt-3">
                <div class="col-12">
                    <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
               
                <div class="col-6">
                    <div class="form-group">
                        <label for="receiver_name">Receiver</label>
                        <input type="text" name="receiver" class="form-control" @if ($invoice->receiver == null)
                            value=""
                        @else
                            value="{{ $invoice->receiver }}" readonly
                        @endif required>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="">Remarks:</label>
                        <p>{!! html_entity_decode($invoice->remarks, ENT_QUOTES, 'UTF-8') !!}</p>
                    </div>
                </div>
               
                <div class="col-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg float-right"><i class="fas fa-print"></i> Print</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
