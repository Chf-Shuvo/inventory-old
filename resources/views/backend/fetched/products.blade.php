<option value="" selected disabled>Please choose....</option> 
@foreach ($products as $product)
    <option value="{{ $product->id }}">{{ $product->name }}</option>
@endforeach
