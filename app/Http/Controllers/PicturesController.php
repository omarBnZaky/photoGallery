<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Picture;
use App\Album;

use Illuminate\Http\Request;

class PicturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $pictures = Picture::where('title', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('photo', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $pictures = Picture::latest()->paginate($perPage);
        }

        return view('albums.pictures.index', compact('pictures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $albums =  Album::all();

        return view('albums.pictures.create',compact('albums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'album_id'=> 'required'
        ]);

         $picture = new Picture;
         $picture->title =  $request->input('title');
         $picture->description =  $request->input('description');

         $picture->album_id =  $request->input('album_id');

   
         $photo = $request->file('photo');

         $extension = $photo->getClientOriginalExtension(); 

         $picName = time().'.'.$extension;

         $path = public_path().'/uploads/photos';

         $photo->move($path,$picName);

         $picture->photo  = $picName;
         $picture->save();

        return redirect('albums/pictures')->with('flash_message', 'Picture added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {

        $picture = Picture::findOrFail($id);

        return view('albums.pictures.show', compact('picture'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $picture = Picture::findOrFail($id);
        $albums =  Album::all();

        return view('albums.pictures.edit', compact('picture','albums'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
            'album_id'=> 'required'
        ]);
        
        
        $picture = Picture::findOrFail($id);
        $picture->title =  $request->input('title');
        $picture->description =  $request->input('description');

        $picture->album_id =  $request->input('album_id');


        if($request->hasFile('photo')){

                $photo = $request->file('photo');

                $extension = $photo->getClientOriginalExtension(); 

                $picName = time().'.'.$extension;

                $path = public_path().'/uploads/photos';

                $photo->move($path,$picName);

                $picture->photo  = $picName;
        }


        $picture->save();


        $picture->save();

        return redirect('albums/pictures')->with('flash_message', 'Picture updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $picture = Picture::findOrFail($id);

        $picPath = public_path().'/uploads/photos/'.$picture->photo;//the path
        unlink($picPath);
        $picture->delete();

        return redirect('albums/pictures')->with('flash_message', 'Picture deleted!');
    }
}
