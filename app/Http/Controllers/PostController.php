<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Post\PostServiceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

/**
 * SystemName : Bulletinboard
 * ModuleName : Post
 */
class PostController extends Controller
{
    /**
     * The post service interface instance.
     */
    private $postInterface;

    /**
     * Create a new controller instance.
     *
     * @param  PostServiceInterface  $postInterface
     * @return void
     */
    public function __construct(PostServiceInterface $postInterface)
    {
        $this->postInterface = $postInterface;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postLists = $this->postInterface->getPostLists();
        return view('posts.posts', [
            "posts" => $postLists
        ]);
    }
    /**
     * Show Post List as Json Format for Vue
     * 
     * @return array
     */

    public function addPost(Request $request)
    {
        dd($request);
    }

    public function showPost()
    {
        $posts = Post::all()->toArray();
        return array_reverse($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.post_create');
    }

    /**
     * Show creating form for creating a new post.
     *
     * @param App\Http\Requests\PostRequest $request;
     * @return \Illuminate\Http\Response
     */
    public function confirm(PostRequest $request)
    {
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        return view('posts.post_confirm', compact('data'));
    }

    /**
     * Show conifrmation form to  update
     * 
     * @param App\Http\Requests\PostRequest $request;
     * @param int $id 
     * @return  \Illuminate\Http\Response
     */
    public function update_confirm(PostRequest $request, $id)
    {
        $data['id'] = $id;
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        if ($request->status) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        return view('posts.post_update_confirm', compact('data'));
    }

    /**
     * Searching  Post
     * 
     * @param App\Http\Requests\PostRequest $request;
     * @return \Illuminate\Http\Response
     * 
     */
    public function search(Request $request)
    {
        if (empty($request->q)) {
            return redirect('/')->withInput()->with("error", "please enter search keyword");
        }
        $posts = $this->postInterface->getUserPost(Auth::user()->type, Auth::id(), $request->q);
        if ($posts->count() == 0) {
            return redirect()->back()->with('error', 'Sorry, Post Not Found')->withInput();
        }
        $data['q'] = $request->q;
        return view('posts.posts', compact('posts', 'data'));
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->cancel) {
            return redirect('/posts/create')->withInput();
        }
        $isSave = $this->postInterface->savePost($request);
        if (!$isSave) {
            return redirect('/posts/create')->withInput()->with('error', 'Error occur Creating Post');
            //return redirect('/posts/create')->with('error', 'Error occur Creating Post');
        }
        return redirect('/')->with('message', 'Post Create Successfully');
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $post = $this->postInterface->editPost($id);
        $data['id'] = $id;
        $data['title'] = $post->title;
        $data['description'] = $post->description;
        $data['status'] = $post->status;
        return view('posts.post_edit', compact('data'));
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->cancel) {
            return redirect('/posts/edit/' . $id)->withInput();
        }
        $isUpdate = $this->postInterface->updatePost($request, $id);
        if (!$isUpdate) {
            return redirect('/')->with('error', 'Error while Updating ');
        }
        return redirect('/')->with('message', 'Successfully Update ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->postInterface->deletePost(Auth::id(), $request->post_id);
        return redirect('/')->with('message', 'Delete Successfully');
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload()
    {
        return view('posts.upload_csv');
    }

    /**
     *Download Post with xlsx extension
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        return $this->postInterface->downloadPost();
    }

    /**
     *Upload Post with CSV
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function uploadCSV(Request $request)
    {
        $isUpload = $this->postInterface->savePostWithCSV($request->file('csvfile'));
        if (!$isUpload) {
            return redirect('/')->with('error', 'Error occur when import csv data');
        }
        return redirect('/')->with('message', 'Post Create Successfully');
    }

    /**
     *Create Post with vue
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function submit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required',
        ]);

        /*
          Add mail functionality here.
        */

        return response()->json(null, 200);
    }
}
