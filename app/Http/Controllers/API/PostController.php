<?php

namespace App\Http\Controllers\API;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Http\Controllers\Controller;
use App\Imports\PostImport;
use App\Models\Post;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{
    /**
     * The user service interface instance.
     */
    protected $postInterface;
    /**
     * Create a new controller instance.
     *
     * @param PostServiceInterface $userInterface
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
     * @return \Illuminate\Http\JsonResponse
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
     * 
     * @return void
     */
    public function store(Request $request)
    {
           $isSave = $this->postInterface->savePost($request);
           if($isSave){
               return response()->json(["status"=>"success","message"=>"Successfully Created"]);
            }else{
                return response()->json(["status"=>"error","message"=>"Error Occur while creating post"],409);
            }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * 
     * @return  @return \Illuminate\Http\JsonResponse
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
    public function destroy($id)
    {
        $this->postInterface->deletePost(Auth::id(), $id);
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
     * @return  $isUpload 
     */
    public function import(Request $request)
    {
        $isUpload = $this->postInterface->savePostWithCSV($request->file('csvfile'));
        return response()->json(["status" => $isUpload]);
    }
    /**
     * return posts
     * 
     *  @return \Illuminate\Http\JsonResponse
     */
    public function export()
    {
        $posts = $this->postInterface->downloadPostForVueExcel(Auth::id(), Auth::user()->type);
        return response()->json(['posts' => $posts]);
    }
}
