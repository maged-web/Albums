<!DOCTYPE html>
<html>
<head>
    <title>Create Pictures</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/create-picture.css') }}">

</head>
<body>
    <h1>Create Picture</h1>
    <form action="{{ route('pictures.store', $album->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="pictures">Pictures:</label>
        <input type="file" name="pictures[]" id="pictures" multiple>
        <button type="submit">Add Picture</button>
        <a href="{{ route('albums.index') }}">Cancel</a>

    </form>

</body>
</html>
