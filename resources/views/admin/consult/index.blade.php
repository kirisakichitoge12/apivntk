@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Quản lý yêu cầu tư vấn</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Số điện thoại</th>
                    <th>Tin nhắn</th>
                    <th>Ngày gửi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($consults as $consult)
                    <tr>
                        <td>{{ $consult->id }}</td>
                        <td>{{ $consult->name }}</td>
                        <td>{{ $consult->phone }}</td>
                        <td>{{ $consult->message }}</td>
                        <td>{{ $consult->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Chưa có yêu cầu tư vấn nào</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $consults->links() }}
    </div>
</div>
@endsection
