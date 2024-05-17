<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
{
     public function create($albumId)
     {
         $album = Album::findOrFail($albumId);
         return view('pictures.create', compact('album'));
     }
 
     public function store(Request $request, $albumId)
     {
         $request->validate([
             'pictures.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
         ]);
 
         $album = Album::findOrFail($albumId);
 
         if ($request->hasFile('pictures')) {
             foreach ($request->file('pictures') as $file) {
                 $path = $file->store('pictures', 'public');
                 Picture::create([
                     'album_id' => $album->id,
                     'name' => $file->getClientOriginalName(),
                     'path' => $path
                 ]);
             }
         }
 
         return redirect()->route('albums.index')->with('success', 'Pictures uploaded successfully.');
     }
}
