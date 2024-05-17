<!DOCTYPE html>
<html>
<head>
    <title>Confirm Delete</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/confirm-delete.css') }}">
</head>
<body>
    <h1>Confirm Delete Album</h1>
    <p>Are you sure you want to delete the album "{{ $album->name }}"?</p>
    <form action="{{ route('albums.destroy.with-pictures', $album->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Album</button>
    </form>
    <div>
        <a href="{{ route('albums.move', $album->id) }}">Move pictures</a>
        <a href="{{ route('albums.index') }}">Cancel</a>
    </div>
</body>
</html>
