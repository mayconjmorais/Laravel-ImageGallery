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
        $images=$this->objImagem->all();

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

        if($image){
            $imageName=$image->getClientOriginalName();
            $image->move('images', $imageName);
        }

        if(!$request->hidden){
            $hide = 'on';
        }else{
            $hide = 'off';
        }

        $img=$this->objImagem->create([
            'title'=>"images/".$imageName,
            'owner'=>$request->owner,
            'hidden'=>$hide,
        ]);

        if($img){
            return redirect('/home');
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
