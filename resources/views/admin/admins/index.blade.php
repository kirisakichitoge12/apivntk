@extends('layouts.admin')
@section('content')
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Phân quyền</th>
            <th>Ngày tạo</th>
        </tr>
    </thead>
    <tbody>
        @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->role }}</td>
                <td>{{ $admin->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="pagination">
    {{ $admins->links() }}
</div>

@endsection
