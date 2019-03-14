@extends('layouts.app')
@section('content')

<!-- Bootstrap ------------------------------------>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>-->
<!-- Latest compiled JavaScript -->
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
    <!--- ▲画像設定を管理者(部長/副部長)のみができるようにする --->
    <img src="upload/dance_shadow.jpg" class="image_wrapper">    
        
    <h2 class="club_club">ダンス部</h2>
    <!--参加人数抽出---->
    <div>
        <h4>部員:<span> {{ $users }}</span>人</h4>
        <a href="{{ action('Club\DanceController@member') }}">
            <div class="club_member">
                    @foreach ($members as $member)
                        <p>{{ $member->user->name }}</p> &nbsp;
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

    <!--スレッド建て--------------------------------------------------------------------------------->
    <div class="panel panel-default">  
        <form  enctype="multipart/form-data" action="{{ url('dancediscuss') }}" method="POST">
            {{ csrf_field() }}
        <div class="panel-body">
            <div class="thread">
                <!--投稿内容 --->
                <div class="club_discussion_post">
                    <label for="body">投稿内容</label>
                    <input type="text" id="body" name="body" value="{{ old('body') }}"/>
                </div>
                <!--画像 ------->
                <div class="club_discussion_img">
                    <input type="file" id="club_img" name="club_img" accept="image/*" value="{{ old('club_img') }}"/>
                </div>
                <!--club_id-->
                <input type="hidden" name="club_id" value="3">
                
                <!-- Saveボタン --->
                <button type="submit" class="btn btn-primary thread_btn">Save</button>
            </div>
        </div>
        </form>
    </div>
    <!--スレッド建て END----------------------------------------------------------------------------->
    <br>
    <br>


    <!--タイムライン表示----------------------------------------------------------------------------->
    @foreach ($alls as $all)
        <div class="panel panel-default">  
            <!--▲min-widthのスタイル要変更-->
            <div class="panel-body">
                <!--自分の投稿のみ更新/削除可能に------>
                @if ($all->user_id == $auths->id)
                    <div class="discussion_editdelete">
                        <!-- 更新ボタン -->
                        <div>
                            <a href="{{ action('Club\DanceController@discussion_edit',$all) }}">
                                <button type="button" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </button>
                            </a>
                        </div>
                        <!-- 削除ボタン -->
                        <div>
                            <form action="{{ url('dance_discussions/'.$all->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger"> <i class="glyphicon glyphicon-trash"></i> </button>
                            </form>
                        </div>
                    </div>
                @endif
                <!--自分の投稿のみ削除可能に------>
                
                <p>投稿者: {{ $all->user->name }}</p>
                <h4 class="card-text card_title">{{ $all->title }}</h4>
                <span>{{ $all->body }}</span>
                <span>{{ $all->club_img }}</span>
                <br>
                
                <!--100の部分の変更が必要(ClubsControllerのpublic function club_eventのところ)-->
                @for ($i=0; $i<100; $i++) 
                    @if ( $all->id == $i+1 )
                        コメント数:{{ $comment_sum[$i+1] }}件
                    @endif
                @endfor
            </div>   
            
            <!--コメント--------------------->
            <div class="panel-footer">    
                <form action="{{ url('dance_discussion_comment') }}" method="POST">
                {{ csrf_field() }}
                    <div class="chat_wrapper">
                        <input id="body" name="body" placeholder=" Add a comment...">
                        <input type="hidden" id="post_id" name="post_id" value="{{ $all->id }}">
                        <input type="hidden" name="club_id" value="3">
                    </div>
                </form>
                
                @for ($i=0; $i<100; $i++) 
                    @if ( $all->id == $i+1 )
                        コメント数:{{ $comment_sum[$i+1] }}件
                    @endif
                @endfor
                
                <div>
                    @foreach ($comments as $comment)
                        @if ( $all->id == $comment->post_id)
                            <div class="comments">
                                <div>{{ $comment->user->name }}:</div> &nbsp;
                                <div>{{ $comment->body }}</div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <!--コメント--------------------->
        </div>
    @endforeach
    <!--タイムライン表示 END------------------------------------------------------------------------->
    
</div>
    
@endsection