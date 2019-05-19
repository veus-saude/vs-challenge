
<select class="form-control" name="brand" id="cb_brand">
    @foreach ($cb_brandById as $value)                                   
        <option value="{{ $value->id }}" {{ ( isset($response['data']['brand']['id']) && $response['data']['brand']['id'] == $value->id && empty(old('brand'))) ? 'selected' : (old('brand') == $value->id) ? 'selected' : null }} >
        {{ $value->name }}
        </option>                             
    @endforeach            
</select>  
