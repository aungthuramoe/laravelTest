<?php

namespace App\Http\Controllers\API;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Imports\PostImport;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

class PostController extends Controller
{
    protected $postInterface;

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
        $posts = $this->postInterface->getPostLists();
        return response()->json($posts);
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
        //Log::info($request->description);
        $this->postInterface->savePost($request);
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
    public function edit($id)
    {
        //
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
        $isUpdate = $this->postInterface->updatePost($request, $id);
        if($isUpdate) {
            return response()->json(['status'=>'success','message'=>'Successfully Update']);
        }else{
            return response()->json(['status'=>'error','message'=>'Error occur while Updating']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->postInterface->deletePost(19, $id);
    }
    public function searchPost(Request $request)
    {
        $posts = $this->postInterface->getUserPost(0, 19, $request->q);
        return response()->json($posts);
    }

    public function import(Request $request)
    {
        Log::info("import");
        Log::info($request);
        $isUpload = $this->postInterface->savePostWithCSV($request->file('csvfile'));
        return response()->json(["status" => $isUpload,"message" => "my message"]);
    }
}
