<!DOCTYPE html>
<html>
<head>
    <title>Edit Album</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/edit-album.css') }}">
</head>
<body>
    <h1>Edit Album</h1>
    <form action="{{ route('albums.update', $album->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="name">Album Name:</label>
        <input type="text" name="name" id="name" value="{{ $album->name }}" required>
        <button type="submit">Update Album</button>
        <a href="{{ route('albums.index') }}">Cancel</a>
    </form>
</body>
</html>
