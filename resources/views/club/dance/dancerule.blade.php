@extends('layouts.app')
@section('content')

<!-- Bootstrap ------------------------------------>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>-->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>-->
 
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

 
<!-- Styles -->
<link href="{{ asset('css/club.css') }}" rel="stylesheet">   

@include('common.errors')
{{ csrf_field() }}

    <!--フェンシング部上部 ------------------------------------------------------------------------->
    <!--▲画像設定を管理者(部長/副部長)のみができるようにする----------->
    <img src="upload/dance_shadow.jpg" class="image_wrapper">    
        
    <h2 class="club_club">ダンス部</h2>
    <!--参加人数抽出---->
    <div>
        <h4>部員:<span> {{ $users }}</span>人</h4>
        <a href="{{ action('Club\DanceController@member') }}">
            <div class="club_member">
                    @foreach ($alls as $all)
                        <p>{{ $all->user->name }}</p> &nbsp;
                    @endforeach
                    <p>・・・</p>
            </div>
        </a>
    </div>
    <div>
        <a href="{{ action('Club\DanceController@admin') }}" class="main_sub_manager">
            <div>
                @if ( $main_manager )
                    <h4> 部長： {{ $main_manager->user->name }} </h4>
                @else
                    <h4> 部長： 未定 </h4>
                @endif
            </div>
            <div>
                @if ( $sub_manager )
                    <h4> 副部長： {{ $sub_manager->user->name }} </h4>
                @else
                    <h4> 副部長： 未定 </h4>
                @endif
            </div>
        </a>
    </div>
    <br>
    <!--navバーのような横並びで選択できるようにvue.js組み込む-->
    <div class="club_nav">
        <p><a href="{{ action('Club\DanceController@rule') }}">RULE</a></p>
        <p> | <a href="{{ action('Club\DanceController@dance') }}">DISCUSSION</a></p>
        <p> | <a href="{{ action('Club\DanceController@event') }}">EVENT</a></p>
        <p> | <a href="#">TEACHING</a></p>
    </div>
    <!--フェンシング部上部 -------------------------------------------------------------------------->
    
    
<div class="panel-body">
    
    <!--ルール表示---------------------------------------------------------------------------------------------------------->
    <div>
        <h3 class="rule_text">独自ルール</h3>
        <div class="rule_wrapper">
            @foreach ($rules as $rule)
        
                <div>
                    <!-- Rule表示 -->
                    <h4 class="original_rule">{{ $rule->rule }}</h4>
                    
                    <div class="club_edit_delete">
                        @foreach ($admins as $admin)
                            @if ( $admin->admin == 1 || 2 && $admin->club_id == 2)
                                <!-- 更新ボタン -->
                                <div>
                                    <a href="{{ action('Club\TriathlonController@rule_edit',$rule) }}">
                                        <button type="button" class="btn btn-primary">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </button>
                                    </a>
                                </div>
                                <!-- 更新ボタン END -->
                                
                                <!-- 削除ボタン -->
                                <div>
                                    <form action="{{ url('triathlon_rules/'.$rule->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger"> <i class="glyphicon glyphicon-trash"></i> </button>
                                    </form>
                                </div>
                                <!-- 削除ボタン END -->
                            @endif
                        @endforeach
                    </div>
                </div>
                
            @endforeach
        </div>
        
    </div>
    <!--ルール表示 END------------------------------------------------------------------------------------------------------>
    <br>
    <br>
    
    <!--ルール入力 --------------------------------------------------------------------------------------------------------->
    <div>
        @foreach ($admins as $admin)
            @if ( $admin->admin == 1 || 2 && $admin->club_id == 2)
                <!--ルール 入力-->
                <form action="{{ url('dance_rule_store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="rule_input">
                        @if ( count($rules) < 3 )
                            <input type="text" id="club_rule" name="rule" value="{{ old('rule') }}" placeholder="ダンス部の独自ルールを入力 (3Ruleまで)"/>
                            <input type="hidden" name="club_id" value="3"/>
                            <!-- Save/Backボタン --->
                            <button type="submit" class="btn btn-primary">Save</button>
                        @endif
                    </div>
                </form>
            @endif
        @endforeach
    </div>
    <!--ルール入力 END------------------------------------------------------------------------------------------------------>
    
    
    <!--共通ルール --------------------------------------------------------------------------------------------------------->
    <h3 class="rule_text">共通ルール</h3>
    <div class="rule_wrapper">
        <div class="all_rule">
            <h4 class="all_rule_text">敬語禁止</h4>   
            <h5>リスペクトは大事</h5>
        </div>
        <div class="all_rule">
            <h4 class="all_rule_text">批判禁止</h4>   
            <h5>できない理由を探さない,できる方法を考える</h5>
        </div>
        <div class="all_rule">
            <h4 class="all_rule_text">失敗を晒す</h4> 
            <h5>行動! 指導者は自身と仲間</h5>
        </div>
    </div>
    <!--共通ルール END----------------------------------------------------------------------------------------------------->
    
</div>

    
@endsection