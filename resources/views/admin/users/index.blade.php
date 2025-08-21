@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Danh sách Users</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Ngày tạo</th>
                <th>Trạng thái email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $user->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
