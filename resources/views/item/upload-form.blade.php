
    <h1>{{__('Upload LaTeX File')}}</h1>

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
        <button type="submit">{{__('Upload')}}</button>
    </form>
    <form action="{{ route('processImages') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="imageFile[]" multiple accept="image/*">
        <button type="submit">{{__('Upload Image')}}</button>
    </form>

