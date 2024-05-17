<!DOCTYPE html>
<html>
<head>
    <title>Move Pictures</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/move-pictures.css') }}">
</head>
<body>
    <h1>Move Pictures</h1>
    @if($otherAlbums->isNotEmpty())
    <p>Select an album to move pictures from "{{ $album->name }}" to:</p>

    <form action="{{ route('albums.move.confirm', $album->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="destination_album">Destination Album:</label>
        <select name="destination_album" id="destination_album">
            @foreach($otherAlbums as $otherAlbum)
                <option value="{{ $otherAlbum->id }}">{{ $otherAlbum->name }}</option>
            @endforeach
        </select>
        <button type="submit">Move Pictures</button>
        <a href="{{ route('albums.index') }}">Cancel</a>

    </form>
    @else
    <p>You must have at least one other album before you can move pictures.</p>
    <a href="{{ route('albums.index') }}">Cancel</a>
    @endif
</body>
</html>
