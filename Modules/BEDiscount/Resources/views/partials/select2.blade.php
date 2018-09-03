<option disabled selected value>Pilih Produk</option>
<option value=" "></option>
@foreach(@$data['payment'] as $item)
    <option value="{{@$item->id}}">{{@$item->id}}</option>
@endforeach