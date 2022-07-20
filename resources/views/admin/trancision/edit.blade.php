@extends('layouts.admin')

@section('title',' page for update trancision')

@section('content')
    <form action="{{route('admin.trancision.update',$trancision->id)}}" method='post'>
        @csrf @method('PUT')
        {{-- <div class="form-group">
          <label for="counpon">Counpon </label>
          <input type="text" value="{{$trancision->code}}" class="form-control" name="code" id="code" aria-describedby="helpId" placeholder="Tên Counpon">
          @error('code')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
          <label for="type">Type</label>
          <select class="form-control" name="type" id="type">
            <option value="fixed" @if ($trancision->type=="fixed") selected='selected' @endif>fixed</option>
            <option value="percent" @if ($trancision->type=="percent") selected='selected' @endif>percent</option>
          </select>
        </div>
        <div class="form-group">
          <label for="value">value</label>
          <input type="number" value="{{$trancision->value}}" class="form-control" name="value" id="value" aria-describedby="helpId" placeholder="Value">
          @error('value')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div> --}}
        <div class="form-group">
            <label for="trancision_status">Cart Value</label>
            <select class="form-control" name="status" id="status">
                <option value="chấp thuận( có thể cancel)" @if ($trancision->status=='chấp thuận( có thể cancel)') selected='selected' @endif>chấp thuận( có thể cancel)</option>
                <option value="đang giao hàng cấm boom hàng" @if ($trancision->status=='đang giao hàng cấm boom hàng') selected='selected' @endif>đang giao hàng cấm boom hàng</option>
                <option value="đã giao thành công" @if ($trancision->status=='đã giao thành công') selected='selected' @endif>đã giao thành công</option>
                <option value='chưa giải quyết(có thể cancel)' @if ($trancision->status=='chưa giải quyết(có thể cancel)') selected='selected' @endif>'chưa giải quyết(có thể cancel)'</option>
              </select>
            @error('trancision_status')
            <small class="text-danger">{{$message}}</small>
            @enderror
          </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection
