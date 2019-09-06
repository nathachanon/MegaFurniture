@extends('admin.layout_admin')

@section('content')

<div class="text-head">
    <h1 class="animated fadeInRight">ยินดีต้อนรับเข้าสู่ Admin Centre</h1>
    <div class="ibox-content ">
      <div class="animated bounceIn">
        <a href="promotion" ><button class="btn btn-info dim2 btn-large-dim  ani b-shadow " type="button"><i class="fa fa-strikethrough"></i><div class="text-title">โปรโมชัน</div></button></a>
        <a href="content"><button class="btn btn-danger dim2 ani btn-large-dim ani b-shadow " type="button"><i class="fa fa-align-left"></i><div class="text-title">คอนเทนต์</div></button></a>
      </div>
    </div>
  </div>

@endsection
