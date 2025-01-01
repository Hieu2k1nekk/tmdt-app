@extends('layouts.app')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Thành viên</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>
                    <a>Quản lý thành viên</a>
                </li>
                <li class="active">
                    <strong>Thêm mới thành viên</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <div class="ibox-content">
        <form class="form-horizontal" action="{{ route('users.store') }}" method="POST">
            @csrf
            <h5>Thêm Người Dùng Mới</h5>

            <div class="form-group">
                <label class="col-lg-2 control-label">Tên người dùng</label>
                <div class="col-lg-10">
                    <input type="text" name="name" placeholder="Tên người dùng" class="form-control" value="{{ old('name') }}" required>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <span class="help-block m-b-none">Nhập tên người dùng mới.</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label">Email</label>
                <div class="col-lg-10">
                    <input type="email" name="email" placeholder="Email" class="form-control" value="{{ old('email') }}" required>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <span class="help-block m-b-none">Ví dụ: example@example.com.</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label">Mật khẩu</label>
                <div class="col-lg-10">
                    <input type="password" name="password" placeholder="Mật khẩu" class="form-control" required>
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <span class="help-block m-b-none">Nhập mật khẩu cho người dùng mới.</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label">Vai trò</label>
                <div class="col-lg-10">
                    <select name="role" class="form-control">
                        <option value="user">Người dùng</option>
                        <option value="admin">Quản trị viên</option>
                    </select>
                    @error('role')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-sm btn-primary" type="submit">Thêm Người Dùng</button>
                </div>
            </div>
        </form>
    </div>

    <div class="footer">
        <div class="pull-right">
            10GB of <strong>250GB</strong> Free.
        </div>
        <div>
            <strong>Copyright</strong> Example Company &copy; 2014-2017
        </div>
    </div>
@endsection
