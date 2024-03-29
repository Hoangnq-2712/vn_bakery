@extends('admin.layouts.backend')


@section('backend')
<div class="panel panel-primary" style="margin:0px 10px;margin-top: 20px;">
	<div class="panel-heading">
		<h3 class="panel-title">Sửa danh mục</h3>
	</div>
	@if(Session::has('message'))
	<div>
		<div class="alert alert-{{Session::get('level')}}">
			<p>{{Session::get('message')}}</p>
		</div>
	</div>
	@endif
	<div class="panel-body">
		<div class="row">
			<form action="{{route('tai-khoan.update',$listUsers->id)}}" method="POST" role="form">
				{!! csrf_field() !!}
				{!! method_field('PUT') !!}
				<div class="col-md-6"><div class="form-group">
					<label for="">Tên người dùng</label>
					<input type="text" class="form-control" name="name" placeholder="Nhập tên người dùng" value="{{$listUsers->name}}">
					@if($errors->has('name'))
					<div class="help-block" style="color: red">
						{!!$errors->first('name')!!}
					</div>
					@endif
				</div>
				<div class="form-group">
					<label for="">E-Mail</label>
					<input type="text" class="form-control" name="email" placeholder="Nhập email" value="{{$listUsers->email}}">
					@if($errors->has('email'))
					<div class="help-block" style="color: red">
						{!!$errors->first('email')!!}
					</div>
					@endif
				</div>
				<div class="form-group">
					<label for="">Mật khẩu mới</label>
					<input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" >
					@if($errors->has('password'))
					<div class="help-block" style="color: red">
						{!!$errors->first('password')!!}
					</div>
					@endif
				</div>
				<div class="form-group">
					<label for="">Nhập lại mật khẩu</label>
					<input type="password" class="form-control" name="re_password" placeholder="Nhập mật khẩu">
					@if($errors->has('re_password'))
					<div class="help-block" style="color: red">
						{!!$errors->first('re_password')!!}
					</div>
					@endif
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Số điện thoại</label>
					<input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại" value="{{$listUsers->phone}}">
					@if($errors->has('phone'))
					<div class="help-block" style="color: red">
						{!!$errors->first('phone')!!}
					</div>
					@endif
				</div>
				<div class="form-group">
					<label for="">Ngày sinh:____{!!$listUsers->birthday!!}</label>
					<input type="date" class="form-control" name="birthday"  value="{{$listUsers->birthday}}">

				</div>
				<div class="form-group">
					<label for="">Giới tính</label>
					<select name="gender" id="inputStatus" class="form-control" >
						@if($listUsers->gender==1)
						<option value="1" >Nam</option>
						<option value="0" >Nữ</option>
						@else
						<option value="0">Nữ</option>
						<option value="1">Nam</option>
						@endif
					</select>
				</div>

				<div class="form-group">
					<label for="">Quyền truy cập</label>
					<select name="level" id="inputStatus" class="form-control" >
						@if($listUsers->level==1)
						<option value="1" >admin</option>
						<option value="0" >khách hàng</option>
						@else
						<option value="0">khách hàng</option>
						<option value="1">admin</option>
						@endif
					</select>
				</div>
			</div>
			
			<div class="text-center panel-footer">
				<button type="submit" class="btn btn-primary">Cập nhật</button>
			</div>
		</form>
	</div>
</div>
</div>
@stop()