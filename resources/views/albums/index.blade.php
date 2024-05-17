<!DOCTYPE html>
<html>
<head>
    <title>Albums</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/index.css') }}">
</head>
<body>
    <form action="{{ route('logout') }}" class="logout" method="POST">
        @csrf
        <button type="submit">Log out</button>
    </form>
    <h1>Albums</h1>
    <a href="{{ route('albums.create') }}" class="button">Create Album</a>
    <ul>
        @foreach($albums as $album)
            <li class="album">
                <h2>{{ $album->name }}</h2>
                <ul>
                    @foreach($album->pictures as $picture)
                        <li>{{ $picture->name }} <img src="{{ Storage::url($picture->path) }}" width="100"></li>
                    @endforeach
                </ul>
                <a href="{{ route('pictures.create', $album->id) }}" class="button">Add Image</a>
                <a href="{{ route('albums.edit', $album->id) }}" class="button">Edit Name</a>

                <form action="{{ route('albums.destroy', $album->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete Album</button>
                </form>
            </li>
        @endforeach
    </ul>

</body>
</html>
