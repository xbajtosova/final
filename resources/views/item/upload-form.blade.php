
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
    @if (Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{{ Session::get('success') }}</li>
            </ul>
        </div>

    @endif
    <form action="{{ route('processUpload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input class="form-control" type="file" name="latexFile">
        <button class="btn btn-primary mt-1 mb-3" type="submit">{{__('Upload')}}</button>
    </form>
    <form action="{{ route('processImages') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input class="form-control" type="file" name="imageFile[]" multiple accept="image/*">
        <button class="btn btn-primary mt-1" type="submit">{{__('Upload Image')}}</button>
    </form>

