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
                    <strong>Thành viên</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <div class="ibox-content">
        <form class="form-horizontal" action="{{ route('language.store') }}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <h5>Thêm Ngôn Ngữ Mới</h5>

            <div class="form-group">
                <label class="col-lg-2 control-label">Tên Ngôn Ngữ</label>
                <div class="col-lg-10">
                    <input type="text" name="name" placeholder="Tên ngôn ngữ" class="form-control"
                           value="{{ old('name') }}" required>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <span class="help-block m-b-none">Nhập tên ngôn ngữ mới.</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label">Canonical</label>
                <div class="col-lg-10">
                    <input type="text" name="canonical" placeholder="Canonical" class="form-control"
                           value="{{ old('canonical') }}" required>
                    @error('canonical')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <span class="help-block m-b-none">Nhập canonical cho ngôn ngữ.</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label">Hình Ảnh</label>
                <div class="col-lg-10">
                    <input type="file" name="image" class="form-control">
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <span class="help-block m-b-none">Chọn hình ảnh cho ngôn ngữ (tùy chọn).</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-sm btn-primary" type="submit">Thêm Ngôn Ngữ</button>
                </div>
            </div>
        </form>
    </div>`

    <div class="footer">
        <div class="pull-right">
            10GB of <strong>250GB</strong> Free.
        </div>
        <div>
            <strong>Copyright</strong> Example Company &copy; 2014-2017
        </div>
    </div>
@endsection
