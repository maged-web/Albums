<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('pictures')->get();
        return view('albums.index', compact('albums'));
    }


    public function create()
    {
        return view('albums.create');
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Album::create(['name' => $request->name]);

        return redirect()->route('albums.index')->with('success', 'Album created successfully.');
    }
    public function edit($id)
    {
        $album = Album::findOrFail($id);
        return view('albums.edit', compact('album'));
    }
   
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $album = Album::findOrFail($id);
        $album->update(['name' => $request->name]);

        return redirect()->route('albums.index')->with('success', 'Album updated successfully.');
    }

    public function destroy($id)
    {
        $album = Album::findOrFail($id);
        if ($album->pictures()->count() > 0) {
            return view('albums.confirm-delete', compact('album'));
        }

        $album->delete();
        return redirect()->route('albums.index')->with('success', 'Album deleted successfully.');
    }
    public function destroyWithPictures($id)
    {
        $album = Album::findOrFail($id);
        $album->pictures()->delete();
        $album->delete();

        return redirect()->route('albums.index')->with('success', 'Album and its pictures deleted successfully.');
    }

    public function movePictures($id)
    {
        $album = Album::findOrFail($id);
        $otherAlbums = Album::where('id', '!=', $id)->get();

        return view('albums.move-pictures', compact('album', 'otherAlbums'));
    }

    public function confirmMovePictures(Request $request, $id)
    {
        $album = Album::findOrFail($id);
        $destinationAlbum = Album::findOrFail($request->input('destination_album'));

        $album->pictures()->update(['album_id' => $destinationAlbum->id]);
        $album->delete();

        return redirect()->route('albums.index')->with('success', 'Pictures moved and album deleted successfully.');
    }
}
