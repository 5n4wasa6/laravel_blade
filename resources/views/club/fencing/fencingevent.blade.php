@extends('layouts.app')
@section('content')


@include('common.errors')
{{ csrf_field() }}

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

    
    <!--フェンシング部上部 ------------------------------------------------------------------------->
    <!--▲画像設定を管理者(部長/副部長)のみができるようにする----------->
    <img src="upload/sports_fencing.png" class="image_wrapper">    
        
    <h2 class="club_club">フェンシング部</h2>
    <!--参加人数抽出---->
    <div>
        <h4>部員:<span> {{ $users }}</span>人</h4>
        <a href="{{ action('Club\FencingController@member') }}">
            <div class="club_member">
                    @foreach ($alls as $all)
                        <p>{{ $all->user->name }}</p> &nbsp;
                    @endforeach
                    <p>・・・</p>
            </div>
        </a>
    </div>
    <div>
        <a href="{{ action('Club\FencingController@admin') }}" class="main_sub_manager">
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
        <p><a href="{{ action('Club\FencingController@rule') }}">RULE</a></p>
        <p> | <a href="{{ action('Club\FencingController@fencing') }}">DISCUSSION</a></p>
        <p> | <a href="{{ action('Club\FencingController@event') }}">EVENT</a></p>
        <p> | <a href="#">TEACHING</a></p>
    </div>
    <!--フェンシング部上部 -------------------------------------------------------------------------->
    <br>
    <br>

<div class="panel-body">
    
    <!--EVENT入力 ----------------------------------------------------------------------------------------------------------->
    <div class="panel panel-default"> 
        <form  enctype="multipart/form-data" action="{{ url('fencing_event_store') }}" method="POST">
            {{ csrf_field() }}
            <div class="panel-body">
                <!--タイトル --->
                <div class="f_table">
                    <label for="title" class="f_event_text">タイトル</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}"/>
                </div>
                <!--競技---->
                <div class="f_table">
                    <label for="subject" class="f_event_text">競技</label>
                    <select id="subject" name="subject" value="{{ old('subject') }}">
                        <option value="Fencing">Fencing</option>
                        <option value="Wheelchair Fencing">Wheelchair Fencing</option>
                    </select>
                </div>
                <!--日時 --->
                <div class="f_table">
                    <label for="date" class="f_event_text">日程</label>
                    <input type="date" id="date" name="date" value="{{ old('date') }}"/>
                </div>
                <!--場所 ---->
                <div class="f_table">
                    <label for="place" class="f_event_text">場所</label>
                    <input type="text" id="place" name="place" value="{{ old('place') }}"/>
                </div>
                <!--内容 ---->
                <div class="f_table">
                    <label for="body" class="f_event_text">ルール</label>
                    <input type="text" id="body" name="body" value="{{ old('body') }}"/>
                </div>
                <!--画像 --->
                <div class="f_table">
                    <label for="event_img" class="f_event_text">画像</label>
                    <input type="file" id="event_img" name="event_img" accept="image/*" value="{{ old('event_img') }}"/>
                </div>
            </div>
            
            <input type="hidden" name="club_id" value="2"/>
            <!-- Save/Backボタン --->
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
    <!--EVENT入力 END ------------------------------------------------------------------------------------------------>
    <br>
    <br>

    <!--TLフィード表示------------------------------------------------------------------------------------------------>
    @foreach ($all_events as $all_event)
        <div class="panel panel-default">
            <div class="panel-body">
                @if ($all_event->user_id == $auths->id)
                    <div class="discussion_editdelete">
                        <!-- 更新ボタン -->
                        <div>
                            <a href="{{ action('Club\FencingController@event_edit',$all_event) }}">
                                <button type="button" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </button>
                            </a>
                        </div>
                        <!-- 削除ボタン -->
                        <div>
                            <form action="{{ url('fencing_events/'.$all_event->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger"> <i class="glyphicon glyphicon-trash"></i> </button>
                            </form>
                        </div>
                    </div>
                @endif
                
                <!--No.{{ $all_event->id }}-->
                <p>HOST: {{ $all_event->user->name }}</p>
                <h4 class="card-text card_title">TITLE: {{ $all_event->title }}</h4>
                <span>SUBJECT: {{  $all_event->subject  }}</span><br>
                <span>DATE:    {{   $all_event->date    }}</span><br>
                <span>PLACE:   {{   $all_event->place   }}</span><br>
                <span>POST:    {{   $all_event->body    }}</span><br>
                <span>         {{ $all_event->event_img }}</span>
               
                <!--参加可否ボタン-->
                <form action="{{ url('fencing_participate_store') }}" method="GET">
                    <input type="hidden" name="event_id" value="{{ $all_event->id }}"/>
                    <div>
                        <button type="submit" name="go"        class="btn btn-primary" value="1">go</button>：&nbsp;
                        <button type="submit" name="undecided" class="btn btn-primary" value="1">undecided</button>：&nbsp;
                        <button type="submit" name="ungo"      class="btn btn-primary" value="1">ungo</button>
                    </div>
                </form>
                
                <!---参加人数--->
                @for ($i=0; $i<100; $i++) 
                    @if ( $all_event->id == $i+1 )
                        <a href="{{ action('Club\FencingController@participants') }}">
                            <span>{{    $go[ $i+1 ]     }}</span>people：&nbsp;
                            <span>{{ $undecided[ $i+1 ] }}</span>people：&nbsp;
                            <span>{{   $ungo[ $i+1 ]    }}</span>people
                        </a>
                    @endif    
                @endfor
            </div>
            
            <!--コメント--------------------->
            <div class="panel-footer">
                <form action="{{ url('/fencing_event_comment') }}" method="POST">
                {{ csrf_field() }}
                    <div class="chat_wrapper">
                        <input id="event_comment" name="event_comment" placeholder=" Add a comment...">
                        <input type="hidden" id="post_id" name="post_id" value="{{ $all_event->id }}">
                        <input type="hidden" name="club_id" value="2"/>
                    </div>
                </form>
                
                <div>
                    @foreach ($event_comments as $event_comment)
                        @if ( $all_event->id == $event_comment->post_id)
                            <div class="comments">
                                <div>{{ $event_comment->user->name }}:</div> &nbsp;
                                <div>{{ $event_comment->event_comment }}</div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <!--コメント--------------------->
        </div>
    @endforeach
    <!--TLフィード表示----------------------------------------------------------------------------------------------->

</div>

@endsection