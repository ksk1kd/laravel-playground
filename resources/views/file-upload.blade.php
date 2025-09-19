<h1>File Upload</h1>

@if(session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div>
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/file-upload" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="file">Select a file:</label>
        <input type="file" name="file" id="file" required>
    </div>

    <div>
        <button type="submit">Upload</button>
    </div>
</form>