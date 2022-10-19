@extends('layouts.admin')

@section('title','Trancision')

@section('content')
<div class="row mt-2">
  <div class="col">
    <form action="" class="form-inline">
      <div class="form-group">
        <input type="text" name="key" class="form-control" placeholder="Search by name" aria-describedby="helpId">
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </form>
  </div>
  <div class="col">
    <a href="{{url('admin/user/create')}}" class="btn btn-primary float-right">Thêm mới</a>
  </div>
</div>
<hr>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>User</th>
                <th>User </th>
                <th>mode</th>
                <th>status</th>
                <th class='text-right'>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
            <tr>
                <td>{{$d->user2->name}}</td>
                <td>{{$d->order_id}}</td>
                <td>
                    @if ($d->mode=="online")
                        <span class="badge badge-primary">Online</span>
                    @else
                        <span class="badge badge-danger">Cash</span>
                    @endif
                </td>
                <td>{{$d->status}}</td>
                <td class="text-right">
                    <a name="" id="" class="btn btn-sm btn-primary" href="{{route('admin.trancision.edit', $d->id)}}" role="button"><i class="fa fa-edit"></i></a>
                    <a name="" id="" class="btn btn-sm btn-danger btndelete" href="{{route('admin.trancision.destroy',$d->id)}}" role="button"><i class="fa fa-trash"></i> </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <form id='formdelete' action="" method="post">
        @csrf @method('DELETE')
    </form>
    {{$data->appends(Request::all())->links()}}


@endsection

@section('js')
<script>
    $(".btndelete").click(function(ev){
        ev.preventDefault();
        let _href=$(this).attr('href');
        $("form#formdelete").attr('action',_href);
        if (confirm('Bạn muốn xóa bản ghi này không?'))
        {
            $("form#formdelete").submit();
        }
    });
</script>
@endsection
