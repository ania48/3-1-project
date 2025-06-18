<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Add Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #2ecc71;
            --background-color: #f8f9fa;
            --text-color: #2c3e50;
            --border-color: #e9ecef;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.4rem;
        }

        .nav-link {
            position: relative;
            transition: all 0.3s ease;
            padding: 0.8rem 1.5rem !important;
            margin: 0 0.5rem;
        }

        .nav-link:hover {
            color: #fff !important;
            transform: translateY(-2px);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #fff;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .navbar-nav {
            gap: 1rem;
        }

        .form-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }

        .form-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background-color: var(--secondary-color);
            border-radius: 2px;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        textarea.form-control {
            min-height: 200px;
            resize: vertical;
        }

        .custom-file-upload {
            border: 2px dashed var(--border-color);
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
            position: relative;
            overflow: hidden;
            max-width: 500px;
            margin: 0 auto;
        }

        .custom-file-upload:hover {
            border-color: var(--secondary-color);
            background-color: #f1f8ff;
        }

        .custom-file-upload i {
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .custom-file-upload .upload-text {
            margin: 0.5rem 0;
            color: var(--text-color);
            font-size: 0.95rem;
        }

        .custom-file-upload .upload-hint {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }

        .image-preview-container {
            position: relative;
            width: 100%;
            max-width: 500px;
            height: 180px;
            margin: 1rem auto 0;
            border-radius: 8px;
            overflow: hidden;
            display: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .image-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-preview-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .image-preview-container:hover .image-preview-overlay {
            opacity: 1;
        }

        .preview-actions {
            display: flex;
            gap: 0.75rem;
        }

        .preview-action-btn {
            background: white;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .preview-action-btn:hover {
            transform: scale(1.1);
            background: var(--secondary-color);
            color: white;
        }

        .upload-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--border-color);
            display: none;
        }

        .upload-progress-bar {
            height: 100%;
            background: var(--success-color);
            width: 0;
            transition: width 0.3s ease;
        }

        .drag-over {
            border-color: var(--success-color);
            background-color: #e8f5e9;
        }

        .upload-section {
            margin-bottom: 1.5rem;
        }

        .btn-submit {
            background-color: var(--primary-color);
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 6px;
            border: 2px solid var(--primary-color);
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-submit:hover {
            background-color: transparent;
            color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-submit:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-submit i {
            font-size: 1rem;
            transition: transform 0.3s ease;
        }

        .btn-submit:hover i {
            transform: translateX(3px);
        }

        .btn-submit-container {
            text-align: right;
            margin-top: 2rem;
        }

        .toast-container {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 9999;
        }

        footer {
            margin-top: 50px;
            padding: 20px 0;
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .form-container {
                margin: 1rem;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php?controller=dashboard&action=index">
                <i class="fas fa-pen-fancy me-2"></i>Add New Article
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=dashboard&action=index">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?controller=article&action=add">
                            <i class="fas fa-plus-circle me-1"></i>Add Article
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=rss&action=index" target="_blank">
                            <i class="fas fa-rss me-1"></i>RSS Feed
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=auth&action=logout">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="form-container">
            <h2 class="form-title">Submit a New Article</h2>
            <form action="index.php?controller=article&action=store" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="title" class="form-label">
                        <i class="fas fa-heading me-2"></i>Article Title
                    </label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter your article title" required />
                </div>

                <div class="mb-4">
                    <label for="body" class="form-label">
                        <i class="fas fa-align-left me-2"></i>Content
                    </label>
                    <textarea class="form-control" id="body" name="body" placeholder="Write your article content here..." required></textarea>
                </div>

                <div class="mb-4">
                    <label for="keywords" class="form-label">
                        <i class="fas fa-tags me-2"></i>Keywords
                    </label>
                    <input type="text" class="form-control" id="keywords" name="keywords" placeholder="Enter keywords separated by commas" />
                    <small class="text-muted">Example: technology, news, science</small>
                </div>

                <div class="mb-4 upload-section">
                    <label class="form-label">
                        <i class="fas fa-image me-2"></i>Thumbnail Image
                    </label>
                    <label for="image" class="custom-file-upload" id="dropZone">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <div class="upload-text">Drop your image here or click to browse</div>
                        <div class="upload-hint">JPG, PNG, GIF (Max: 5MB)</div>
                        <div class="upload-progress">
                            <div class="upload-progress-bar"></div>
                        </div>
                    </label>
                    <input type="file" class="d-none" id="image" name="image" accept="image/*" />
                    <div class="image-preview-container" id="previewContainer">
                        <img src="" alt="Preview" class="image-preview" id="imagePreview">
                        <div class="image-preview-overlay">
                            <div class="preview-actions">
                                <button type="button" class="preview-action-btn" id="rotateLeft" title="Rotate Left">
                                    <i class="fas fa-undo"></i>
                                </button>
                                <button type="button" class="preview-action-btn" id="rotateRight" title="Rotate Right">
                                    <i class="fas fa-redo"></i>
                                </button>
                                <button type="button" class="preview-action-btn" id="removeImage" title="Remove Image">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-submit-container">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i>
                        Submit Article
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php if (!empty($success)): ?>
        <div class="toast-container">
            <div class="toast align-items-center text-bg-success border-0 show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-check-circle me-2"></i>Article submitted successfully as pending!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <footer class="text-center">
        <div class="container">
            <p class="mb-0">
                <i class="fas fa-copyright me-1"></i>All rights reserved by CDU @2025
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show selected filename and preview for file input
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('image');
        const previewContainer = document.getElementById('previewContainer');
        const imagePreview = document.getElementById('imagePreview');
        const uploadText = document.querySelector('.upload-text');
        const uploadProgress = document.querySelector('.upload-progress');
        const uploadProgressBar = document.querySelector('.upload-progress-bar');
        let rotation = 0;

        // Handle file selection
        fileInput.addEventListener('change', handleFileSelect);

        // Handle drag and drop events
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            dropZone.classList.add('drag-over');
        }

        function unhighlight(e) {
            dropZone.classList.remove('drag-over');
        }

        dropZone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
            handleFileSelect({ target: fileInput });
        }

        function handleFileSelect(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size exceeds 5MB limit');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    previewContainer.style.display = 'block';
                    uploadText.textContent = `Selected: ${file.name}`;
                    uploadProgress.style.display = 'block';
                    
                    // Simulate upload progress
                    let progress = 0;
                    const interval = setInterval(() => {
                        progress += 5;
                        uploadProgressBar.style.width = `${progress}%`;
                        if (progress >= 100) {
                            clearInterval(interval);
                            setTimeout(() => {
                                uploadProgress.style.display = 'none';
                                uploadProgressBar.style.width = '0';
                            }, 500);
                        }
                    }, 100);
                }
                reader.readAsDataURL(file);
            }
        }

        document.getElementById('rotateLeft').addEventListener('click', () => rotateImage(-90));
        document.getElementById('rotateRight').addEventListener('click', () => rotateImage(90));

        function rotateImage(degrees) {
            rotation = (rotation + degrees) % 360;
            imagePreview.style.transform = `rotate(${rotation}deg)`;
        }

        document.getElementById('removeImage').addEventListener('click', () => {
            fileInput.value = '';
            previewContainer.style.display = 'none';
            uploadText.textContent = 'Drag and drop your image here or click to browse';
            rotation = 0;
            imagePreview.style.transform = 'rotate(0deg)';
        });
    </script>
</body>
</html>
