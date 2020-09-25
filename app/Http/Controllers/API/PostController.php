<?php

namespace App\Http\Controllers\API;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->postInterface->savePost($request);
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
        if ($isUpdate) {
            return response()->json(['status' => 'success', 'message' => 'Successfully Update']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Error occur while Updating']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return void
     */
    public function destroy(Request $request, $id)
    {
        $this->postInterface->deletePost($request->id, $id);
    }
    /**
     * Search Post 
     *
     * @param  \Illuminate\Http\Request 
     * @return  \Illuminate\Http\Response
     */
    public function searchPost(Request $request)
    {
        $posts = $this->postInterface->getUserPost(0, 19, $request->q);
        return response()->json($posts);
    }
    /**
     * import post with csv file
     *
     * @param  \Illuminate\Http\Request 
     * @return  \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $isUpload = $this->postInterface->savePostWithCSV($request->file('csvfile'));
        return response()->json(["status" => $isUpload]);
    }
    /**
     * export post with excel file
     *
     * not use
     * 
     * @param  \Illuminate\Http\Request 
     * @return  \Illuminate\Http\Response
     */
    public function export()
    {
        return $this->postInterface->downloadPost();
    }
}
