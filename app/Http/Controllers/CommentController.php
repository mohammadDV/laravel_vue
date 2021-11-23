<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    public function index()
    {
        return view("post");
    }

    public function getComments()
    {
        $comments = $this->getCommentData();
        return response()->json($comments);
    }

    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create([
            'name'      => $request->input('name'),
            'message'   => trim(stripslashes($request->input('message'))),
            'parent_id' => $request->input('parent_id'),
        ]);
        $status     = 0;
        $comments   = [];
        if ($comment){
            $status = 1;
            $comments = $this->getCommentData();
        }
        return response()->json([
            'status'    => $status,
            'comments'  => $comments
        ]);
    }

    private function getCommentData(){
        return Comment::where("parent_id",0)->orderby("id","DESC")->with([
            'sub_comments' => function ($parent) {
                return $parent->with([
                    'sub_comments' => function ($su_parent) {
                        return $su_parent;
                    }
                ]);
            }
        ])->get();
    }
}
