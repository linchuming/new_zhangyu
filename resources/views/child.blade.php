@extends('layouts.master')

@section('title','测试')

@section('sidebar')
@parent
@endsection

@section('content')
{{ $content }}
<form action="test/login" class="form-group" method="post">
    <div class="row">
        <div class="col-sm-1">用户名:</div>
        <div class="col-sm-3">
            <input type="text" class="form-control" name="user">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">密码:</div>
        <div class="col-sm-3">
            <input type="password" class="form-control" name="password">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">
            <button type="submit" class="btn btn-default">登录</button>
        </div>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
@endsection