{{-- resources/views/admin/home_content/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Nội dung Trang chủ</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">Cập nhật nội dung</div>
        <div class="card-body">
            <form method="POST" action="{{ route('home_content.save') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Tiêu đề</label>
                    <input type="text" name="title" class="form-control"
                           value="{{ old('title', $homeContent->title ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nội dung 1</label>
                    <textarea name="content1" class="form-control" rows="4">{{ old('content1', $homeContent->content1 ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nội dung 2</label>
                    <textarea name="content2" class="form-control" rows="4">{{ old('content2', $homeContent->content2 ?? '') }}</textarea>
                </div>

                <div class="row">
                    @for($i=1; $i<=3; $i++)
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Ảnh {{ $i }}</label>
                            <input type="file" name="image{{ $i }}" class="form-control">
                            @if(!empty($homeContent?->{'image'.$i}))
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $homeContent->{'image'.$i}) }}"
                                         alt="Image {{ $i }}"
                                         style="max-height:120px; border-radius:8px;">
                                </div>
                            @endif
                        </div>
                    @endfor
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
        </div>
    </div>
</div>
@endsection
