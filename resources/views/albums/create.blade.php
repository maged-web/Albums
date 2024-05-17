<!DOCTYPE html>
<html>
<head>
    <title>Create Album</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/create-album.css') }}">
</head>
<body>
    <h1>Create Album</h1>
    <form action="{{ route('albums.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Album Name:</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">Create Album</button>
    </form>
</body>
</html>
