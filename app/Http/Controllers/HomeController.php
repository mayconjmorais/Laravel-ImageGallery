<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Gallery;

class HomeController extends Controller
{   
    private $user;
    private $objImagem;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->user=new User();
        $this->objImagem=new Gallery();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        // dd($img);
        $images=$this->objImagem->all();
        $user=$this->user->find( Auth::user()->id );
        //dd($user);
        return view('home', compact('user', 'images'));
    }   

    public function delete($id)
    {
        // dd($id);
        $image = Gallery::find($id);
        $image->delete();

        $image_path = $image->title;
        // dd($image_path);
        // Before do it should validate if it was delete from database
        if(file_exists($image_path)){
            unlink($image_path); 
        }
        
        return redirect('/home')->with('image',$image);
    }

    public function hidden($id)
    {
         
        $image = Gallery::find($id);
        if($image->hidden === 'on'){
            $hidden = 'off';
        } else{
            $hidden = 'on';
        }
        // dd($hidden);
        
        $this->objImagem->where(['id'=>$id])->update([
            'hidden'=>$hidden,
        ]);

        return redirect('/home')->with('image',$image);
    }
}
