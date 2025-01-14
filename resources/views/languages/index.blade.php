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
                    <a>{{ $config['index']['title'] }}</a>
                </li>
                <li class="active">
                    <strong>{{ $config['index']['table'] }}</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="ibox-content" style="">
        <div class="row">
            <div class="ibox-content m-b-sm border-bottom">
                <form action="{{ route('language.index') }}" method="GET">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="search">Tên</label>
                                <input type="text" id="search" name="search" value="{{ request()->get('search', '') }}" placeholder="Tìm kiếm theo tên" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="per_page">Phân trang</label>
                                <select name="per_page" id="per_page" class="form-control" onchange="this.form.submit()">
                                    <option value="10" {{ request()->get('per_page', 20) == 10 ? 'selected' : '' }}>10 bản ghi</option>
                                    <option value="20" {{ request()->get('per_page', 20) == 20 ? 'selected' : '' }}>20 bản ghi</option>
                                    <option value="30" {{ request()->get('per_page', 20) == 30 ? 'selected' : '' }}>30 bản ghi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="price">{{ $config['create']['title'] }}</label>
                                <br>
                                <a href="{{ route('language.create') }}" class="btn btn-primary" style="width: 60%">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
    <div class="table-responsive">
        <form id="bulk-delete-form" action="{{ route('language.bulkDelete') }}" method="POST">
            @csrf
            <table class="table table-striped table-bordered table-hover dataTables-example">
                <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="select-all">
                    </th>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Ảnh</th>
                    <th>Canonical</th>
                    <th>Người đăng</th>
                    <th width="10%">Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($languages as $language)
                    <tr class="gradeX">
                        <td width="2%">
                            <input type="checkbox" name="user_ids[]" value="{{ $language->id }}">
                        </td>
                        <td>{{ $language->id ?? '' }}</td>
                        <td>{{ $language->name ?? '' }}</td>
                        <td width="10%">
                            <img src="{{ asset('storage/' . $language->image) }}" class="img-circle img-lg" alt="{{ $language->name }}">
                        </td>
                        <td>{{ $language->canonical ?? '' }}</td>
                        <td>{{ $language->user->name ?? '' }}</td>
                        <td class="center">
                            <a href="{{ route('language.edit', $language->id) }}" class="btn btn-primary" title="Chỉnh sửa">
                                <i class="fa fa-edit"></i>
                            </a>
                            <!-- Form xóa riêng từng người dùng -->
                            <form action="{{ route('language.delete', $language->id) }}" method="POST" style="display:inline;"
                                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="Xóa">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>

    </div>
    <div class="pagination">
{{--        {{ $languages->links('pagination::bootstrap-4') }}--}}
    </div>
    <div class="footer">
        <div class="pull-right">
            10GB of <strong>250GB</strong> Free.
        </div>
        <div>
            <strong>Copyright</strong> Example Company &copy; 2014-2017
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAllCheckbox = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('input[name="user_ids[]"]');

            selectAllCheckbox.addEventListener('change', function () {
                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });
        });
    </script>
@endsection
