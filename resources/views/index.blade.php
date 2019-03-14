<!--Bootstrap-->
<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Styles -->
<link href="{{ asset('css/index.css') }}" rel="stylesheet">


@extends('layouts.app')
@section('content')

@include('common.errors')

    <!--ナビゲーションバー---------------------------------------------------------------------------------------->
    <div class="navigation_nav">
        <!--HOMEページへのリンク---------->
        <p><a href="{{ action('DiscussionsController@index') }}">HOME</a></p>
    
        <!-- Clubページへのリンク--------->
        <p>| <a href="{{ action('ClubsController@index') }}">CLUB</a></p>
    
        <!-- EVENTページへのリンク-------->
        <p>| <a href="{{ action('EventsController@index') }}">EVENT</a></p>
    
        <!-- 通知ページへのリンク-------->
        <p>| <a href="{{ action('NotificationController@index') }}">NOTIFICATION</a></p>
    
        <!-- 設定ページへのリンク-------->
        <p>| <a href="#">SETTING</a></p>
    
        <!-- Myページへのリンク-------->
        <p>| <a href="{{ action('IntroductionsController@index') }}">MY PAGE</a></p>
    </div>
    <!--ナビゲーションバー END------------------------------------------------------------------------------------>  


<div class="container" id="gauge">
<div class="panel-body">
    
    <!--活動入力 ------------------------------------------------------------------------------------------------->
    <div class="icon_activity_wrapper">
        <!--アイコン-->
        <div class="input-group text-center">
            @if (count($profile) > 0)
                <a href="{{ action('IntroductionsController@index') }}">
                    <img src="upload/{{ $profile->comment_img }}" class="img-circle pull-left">
                </a>
            @else
                <a href="{{ action('IntroductionsController@index') }}">
                    <img src="upload/foto-tartaruga-_plastica.jpg" class="img-circle pull-left">
                </a>    
            @endif
        </div>
        
        <!--入力フォーム-->
        
        <a href="#postModal" role="button" data-toggle="modal">
            <input class="form-control input-lg icon_activity_input" placeholder="活動を入力" type="text">
        </a>
    </div>
    
    <form @submit.prevent="start()">
        <div id="postModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
    		        <div class="modal-header">
    			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    			    	活動を入力する
                    </div>
    			    <div class="modal-body">
    			        
    				    <form class="form center-block">
        				    <div class="form-group">
        				        
        				        <!-- タイトル--------------------->
                                <div class="col-sm-6">
                                    <label for="act_title">タイトル</label>
                                    <input type="text" name="act_title" id="act_title" autofocus="" class="form-control" value="{{ old('act_title') }}" required required v-model="act_title">
                                </div>
                                <!-- 活動日 -------------------->
                                <div class="col-sm-4">
                                        <label for="activity_at">日付</label>
                                        <input type="date" id="activity_at" name="activity_at" autofocus="" class="form-control" required required v-model="activity_at"/>
                                </div>
                                <!-- 種目------------------------>
                                <div class="col-sm-2">
                                    <label for="subject">種目</label>
                                    <select id="subject" name="subject" class="form-control" autofocus="" required required v-model="subject_name">
                                        <option value="SWIM">SWIM</option>
                                        <option value="BIKE">BIKE</option>
                                        <option value="RUN">RUN</option>
                                    </select>
                                </div>
                                <!-- アピール--------------------->
                                <div class="col-sm-6">
                                    <label for="appeal">アピールポイント</label>
                                    <input type="text" name="appeal" id="appeal" class="form-control" autofocus="" value="{{ old('appeal') }}" v-model="appeal">
                                </div>
                                <!-- ネクストアクション--------------------->
                                <div class="col-sm-6">
                                    <label for="nextaction">ネクストアクション</label>
                                    <input type="text" name="nextaction" id="nextaction" class="form-control" autofocus="" value="{{ old('nextaction') }}" v-model="nextaction">
                                </div>
                                <!-- フリー--------------------->
                                <div class="col-sm-12">
                                    <label for="free">フリー欄</label>
                                    <textarea type="text" name="free" id="free" class="form-control" autofocus="" value="{{ old('free') }}"  v-model="free"></textarea>
                                </div>
                                <!-- 画像--------------------->
                                <div class="col-sm-12">
                                    <label for="activity_img">Image</label>
                                    <input type="file" accept="image/*" name="activity_img" id="activity_img" value="{{ old('activity_img') }}" v-model="activity_img">
                                </div>
                            </div>
                            
    			        </form>
    			    </div>
    			    
    			    <div class="modal-footer">
    				    <button class="btn btn-primary pull-right" type="submit" onclick="closeModal()">投稿</button>
    				    <!--<button type="submit" class="btn btn-primary pull-right" data-dismiss="modal" aria-hidden="true">投稿</button>-->
                        <ul class="pull-left list-inline">
                            <li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li>
                            <li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li>
                            <li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li>
                        </ul>
    			    </div>
                </div>
    	    </div>
    	</div>
	</form>
    <!--活動入力 END---------------------------------------------------------------------------------------------->
    
    
    <!--ディスカッション ----------------------------------------------------------------------------------------->
    <div class="well discussion_wrapper">
        @foreach ($discussions as $discuss) 
            @if ($today == $discuss->created_at)
                <h4><a href="{{ action('DiscussionsController@all_discussion') }}" class="discussion_text">ディスカッション　</a></h4>
                <div class="thema"><h5 class="thema_text">〜本日のテーマ〜</h5></div>
                <div><h4 class="discussion_title_text"> {{ $discuss->title }}</h4></div>

                <div class="form-group discussion_comment">
                    
                    @for ($i=0; $i<100; $i++)
                        @if ($discuss->id == $i+1 && $discussion_sum[$i+1] > 0)
                            <a href="{{ action('DiscussionsController@all_comment') }}">
                                コメント{{ $discussion_sum[$i+1] }}件
                            </a>
                        @endif
                    @endfor
                    
                    
                    <form method="get" action="{{ route('comment.add') }}">
                        {{ csrf_field() }}
                    
                        <div class="form-group">
                            <input type="text" name="comment" class="form-control" placeholder="Add a comment.."/>
                            <input type="hidden" name="post_id" value="{{ $discuss->id }}"/>
                        </div>
                        
                        
                        <!--<div class="form-group">-->
                        <!--    <input type="submit" class="btn btn-warning" value="Add Comment" />-->
                        <!--</div>-->
                    </form>
                    <br>
                    
                    <!--<h4>Comment</h4>-->
                    @include('partials._comment_replies', ['comments' => $discussion_id->comments, 'post_id' => $discussion_id->id])
                    
                </div>
            @endif
        @endforeach
        
        <div class="see_more">
            @if ( $discussion_sum > 5 )
                <a href="{{ action('DiscussionsController@all_comment') }}">もっとみる</a>
            @endif
        </div>
    </div>
    <!--ディスカッション END-------------------------------------------------------------------------------------->
    
    
    <!--TIMELINE ------------------------------------------------------------------------------------------------->
    @if (count($alls) > 0)
        @foreach ($alls as $all)
            <div class="panel panel-default">
                <div class="panel-thumbnail">
                    @if ( $all->activity_img )
                        <img src="{{ $all->activity_img }}" class="img-responsive">
                    @else
                        <img src="upload/foto-tartaruga-_plastica.jpg" class="img-responsive">
                    @endif
                </div>
                
                <div class="panel-body">
                    <div class="profile_name">
                        @foreach ( $profile_tls as $profile_tl )
                            @if ( $profile_tl && $all->user_id == $profile_tl->user_id )
                                <a href="{{ action('ActivitiesController@show',$all) }}">
                                    <img src="upload/{{ $profile_tl->comment_img }}" height="28px" width="28px" style="border-radius:50%">
                                </a>
                            @endif
                        @endforeach
                        <p class="lead tl_name">
                            
                            @if ($all->user_id == $auths->id )
                                <a href="{{ action('IntroductionsController@index') }}" class="post_name">{{ $all->user->name }}</a>
                            @else
                                <a href="{{ action('ActivitiesController@show',$all) }}">{{ $all->user->name }}</a>
                            @endif
                            
                        </p>
                    </div>
                    <!--活動記録 競技/タイトル/アピール-->
                    <div class="tl_text">
                        <div>
                            @if ($all->user_id == $auths->id )
                                <a href="{{ action('ActivitiesController@edit',$all) }}">{{ $all->act_title }}</a>
                            @else
                                <a href="{{ action('ActivitiesController@look',$all) }}">{{ $all->act_title }}</a>
                            @endif
                            <span class="tl_language">{{ $all->language }}</span>
                        </div>
                        @if ( $all->appeal )
                            <div>【APPEAL】{{ str_limit($all->appeal, $limit = 28, $end = '....') }}</div>
                        @endif
                        
                        @if ( $all->nextaction )
                            <div>【NEXTACTION】{{ str_limit($all->nextaction, $limit = 28, $end = '....') }}</div>
                        @endif
                        
                        @if ( $all->free )
                            <div>【FREE】{{ str_limit($all->free, $limit = 28, $end = '....') }}</div>
                        @endif
                    </div>
                </div>
                
                <!--コメント-------------------->
                <div class="panel-footer">
                    <form action="{{ url('activity_comment') }}" method="POST">
                    {{ csrf_field() }}
                        <div class="input-group">
                            <input id="activity_comment" name="activity_comment" class="form-control" placeholder="Add a comment.." type="text">
                            <input type="hidden" id="post_id" name="post_id" value="{{ $all->id }}">
                        </div>
                    </form>
                    
                    <div>
                        @for ($i=0; $i<100; $i++)
                            @if ($all->id == $i+1 && $comment_activity_sum[$i+1] > 0)
                                コメント{{ $comment_activity_sum[$i+1] }}件
                            @endif
                        @endfor
                        
                        @foreach ($comments_activity as $comment_activity)
                            @if ( $all->id == $comment_activity->post_id)
                                <div class="comments">
                                    <div>{{ $comment_activity->user->name }}:</div> &nbsp;
                                    <div>{{ $comment_activity->activity_comment }}</div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="see_more">
                        @for ($i=0; $i<100; $i++)
                            @if ($all->id == $i+1 && $comment_activity_sum[$i+1] > 3)
                                <a href="{{ action('ActivitiesController@look',$all) }}">もっとみる</a>
                            @endif
                        @endfor
                    </div>
                </div>
                <!--コメント END-------------------->
            </div>
        @endforeach
    @endif
    <!--TIMELINE END---------------------------------------------------------------------------------------------->


    <!--ゲージ処理------------------------------------------------------------------------------------------------>
    <input type="hidden" id="user_id" value="{{ $auths->id }}"/>

    @if ( $user_coins )
        <input type="hidden" id="coin_done"  value="{{ $user_coins->coin}}"/>
    @else
        <input type="hidden" id="coin_done"  value="100000"/>
    @endif
    
    <!--SWIM処理------------------------------------------->
    @if ( isset($swims["0"]) ) 
       @foreach ($swims as $swim)
            @if ($swim->user_id == $auths->id )
                <input type="hidden" id="progress_done1"    value="{{ $swim->exp }}"/>
                <input type="hidden" id="denominator_done1" value="{{ $swim->denominator }}"/>
                <input type="hidden" id="ttl_done1"         value="{{ $swim->ttl }}"/>
                <input type="hidden" id="level_done1"       value="{{ $swim->level }}"/>
            @else
                <input type="hidden" id="progress_done1"    value="0"/>
                <input type="hidden" id="denominator_done1" value="2"/>
                <input type="hidden" id="ttl_done1"         value="0"/>
                <input type="hidden" id="level_done1"       value="1"/>
            @endif
        @endforeach
    @else
        <input type="hidden" id="progress_done1"    value="0"/>
        <input type="hidden" id="denominator_done1" value="2"/>
        <input type="hidden" id="ttl_done1"         value="0"/>
        <input type="hidden" id="level_done1"       value="1"/>
    @endif
    <!--BIKE処理------------------------------------------->
    @if ( isset($bikes["0"]) ) 
        @foreach ($bikes as $bike)
            @if ($bike->user_id == $auths->id )
                <input type="hidden" id="progress_done2"    value="{{ $bike->exp}}"/>
                <input type="hidden" id="denominator_done2" value="{{ $bike->denominator }}"/>
                <input type="hidden" id="ttl_done2"         value="{{ $bike->ttl }}"/>
                <input type="hidden" id="level_done2"       value="{{ $bike->level }}"/>
            @else
                <input type="hidden" id="progress_done2"    value="0"/>
                <input type="hidden" id="denominator_done2" value="2"/>
                <input type="hidden" id="ttl_done2"         value="0"/>
                <input type="hidden" id="level_done2"       value="1"/>
            @endif
        @endforeach
    @else
        <input type="hidden" id="progress_done2"    value="0"/>
        <input type="hidden" id="denominator_done2" value="2"/>
        <input type="hidden" id="ttl_done2"         value="0"/>
        <input type="hidden" id="level_done2"       value="1"/>
    @endif
    <!--RUN処理------------------------------------------->
    @if ( isset($runs["0"]) ) 
        @foreach ($runs as $run)
            @if ($run->user_id == $auths->id )
                <input type="hidden" id="progress_done3"    value="{{ $run->exp }}"/>
                <input type="hidden" id="denominator_done3" value="{{ $run->denominator }}"/>
                <input type="hidden" id="ttl_done3"         value="{{ $run->ttl }}"/>
                <input type="hidden" id="level_done3"       value="{{ $run->level }}"/>
            @else
                <input type="hidden" id="progress_done3"    value="0"/>
                <input type="hidden" id="denominator_done3" value="2"/>
                <input type="hidden" id="ttl_done3"         value="0"/>
                <input type="hidden" id="level_done3"       value="1"/>
            @endif
        @endforeach
    @else
        <input type="hidden" id="progress_done3"    value="0"/>
        <input type="hidden" id="denominator_done3" value="2"/>
        <input type="hidden" id="ttl_done3"         value="0"/>
        <input type="hidden" id="level_done3"       value="1"/>
    @endif
    <!--ゲージ処理------------------------------------------------------------------------------------------------->

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script src="{{ asset('js/gauge.js') }}"></script>
<script>
// --vue.jsにセッション経由でuser_idを渡す処理----------------
    const userId = document.getElementById("user_id").value;
    window.sessionStorage.setItem("user_id", userId);
    
    const coinDone = document.getElementById("coin_done").value;
    window.sessionStorage.setItem("coin_done", coinDone);
    
    // SWIM処理-----------------------------
        const progressDone1    = document.getElementById("progress_done1").value;
        const denominatorDone1 = document.getElementById("denominator_done1").value;
        const ttlDone1         = document.getElementById("ttl_done1").value;
        const levelDone1       = document.getElementById("level_done1").value;
        
        window.sessionStorage.setItem("progress_done1", progressDone1);
        window.sessionStorage.setItem("denominator_done1", denominatorDone1);
        window.sessionStorage.setItem("ttl_done1", ttlDone1);
        window.sessionStorage.setItem("level_done1", levelDone1);
    
    // BIKE処理-----------------------------    if ( coinDone &
        const progressDone2    = document.getElementById("progress_done2").value;
        const denominatorDone2 = document.getElementById("denominator_done2").value;
        const ttlDone2         = document.getElementById("ttl_done2").value;
        const levelDone2       = document.getElementById("level_done2").value;
        
        window.sessionStorage.setItem("progress_done2", progressDone2);
        window.sessionStorage.setItem("denominator_done2", denominatorDone2);
        window.sessionStorage.setItem("ttl_done2", ttlDone2);
        window.sessionStorage.setItem("level_done2", levelDone2);
    
    // RUN処理-----------------------------
        const progressDone3    = document.getElementById("progress_done3").value;
        const denominatorDone3 = document.getElementById("denominator_done3").value;
        const ttlDone3         = document.getElementById("ttl_done3").value;
        const levelDone3       = document.getElementById("level_done3").value;
        
        window.sessionStorage.setItem("progress_done3", progressDone3);
        window.sessionStorage.setItem("denominator_done3", denominatorDone3);
        window.sessionStorage.setItem("ttl_done3", ttlDone3);
        window.sessionStorage.setItem("level_done3", levelDone3);
    
    
    // モーダルを閉じる-----------------------------------------------
    function closeModal(){
        const title    = document.querySelector("#act_title").value;
        const activity = document.querySelector("#activity_at").value;
        const subject  = document.querySelector("#subject").value;
        
        if (title && activity && subject) {
            let backDrop = document.querySelector(".modal-backdrop");
            let postModal = document.getElementById("postModal");
            postModal.style.display = "none";
            backDrop.style.display = "none";
        } else {
            return ;
        }
    }
</script>


@endsection




