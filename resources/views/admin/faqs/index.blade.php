@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Câu hỏi thường gặp</h2>

    <div class="card mb-3">
        <div class="card-body">
            <form class="row g-2" method="GET" action="{{ route('faqs.index') }}">
                <div class="col-md-4">
                    <select name="category_id" class="form-select">
                        <option value="">-- Tất cả danh mục --</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}" {{ request('category_id') == $c->id ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input name="q" class="form-control" placeholder="Tìm theo câu hỏi..." value="{{ request('q') }}">
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button class="btn btn-primary">Lọc</button>
                    <a href="{{ route('faqs.index') }}" class="btn btn-secondary">Xóa lọc</a>
                    <a href="{{ route('faqs.create') }}" class="btn btn-success ms-auto">+ Thêm câu hỏi</a>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive" style="overflow-x:auto;">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th style="white-space:nowrap;">ID</th>
                    <th style="white-space:nowrap;">Danh mục</th>
                    <th style="white-space:nowrap;">Câu hỏi</th>
                    <th style="white-space:nowrap;">Hành động</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($faqs as $f)
                <tr>
                    <td>{{ $f->id }}</td>
                    <td>{{ optional($f->category)->name }}</td>
                    <td>{{ $f->question }}</td>
                    <td style="white-space:nowrap;">
                        <a href="{{ route('faqs.edit', $f->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('faqs.destroy', $f->id) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa câu hỏi này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted">Chưa có câu hỏi</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $faqs->links() }}
    </div>
</div>
@endsection
