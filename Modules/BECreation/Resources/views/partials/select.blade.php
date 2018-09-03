<option disabled selected value>Pilih Kategori Produk</option>
<option value=" "></option>
@foreach($data as $select)
    <option value="{{@$select->id}}">{{@$select->name}}</option>
@endforeach