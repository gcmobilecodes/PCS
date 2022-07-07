@if(count($data)>0)
@foreach($data as $key=>$row)

<tr>

    <td>{{$key+1}} </td>
    <td>{{$row->name}}</td>
    <td>{{$row->mobile_number}}</td>
    <td>{{date('Y-m-d',strtotime($row->getCheckinoutDetail->date))}}</td>
    <td> <button type="button" class="btn btn-primary" > View Details</button>&nbsp;&nbsp<i class="fa fa-trash" aria-hidden="true"></i></td>

</tr>
@endforeach
@else
<center>data not found</center>
@endif
