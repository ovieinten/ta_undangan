<option disabled selected value>Pilih Produk</option>
<option value=" "></option>
@foreach(@$data['product'] as $item)
    <option value="{{@$item->id}}">{{@$item->name}}</option>
@endforeach