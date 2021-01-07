<div class="row">

    <input type="text" name="name" placeholder="Name"   class="form-control mb-2" value="{{ old('name') ?? $product->name ?? '' }}"/>
    <input type="text" name="brand" placeholder="Brand"   class="form-control col-6 mb-2" value="{{ old('brand') ?? $product->brand ?? ''  }}"/>
    <input type="number" name="price" placeholder="Price"   class="form-control col-6 mb-2" value="{{ old('price') ?? $product->price ?? '' }}"/>
    <input type="number" name="qty" placeholder="Quantity"   class="form-control col-6 mb-2" value="{{ old('qty') ?? $product->qty ?? '' }}"/>

</div>
<div class="row">
<div class="col-6">

    <button type="submit" class="btn btn-primary" value="Enviar">Send</button>
</div>

<div class="col-6">
    <a class="btn btn-light" href="{{ route('admin.products.index') }}" title="Go back">Cancel</a>
</div>
</div>
