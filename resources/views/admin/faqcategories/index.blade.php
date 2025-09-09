@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Danh mục FAQ</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('faq-categories.create') }}" class="btn btn-primary mb-3">+ Thêm danh mục</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên danh mục</th>
                <th>Slug</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $key => $cat)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->slug }}</td>
                    <td>
                        <a href="{{ route('faq-categories.edit', $cat->id) }}" class="btn btn-sm btn-warning">Sửa</a>

                        <form action="{{ route('faq-categories.destroy', $cat->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Chưa có danh mục nào</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
