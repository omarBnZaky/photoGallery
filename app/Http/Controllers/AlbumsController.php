<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Album;
use Illuminate\Http\Request;

class AlbumsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
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
            $albums = Album::where('name', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $albums = Album::latest()->paginate($perPage);
        }

        return view('albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('albums.create');
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
            'name' => 'required',
            'description' => 'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

         $album = new Album;
         $album->name =  $request->input('name');
         $album->description =  $request->input('description');

    
         
         $cover = $request->file('cover_image');

         $extension = $cover->getClientOriginalExtension(); 

         $coverName = time().'.'.$extension;

         $path = public_path().'/uploads/albums';

         $cover->move($path,$coverName);

         $album->cover_image  = $coverName;
         $album->save();
                        
 //        $album
   //     $requestData = $request->all();
        
      //      Album::create($requestData);

        return redirect('/albums')->with('flash_message', 'Album added!');
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
        $album = Album::findOrFail($id);

        return view('albums.show', compact('album'));
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
        $album = Album::findOrFail($id);

        return view('albums.edit', compact('album'));
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
            'name' => 'required',
            'description' => 'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        
        $album = Album::findOrFail($id);

        $album->name =  $request->input('name');
        $album->description =  $request->input('description');

   
        if($request->hasFile('cover_image')){
                         
                $cover = $request->file('cover_image');

                $extension = $cover->getClientOriginalExtension(); 

                $coverName = time().'.'.$extension;

                $path = public_path().'/uploads/albums';

                $cover->move($path,$coverName);

                $album->cover_image  = $coverName;
        }

        $album->save();

        return redirect('albums')->with('flash_message', 'Album updated!');
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
        $album = Album::findOrFail($id);
        $albumPath = public_path().'/uploads/albums/'.$album->cover_image;//the path

        foreach($album->pictures as $pic){
            $picPath = public_path().'/uploads/photos/'.$pic->photo;//the path
            unlink($picPath);

        }

        unlink($albumPath);
        $album->delete();

        return redirect('albums')->with('flash_message', 'Album deleted!');
    }
}
