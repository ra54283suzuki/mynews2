<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 以下を追記することでProfile Modelが扱えるようになる
use App\Profile;
use App\ProfileHistory;
use Carbon\Carbon;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
        // Varidationを行う
        $this->Validate($request, Profile::$rules);
        
        $profile = new Profile;
        $form = $request->all();
        
        
        // データベースに保存する
        $profile->fill($form);
        $profile->save();
        
        // admin/profile/createにリダイレクトする
        return redirect('admin/profile/create');
    }
    
    public function index(Request $request)
    {
        $cond_name = $request->cond_name;
        if ($cond_name != '') {
            // 検索されたら検索結果を取得する
            $posts = Profile::where('name', $cond_name)->get();
        } else {
            // それ以外は全てのニュースを取得する
            $posts = Profile::all();
        }
        return view('admin.profile.index', ['posts' => $posts, 'cond_name' => $cond_name]);
    }

    public function edit(Request $request)
    {
        // Profile Modelからデータを取得する
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }

    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Profile::$rules);
        
        // Profile Modelからデータを取得する
        $profile = Profile::find($request->id);
        
        // 送信されてきたフォームデータを格納する
        $profile_form = $request->all();
        unset($profile_form['_token']);
        
        $history = new ProfileHistory;
        $history->profile_id = $profile->id;
        $history->edited_at = Carbon::now();
        $history->save();
        
        // 該当するデータを上書きして保存する
        $profile->fill($profile_form)->save();
        return redirect('admin/profile');
    }
    
     public function delete(Request $request)
    {
        // 該当するProfile Modelを取得
        $profile = Profile::find($request->id);
        // 削除
        $profile->delete();
        return redirect('admin/profile/');
    }
    
}
