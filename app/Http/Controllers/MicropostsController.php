<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MicropostsController extends Controller
{
    public function index()
    {
        $data = [];
        if(\Auth::check()){ //認証済みの場合
            //認証済みユーザーを取得
            $user = \Auth::user();
            //ユーザー投稿の一覧を作成日時の降順で取得。
            $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
            
            
            $data = [
                'user' => $user,
                'microposts' => $microposts,
            ];
        }
        
        
        return view('welcome', $data);
    }
    
    public function store(Request $request)
    {
        //バリデーション
        $request->validate([
            'content' => 'required|max:255',
        ]);
        
        //認証済みユーザー（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->microposts()->create([
            'content' => $request->content,
        ]);
        
        
        //前のページ（URL）へリダイレクトさせる。
        return back();
    }
    
    public function destroy($id)
    {
        //idの値で投稿を検索して取得
        $microposts = \App\Micropost::findOrFail($id);
        
        //認証済みユーザー（閲覧者）がその投稿の所有者である場合は、投稿を削除。
        //ログインユーザのID === Micropostの所有者のID
        if(\Auth::id() === $microposts-user_id){
            $micropost->delete();
        }
        
        //前のページ（URL）へリダイレクトさせる。
        return back();
    }
}
