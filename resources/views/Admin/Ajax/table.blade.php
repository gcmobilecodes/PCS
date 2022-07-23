@if(count($data)>0)

@foreach($data as $key=>$row)

<tr>


    <td>&nbsp;&nbsp;&nbsp;{{$row->id}} </td>
    <td>&nbsp;&nbsp;&nbsp;{{$row->getCheckinoutDetail->name}}</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$row->getCheckinoutDetail->mobile_number}}</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$row->user_id}}</td>

    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{date('Y-m-d',strtotime($row->date))}}</td>

    <td>                 <div  class="btn btn-sm edit-modal"  data-id=' {{$row->id}}' name='.$-> name .'> <button type="button" class="btn btn-primary" > View Details</button></div>
        <div class="delete-modal btn  btn-sm" data-id='{{$row->id}}'  id="deletecategory1" name='.$row->name.'><i class="fa fa-trash" aria-hidden="true"></i></div></td>

</tr>
@endforeach
@else
<center>data not found</center>
@endif
