<h2>{{$rows[0]->date}}</h2>
@foreach($rows as $row)

<li class="table-row">
    <div class="col col-1" data-label="row_id">{{$row->id}}</div>
    <div class="col col-2" data-label="Name">{{$row->name}}</div>
    <div class="col col-3" data-label="Date">{{$row->date}}</div>

</li>
@endforeach