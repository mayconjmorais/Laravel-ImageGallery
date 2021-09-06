<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    private $objImagem;

    public function __construct(){
        $this->objImagem=new Gallery();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // bring us all images
        $images=$this->objImagem->all();
        // redirect to index send all images
        return view('index')->with([
            'images'=> $images, 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //  dd($request->all());
        $image=$request->image;

        // upload image - need to inform enctype="multipart/form-data" in the form (home line 20)
        if($image){
            $imageName=$image->getClientOriginalName();
            $image->move('images', $imageName);
        }
        // set the value to hidden field
        if(!$request->hidden){
            $hide = 'on';
        }else{
            $hide = 'off';
        }
        // validation to check if image is in the gallery. Problem if delete by name*
        $img=$this->objImagem->create([
            // 'title'=>"images/".$imageName,
            'title'=>$imageName,
            'owner'=>$request->owner,
            'hidden'=>$hide,
        ]);
        // if success redirect
        if($img){
            return redirect('/home')->with('success', 'Picture added in the Gallery!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $img = Gallery::where('id', $id)->firstOrFail();
        return view('title')->with([
            'title' => $img,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}
