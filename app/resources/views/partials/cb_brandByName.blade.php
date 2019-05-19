
<select class="form-control" name="brand" id="cb_brand">
    <option value="">Informe marca do produto</option> 
    @foreach ($cb_brandByName as $value)   
                                       
        <option value="{{ $value->name }}" {{ ( isset($request->brand) && $request->brand == $value->name && empty(old('brand'))) ? 'selected' : (old('brand') == $value->name) ? 'selected' : null }} >
        {{ $value->name }}
        </option>                             
    @endforeach            
</select>  
