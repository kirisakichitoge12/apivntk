@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Lịch sử thao tác</h2>
   <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Admin ID</th>
            <th>Tên Admin</th>
            <th>Hành động</th>
            <th>Bảng tác động</th>
            <th>Chi tiết</th>
            <th>Thời gian</th>
        </tr>
    </thead>
    <tbody>
        @foreach($histories as $history)
            <tr>
                <td>{{ $history->id }}</td>
                <td>{{ $history->admin_id }}</td>
                <td>{{ $history->admin_name }}</td>
                <td>{{ $history->action }}</td>
                <td>{{ $history->table_name }}</td>
                <td>{{ $history->details }}</td>
                <td>{{ \Carbon\Carbon::parse($history->acted_at)->format('d/m/Y H:i') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="pagination">
    {{ $histories->links() }}
</div>

</div>
@endsection
