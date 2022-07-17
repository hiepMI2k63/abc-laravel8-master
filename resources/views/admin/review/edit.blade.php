@extends('layouts.admin')

@section('title','Cập nhật comment')

@section('content')
    <form action="{{route('admin.review.update',$user->id)}}" method='post'>
        @csrf @method('PUT')
        <div class="form-group">
          <label for="user">comment </label>
          <input type="text" value="{{$user->comment}}" class="form-control" name="comment" id="name" aria-describedby="helpId" placeholder="Tên user">
          @error('comment')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
          <label for="rating">rating</label>
          <input type="text" value="{{$user->rating}}"placeholder="{{$user->rating}}" class="form-control" name="rating" id="rating" aria-describedby="helpId" >
          @error('rating')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection
