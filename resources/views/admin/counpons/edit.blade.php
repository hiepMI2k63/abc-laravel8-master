@extends('layouts.admin')

@section('title','Cập nhật nhóm sản phẩm')

@section('content')
    <form action="{{route('admin.counpons.update',$counpon->id)}}" method='post'>
        @csrf @method('PUT')
        <div class="form-group">
          <label for="counpon">Counpon </label>
          <input type="text" value="{{$counpon->code}}" class="form-control" name="code" id="code" aria-describedby="helpId" placeholder="Tên Counpon">
          @error('code')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
          <label for="type">Type</label>
          <select class="form-control" name="type" id="type">
            <option value="fixed" @if ($counpon->type=="fixed") selected='selected' @endif>fixed</option>
            <option value="percent" @if ($counpon->type=="percent") selected='selected' @endif>percent</option>
          </select>
        </div>
        <div class="form-group">
          <label for="value">value</label>
          <input type="number" value="{{$counpon->value}}" class="form-control" name="value" id="value" aria-describedby="helpId" placeholder="Value">
          @error('value')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
            <label for="cart_value">Cart Value</label>
            <input type="number" value="{{$counpon->value}}" class="form-control" name="cart_value" id="cart_value" aria-describedby="helpId" placeholder="cart_value">
            @error('cart_value')
            <small class="text-danger">{{$message}}</small>
            @enderror
          </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection
