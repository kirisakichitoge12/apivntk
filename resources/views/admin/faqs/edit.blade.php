@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Sửa câu hỏi #{{ $faq->id }}</h2>
    <form action="{{ route('faqs.update', $faq->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select name="category_id" class="form-select" required>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" {{ old('category_id', $faq->category_id) == $c->id ? 'selected' : '' }}>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div class="text-danger mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Câu hỏi</label>
            <input type="text" name="question" class="form-control" value="{{ old('question', $faq->question) }}" required>
            @error('question') <div class="text-danger mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Trả lời</label>
            <textarea name="answer" id="editor" rows="6" class="form-control" required>{!! old('answer', $faq->answer) !!}</textarea>
            @error('answer') <div class="text-danger mt-1">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('faqs.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
      CKEDITOR.replace('editor', {
        height: 400,
        removeButtons: '',
        allowedContent: true,   // giữ nguyên HTML bạn nhập
        entities: false,        // không encode ký tự tiếng Việt thành entity
        basicEntities: false,
        fillEmptyBlocks: false, // không tự thêm &nbsp;
        autoParagraph: false,   // không tự wrap nội dung thành <p>
        ignoreEmptyParagraph: true, // bỏ qua <p>&nbsp;</p>
        enterMode: CKEDITOR.ENTER_BR, // Enter xuống <br>
        shiftEnterMode: CKEDITOR.ENTER_P, // Shift+Enter mới xuống <p>
        // loại bỏ entity nbsp
        on: {
            instanceReady: function (ev) {
                this.dataProcessor.writer.setRules('p', {
                    indent: false,
                    breakBeforeOpen: false,
                    breakAfterOpen: false,
                    breakBeforeClose: false,
                    breakAfterClose: false
                });
            }
        }
    });
</script>
@endsection
