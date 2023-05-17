<!DOCTYPE html>
<html>
<head>
    <title>Upload LaTeX File</title>
</head>
<body>
    <h1>Upload LaTeX File</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('processUpload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="latexFile">
        <button type="submit">Upload</button>
    </form>
    <form action="{{ route('processImages') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="imageFile[]" multiple accept="image/*">
        <button type="submit">Upload Image</button>
    </form>
</body>
</html>
