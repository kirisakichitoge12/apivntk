@extends('layouts.admin')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Venue - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
            --border-color: #dee2e6;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        body {
            background-color: #f5f7f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .admin-container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 15px;
        }
        
        .admin-card {
            background: white;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }
        
        .admin-title {
            color: var(--secondary-color);
            font-weight: 600;
            margin: 0;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 0.75rem;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            transform: translateY(-2px);
        }
        .cke_notification.cke_notification_warning {
            display: none !important;
        }
            
        .ck-editor {
            border-radius: 6px;
            overflow: hidden;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .btn-cancel {
            background-color: #95a5a6;
            border-color: #95a5a6;
            color: white;
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.3s;
        }
        
        .btn-cancel:hover {
            background-color: #7f8c8d;
            border-color: #7f8c8d;
            color: white;
        }
        
        .character-count {
            font-size: 0.85rem;
            color: #6c757d;
            text-align: right;
            margin-top: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .admin-container {
                margin: 1rem auto;
            }
            
            .admin-card {
                padding: 1.5rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-card">
            <div class="admin-header">
                <h1 class="admin-title">Thêm Địa Điểm Mới</h1>
                <a href="#" class="btn btn-cancel">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại
                </a>
            </div>
            
            <form action="{{ route('venoidia.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Nhập tiêu đề địa điểm" required>
                    <div class="character-count">
                        <span id="title-count">0</span>/120 ký tự
                    </div>
                </div>

                <div class="mb-4">
                    <label for="editor" class="form-label">Mô tả nội dung <span class="text-danger">*</span></label>
                    <textarea id="editor" name="description" class="form-control" rows="10" placeholder="Nhập mô tả chi tiết về địa điểm"></textarea>
                </div>

                <div class="action-buttons">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Lưu địa điểm
                    </button>
                    <button type="reset" class="btn btn-cancel">
                        <i class="fas fa-times me-2"></i>Nhập lại
                    </button>
                </div>
            </form>
        </div>
    </div>

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

    // Character count for title
    const titleInput = document.getElementById('title');
    const titleCount = document.getElementById('title-count');

    titleInput.addEventListener('input', function() {
        titleCount.textContent = this.value.length;
        
        if (this.value.length > 120) {
            titleCount.classList.add('text-danger');
        } else {
            titleCount.classList.remove('text-danger');
        }
    });
</script>

</body>
</html>

@endsection