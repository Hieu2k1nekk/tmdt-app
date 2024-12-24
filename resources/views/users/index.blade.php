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
    <div class="table-responsive">
        <form id="bulk-delete-form" action="{{ route('users.bulkDelete') }}" method="POST">
            @csrf
            <table class="table table-striped table-bordered table-hover dataTables-example">
                <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="select-all">
                    </th>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên người dùng</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th width="10%">Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="gradeX">
                        <td width="2%">
                            <input type="checkbox" name="user_ids[]" value="{{ $user->id }}">
                        </td>
                        <td>{{ $user->id }}</td>
                        <td width="10%">
                            <img src="https://ampet.vn/wp-content/uploads/2022/09/Meo-tai-cup-Scottish-Fold-2.jpg"
                                 class="img-circle img-lg">
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td class="center">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary" title="Chỉnh sửa">
                                <i class="fa fa-edit"></i>
                            </a>
                            <!-- Form xóa riêng từng người dùng -->
                            <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display:inline;"
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
            <button type="submit" class="btn btn-danger">Xóa đã chọn</button>
        </form>

    </div>
    <div class="pagination">
        {{ $users->links('pagination::bootstrap-4') }}
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
