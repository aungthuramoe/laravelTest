<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Exports\PostImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;

class PostsController extends Controller
{
    private $postInterface;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostServiceInterface $postInterface)
    {
        $this->postInterface = $postInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        // return view('posts.posts', [
        //     "posts" => $posts
        // ]);
        $posts = $this->postInterface->getPostList();
        return view('posts.posts', [
            "posts" => $posts
        ]);
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

    public function confirm(PostRequest $request)
    {
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        return view('posts.post_confirm', compact('data'));
    }

    public function update_confirm(PostRequest $request)
    {
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        return view('posts.post_confirm', compact('data'));
    }

    public function userPost()
    {

        $posts = Post::where('create_user_id', '=', auth()->user()->id)->paginate(5);
        return view('posts.user_post', [
            "posts" => $posts
        ]);
        // $posts = $this->postInterface->userPost(auth()->user()->id);

        // return view('posts.user_post', [
        //     "posts" => $posts
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        switch ($request->input('status')) {
            case 'create':
                $title = $request->title;
                $description = $request->description;
                $post = new Post;
                $post->title = $title;
                $post->description = $description;
                $post->create_user_id = auth()->user()->id;
                $post->updated_user_id = auth()->user()->id;
                $post->save();
                return redirect('/posts')->with('create', 'Post Create Successfully');
                break;
            case 'cancel':
                return redirect('/posts/create')->withInput();
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        $post = Post::find($id);
        $data['title'] = $post->title;
        $data['description'] = $post->description;
        $data['status'] = $post->status;
        return view('posts.post_edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $post_id = $request->post_id;
        $post = Post::find($post_id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->status = 1;
        $post->update();

        return redirect('/posts')->with('update', 'Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $post_id = $request->post_id;
        $post = Post::find($post_id);
        $post->delete();
        return redirect('/posts')->with('delete', 'Delete Successfully');
    }
    public function upload()
    {
        return view('posts.upload_csv');
    }
    public function export()
    {
        return Excel::download(new PostImport, 'posts.xlsx');
    }
    public function csvfileupload(Request $request)
    {
        if ($request->hasFile('csvfile')) {
            $path = $request->file('csvfile')->getRealPath();
            //  $data = Excel::import($path)->get();
            $data = Excel::import(new PostImport, $request->file('csvfile'));
            foreach ($data as $key => $value) {
                $arr[] = [
                    'title' => $value->title,
                    'description' => $value->address,
                    'create_user_id' => $value->create_user_id,
                ];
            }
            if (!empty($arr)) {
                // DB::table('template')->insert($arr);

                return dd($arr);
            }
            return dd($data);
        }
    }
}
