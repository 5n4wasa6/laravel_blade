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

<!-- バリデーションエラーの表示に使用-->
@include('common.errors')
        
{{ csrf_field() }}
        
    <!--トライアスロン部上部 ------------------------------------------------------------------------->
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
    
    
    
    <!--TLフィード表示------------------------->
    <!--参加人数------------------------------>
    
    <!--そもそも押したevent_idを渡さないとダメ-->
    @foreach ($all_events as $all_event)
    
        @for ($i=0; $i<100; $i++) 
            @if ( $all_event->id == $i+1 )
                    <p>Go:<span>{{    $go_sum[ $i+1 ]     }}</span>people：&nbsp;
                    <p>Undecided:<span>{{ $undecided_sum[ $i+1 ] }}</span>people：&nbsp;
                    <p>Ungo:<span>{{   $ungo_sum[ $i+1 ]    }}</span>people
            @endif    
        @endfor
    
    @endforeach
    
<!--TLフィード表示------------------------->




@endsection
