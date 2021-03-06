<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use App\Http\Controller\SendMailController;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::orderby('title','desc')->get();
        $posts = Post::orderby('created_at','desc')->paginate(5);
        
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);

        //Handle file upload
        if($request->hasFile('cover_image')) {

            //Get filename with extension
            $filenameWithExt =  $request->file('cover_image')->getClientOriginalName();

            //Get just the filename
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);

            // Get extension
            $extension =  $request->file('cover_image')->getClientOriginalExtension();

            //Create new filename
            $filenameToStore = $filename.'_'.time().'.'.$extension;

            //Upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$filenameToStore);

        } else {
            $filenameToStore = "noimage.jpg";
        }

        //Create post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $filenameToStore;

        $post->save();

        //Send mail about adding new post on the website
        //SendMailController::send();

        //return redirect('/posts')->with('success','Post was created');
        return redirect('posts')->with('success','Post was created');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        //Check for correct user
        if(auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error','Unauthorized page');
        }

        return view('posts.edit')->with('post',$post);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);

        //Handle file upload
        if($request->hasFile('cover_image')) {

            //Get filename with extension
            $filenameWithExt =  $request->file('cover_image')->getClientOriginalName();

            //Get just the filename
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);

        
            // Get extension
            $extension =  $request->file('cover_image')->getClientOriginalExtension();

            //Create new filename
            $filenameToStore = $filename.'_'.time().'.'.$extension;

            //Upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$filenameToStore);
        } 

        //Update post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');

          //Handle file upload
        if($request->hasFile('cover_image')) {
            $post->cover_image = $filenameToStore;
        }

        $post->save();

        return redirect('posts')->with('success','Post was updated');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        
        //Check for correct user
        if(auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error','Unauthorized page');
        }

        if($post->cover_image != 'noimage.jpg') {
            //Delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('posts')->with('success','Post was deleted');
    }
}
