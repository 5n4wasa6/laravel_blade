<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Goal;
use App\User;
// use Carbon\Carbon;
// use Illuminate\Support\Facades\DB;

class GoalsController extends Controller
{
    // 登録---------------------------------------------
    public function store(Request $request) {
        // バリデーション
        $this->validate($request,[
            'goal'       => 'required| max:255',
        ]);
    
        // Eloquent モデル
        $goals = new Goal;
        $goals->user_id      = Auth::user()->id;
        $goals->company_name = $request->company_name;
        $goals->priority     = "";
        $goals->goal         = $request->goal;
        $goals->save();    
        return redirect('/comment');
    }
    // メンバー閲覧ページ表示-----------------------------------------
    public function look(Goal $alls) {
        $goal = Goal::where('id',$alls);
        return view('goalslook', ['goal' => $alls]);
    }
    // 編集画面-----------------------------------------
    public function edit(Goal $goals) {
        $goal = Goal::where('id',$goals);
        return view('goalsedit', ['goal' => $goals]);
    }
    // 編集処理-----------------------------------------
    public function update(Request $request) {
        // バリデーション
        $this->validate($request,[
            'goal'       => 'required| min:3 | max:255'
        ]);
        // 画像格納
        $file = $request->file('goal_img');
        if (!empty($file)) {
            $filename = $file->getClientOriginalName();
            $move = $file->move('./upload/',$filename);
        } else {
            $filename = "";
        }
        // Eloquent モデル
        $goals = Goal::where('id',$request->id)->first();
        // $goals->company_name = $request->company_name;
        $goals->goal         = $request->goal;
        $goals->commit_at    = $request->commit_at;
        $goals->why          = $request->why;
        $goals->how          = $request->how;
        $goals->what         = $request->what;
        // $goals->schedule     = $request->schedule;
        // $goals->nextaction   = $request->nextaction;
        $goals->goal_img     = $filename;
        $goals->save();
        return redirect('/comment');
    }
    // 削除処理-------------------------------------------
    public function destroy(Goal $goal) {
        $goal->delete();
        return redirect('/');
    }
    
    // 閲覧&コメント表示ページ
    // public function show(Goal $alls) {
    //     $goal = Goal::where('id',$alls);
    //     return view('goalsshow', ['goal' => $alls]);
    // }
    // 全記録表示
    public function all() {

        return view('goalall', [
            
        ]);
    }
}
