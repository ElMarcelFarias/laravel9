<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCommentRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $comment;
    protected $user;

    public function __construct(Comment $comment, User $user){
        $this->comment = $comment;
        $this->user = $user;
    }

    public function index(Request $request, $userId) {

        if(!$user = $this->user->find($userId)) {
            return redirect()->back();
        }

        //dd($request->search);

        $comments = $user->comments()
                            ->where('body', 'LIKE', "%{$request->search}%")
                            ->get();

        return view('users.comments.index', compact('user', 'comments'));
    }

    public function create($userId) {
        if(!$user = $this->user->find($userId)) {
            return redirect()->back();
        }

        return view('users.comments.create', compact('user'));
    }

    public function store(StoreUpdateCommentRequest $request, $userId) {
        if(!$user = $this->user->find($userId)) {
            return redirect()->back();
        }

        //dd($request->all());

        $user->comments()->create([
            'body' => $request->body,
            'visible' => isset($request->visible)
        ]);
        // $this->comment->create([
        //     'user_id'
        // ])

        return redirect()->route('comments.index', $user->id);

    }

    public function edit($userId, $commentsId) {
        if(!$comment = $this->comment->find($commentsId)) {
            return redirect()->back();
        }

        $user = $comment->user; //relacionamento 1 - one

        return view('users.comments.edit', compact('user', 'comment'));
    }

    public function update(StoreUpdateCommentRequest $request, $commentsId) {
        if(!$comment = $this->comment->find($commentsId)) {
            return redirect()->back();
        }

        //dd($request->all());

        $comment->update([
            'body' => $request->body,
            'visible' => isset($request->visible)
        ]);
        // $this->comment->create([
        //     'user_id'
        // ])

        return redirect()->route('comments.index', $comment->user_id);

    }


}
