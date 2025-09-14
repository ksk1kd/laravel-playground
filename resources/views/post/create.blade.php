<h1>Create Post</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/posts">
    @csrf
    <div>
        <label for="title">Title</label>
        <input id="title" type="text" name="title" value="{{ old('title') }}">
    </div>
    <div>
        <label for="body">Body</label>
        <textarea id="body" name="body">{{ old('body') }}</textarea>
    </div>
    <div>
        <input type="submit" value="Create">
    </div>
</form>
