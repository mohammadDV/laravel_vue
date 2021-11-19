<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return view("post");
    }

    public function getComments()
    {
        $comments = Comment::where("parent_id",0)->orderby("id","DESC")->with([
            'sub_comments' => function ($parent) {
                return $parent->with([
                    'sub_comments' => function ($su_parent) {
                        return $su_parent;
                    }
                ]);
            }
        ])->get();
        return response()->json($comments);
    }
}
