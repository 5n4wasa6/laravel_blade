@extends('layouts.app')
@section('content')

@include('common.errors')
{{ csrf_field() }}

<!--Bootstrap-->
<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>-->
<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>-->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<!-- Styles -->
<link href="{{ asset('css/club.css') }}" rel="stylesheet">   


    <!--フェンシング部上部 ------------------------------------------------------------------------->
    <!--▲画像設定を管理者(部長/副部長)のみができるようにする----------->
    <img src="upload/31Afrb9znyL.jpg" class="image_wrapper">    
        
    <h2 class="club_club">トライアスロン部</h2>
    <!--参加人数抽出---->
    <div>
        <h4>部員:<span> {{ $users }}</span>人</h4>
        <a href="{{ action('Club\TriathlonController@member') }}">
            <div class="club_member">
                    @foreach ($alls as $all)
                        <p>{{ $all->user->name }}</p> &nbsp;
                    @endforeach
                    <p>・・・</p>
            </div>
        </a>
    </div>
    <div>
        <a href="{{ action('Club\TriathlonController@admin') }}" class="main_sub_manager">
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
        <p><a href="{{ action('Club\TriathlonController@rule') }}">RULE</a></p>
        <p> | <a href="{{ action('Club\TriathlonController@triathlon') }}">DISCUSSION</a></p>
        <p> | <a href="{{ action('Club\TriathlonController@event') }}">EVENT</a></p>
        <p> | <a href="#">TEACHING</a></p>
    </div>
    <!--フェンシング部上部 -------------------------------------------------------------------------->
    <br>
    <br>


<div class="panel-body">
    
    <!--部長/副部長 入力--------------------------------------------------------------------------->
    <form action="{{ url('triathlon_admin_store') }}" method="POST">
        {{ csrf_field() }}
        <div>
            <!--部長 ----------->
            <div class="manager">
                <label class="manager_text">【部長】</label>
                
                @if ( $main_manager )
                    <div>{{ $main_manager->user->name }}</div>
                    <div>( {{ $main_manager->created_at->format('Y/m/d') }} ~ {{ $main_manager->created_at->addMonth(3)->format('Y/m/d') }} )</div>
                @elseif ( count($sub_manager) > 0 && $sub_manager->user_id == $auths->id )
                        <!--空欄でOK-->
                @else
                    <button type="submit" class="btn btn-primary" name="admin" value="1"/>申請</button>
                @endif
            </div>
            <!--副部長 --------->
            <div class="manager">
                <label class="manager_text">【副部長】</label>
                
                @if ( $sub_manager )
                    <div>{{ $sub_manager->user->name }}</div>
                    <div>( {{ $sub_manager->created_at->format('Y/m/d') }} ~ {{ $sub_manager->created_at->addMonth(3)->format('Y/m/d') }} )</div>
                @elseif ( count($main_manager) > 0 && $main_manager->user_id == $auths->id )
                        <!--空欄でOK-->
                @else
                    <button type="submit" class="btn btn-primary" name="admin" value="2"/>申請</button>
                @endif
                
            </div>
        </div>
        
        <!--特定のclub_idを渡す処理を書かないといけない-->
            <input type="hidden" name="club_id" value="1">
    </form>
    <!--部長/副部長 入力 END------------------------------------------------------------------------>
    
    
    <!--ルールPageに戻る--------------------->
    <a class="btn btn-link pull-right" href="{{ url('/triathlon_rule') }}">
        <i class="glyphicon glyphicon-backward"></i>  Back
    </a>
    <!--ルールPageに戻る END----------------->
    
</div>
    
@endsection