@extends('layouts.admin')

@section('title','Thêm mới Counpon')

@section('content')
    <form action="{{route('admin.counpons.store')}}" method='post'>
        @csrf
        <div class="form-group">
          <label for="counpons">Counpons</label>
          <input type="text" value="{{old('code')}}" class="form-control" name="code" id="counpons" aria-describedby="helpId" placeholder="Tên Counpon">
          @error('code')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
          <label for="type">Type</label>
          <select class="form-control" name="type" id="type">
            <option value="fixed" @if (old('type')==1) selected='selected' @endif>fixed</option>
            <option value="percent" @if (old('type')!=null and old('type')==0) selected='selected' @endif>percent</option>
          </select>
        </div>
        <div class="form-group">
          <label for="value">Value</label>
          <input type="number" value="{{old('value')}}" class="form-control" name="value" id="value" aria-describedby="helpId" placeholder="value">
          @error('value')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
            <label for="cart_value">Cart Value</label>
            <input type="number" value="{{old('cart_value')}}" class="form-control" name="cart_value" id="cart_value" aria-describedby="helpId" placeholder="cart_value">
            @error('cart_value')
            <small class="text-danger">{{$message}}</small>
            @enderror
          </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
@endsection
