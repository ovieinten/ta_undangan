<option disabled selected value>Pilih Parent Warna</option>
<option value=" "></option>
@foreach($data as $select)
    <option value="{{$select->id}}">{{$select->name}}</option>
@endforeach