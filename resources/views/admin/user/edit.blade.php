@extends('layouts.admin')

@section('title','Cập nhật user')

@section('content')
    <form action="{{route('change',$user->id)}}" method='post'>
        @csrf @method('PUT')
        <div class="form-group">
          <label for="user">user </label>
          <input type="text" value="{{$user->name}}" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Tên user">
          @error('name')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
          <label for="email">email</label>
          <input type="text" placeholder="{{$user->name}}" class="form-control" name="email" id="email" aria-describedby="helpId" >
          @error('email')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" placeholder="{{$user->password}}" class="form-control" name="password" id="password" aria-describedby="helpId" >
            @error('password')
            <small class="text-danger">{{$message}}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="level">level</label>
            <select class="form-control" name="level" id="level">
              <option value="1" @if ($user->level=="1") selected='selected' @endif>admin</option>
              <option value="0" @if ($user->level=="0") selected='selected' @endif>customer</option>
            </select>
          </div>
          <div class="form-group">
            <label for="status">status</label>
            <select class="form-control" name="status" id="status">
              <option value="1" @if ($user->status=="1") selected='selected' @endif>online</option>
              <option value="0" @if ($user->status=="0") selected='selected' @endif>offline</option>
            </select>
          </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection
