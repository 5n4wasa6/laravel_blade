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
<link href="{{ asset('css/introduction.css') }}" rel="stylesheet">


@extends('layouts.app')
@section('content')
    
@include('common.errors')

<!--ナビゲーションバー------------------------------------------------------------------------->
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
<!--ナビゲーションバー END---------------------------------------------------------------------> 
    
    
<div class="panel-body">
    
    <!--COMMITMENT---------------------------------------------------------------------------------> 
    <div>
        <div class="commitment_title">
             <span class="commitment_text">コミットメント　</span>
        </div>

        <div>
            <!-- 長期 --------------->
            @if (count($comment1) > 0)
                <div class="comment123">
                    <div class="term">長期：</div>
                    <div class="comment_text">
                        {{ $comment1->comment }}
                        <!--【達成日】{{ $comment1->commit_at->format('Y/n/d') }}-->
                    </div>
                </div>
            @else
                <div class="comment123">
                    長期： Input your Commitment
                </div>
            @endif
            <!-- 中期 --------------->
            @if (count($comment2) > 0)    
                <div class="comment123">
                    <div class="term">中期：</div>
                    <div class="comment_text">
                        {{ $comment2->comment }}
                        <!--【達成日】{ $comment2->commit_at->format('Y/n/j') }}-->
                    </div>
                </div>
            @else
                <div class="comment123">
                    中期： Input your Commitment
                </div>
            @endif
            <!-- 短期 --------------->
            @if (count($comment3) > 0)     
                <div class="comment123">
                    <div class="term">短期：</div>
                    <div class="comment_text">
                        {{ $comment3->comment }}
                        <!--【達成日】{{ $comment3->commit_at->format('Y/n/j') }}-->
                    </div>
                </div>
            @else
                <div class="comment123">
                    短期： Input your Commitment
                </div>
            @endif
        </div>
    </div>
    <!--COMMITMENT END------------------------------------------------------------------------------> 
    
    
    <!--ICON---------------------------------------------------------------------------------------->
    <div class="icon_bgc">
        <div class="icon_wrapper">
            @if (count($profile) > 0)
                <img src="../upload/{{ $profile->comment_img }}"  class="icon_img">
            @else
                <img src="upload/foto-tartaruga-_plastica.jpg" class="icon_img">
            @endif
            <!-- 名前/一言 -->
            <!--名前--->
            <h4 class="icon_name">{{ $user->user->name }}</h4>
            <!--一言--->
            @if ( $oneword )
                <p>{{ $oneword->oneword }}</p>
            @else
                <p>一言コメント</p>
            @endif
            
            <div id="apply">
                    
                <form>
                    <input type="hidden" name="to_who" id="to_who" value="{{ $user->user->id }}"/>
                    <button @click="friend()">{{ state }}</button> 
                </form>
            
                <div>   
                <div>
                    <a href="{{ action('IntroductionsController@follow') }}">
                        Follow:{{ $follow }}人 
                    </a>
                </div>
                
                <div>
                    <a href="{{ action('IntroductionsController@follower') }}">
                        Follower:{{ $follower }}人
                    </a>
                </div>
            </div> 
            
            </div>
        </div>
    </div>
    <!--ICON END------------------------------------------------------------------------------------->  
    
    
    <!--SCORE/COIN----------------------------------------------------------------------------------->
    <div class="panel panel-default">
        <div class="score_coin_wrapper">
            <div class="ability">
                <div>ACTIVITY:</div>
                <div>GOAL:</div>
                <div>USE:</div>
                <div>EARN:</div>
                <div>DISCUSS:</div>
                <div>EVENT:</div>
            </div>
            <div>
                <!--SCORE-->
                <img src="../upload/download.png" class="score_img">
                <!--<div class="score">-->
                <!--    <div class="score_bgc">-->
                <!--        <div class="score_text">score</div>-->
                <!--        <div class="score_figure">500</div>-->
                <!--    </div>-->
                <!--</div>-->
                <!--COIN------>
                <div class="coin">
                    @if ( $user_coins )
                        <div class="coin">
                            {{ $user_coins->coin }}Coin
                        </div>
                    @else 
                        <div class="coin">
                            100000Coin
                        </div>
                    @endif
                    
                </div>
                <!--COIN END-->
            </div>
        </div>
    </div>
    <!--SCORE/COIN----------------------------------------------------------------------------------->
    
    
    <!--ACTIVITY ------------------------------------------------------------------------------------>
    <div class="panel panel-default">
        <div class="activity_title">
            <h4><a href="#" class="activity_text">活動実績　</a></h4>
        </div>
        
        <!--GAUGE ----->
        <div>
            <!-- SWIM ------------------------>
            @foreach ($swims as $swim)
                @if ($swim->user_id == $user->user_id )
                    <div class="activity_card">
                        <div class="card-text card_title">
                            <h4>SWIM</h4>
                        </div>
                        <div class="gauge">
                            <span>Lv. {{ $swim->level }}</span> &nbsp;
                            <meter low="30" high="80" max="{{ $swim->denominator }}" value="{{ $swim->exp }}"></meter> &nbsp;
                            <span value="">計: {{ $swim->ttl }}</span>
                            <!--<span> {{ $swim->exp }} / {{ $swim->denominator }} </span><br>-->
                        </div>
                    </div>
                @endif
            @endforeach
            <!-- BIKE ------------------------>
            @foreach ($bikes as $bike)
                @if ($bike->user_id == $user->user_id )
                    <div class="activity_card">
                        <div class="card-text card_title">
                            <h4>BIKE</h4>
                        </div>
                        <div class="gauge">
                            <span>Lv. {{ $bike->level }}</span> &nbsp;
                            <meter low="30" high="80" max="{{ $bike->denominator }}" value="{{ $bike->exp }}"></meter> &nbsp;
                            <span value="">計: {{ $bike->ttl }}</span>
                            <!--<span> {{ $bike->exp }} / {{ $bike->denominator }} </span><br>-->
                        </div>
                    </div>
                @endif
            @endforeach
            <!-- RUN ------------------------>
            @foreach ($runs as $run)
                @if ($run->user_id == $user->user_id )
                    <div class="activity_card">
                        <div class="card-text card_title">
                            <h4>RUN</h4>
                        </div>
                        <div class="gauge">
                            <span>Lv. {{ $run->level }}</span> &nbsp;
                            <meter low="30" high="80" max="{{ $run->denominator }}" value="{{ $run->exp }}"></meter> &nbsp;
                            <span value="">計: {{ $run->ttl }}</span>
                            <!--<span> {{ $run->exp }} / {{ $run->denominator }} </span><br>-->
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <!--GAUGE END-->
    </div>
    <!--ACTIVITY END------------------------------------------------------------------------------>  
    

    <!--ACTIVITY RECORD -------------------------------------------------------------------------->
    <div class="panel panel-default">
        <div class="slider_wrapper">
            <h4><a href="{{ action('ActivitiesController@record') }}" class="activity_text">活動記録　</a></h4>
            <div class="slider">
                @if (count($activities) > 0)
                    @foreach ($activities as $activity)
                        <div class="unit">
                            <!-- IMAGE ---->
                            <div class="img">
                                @if ( $activity->activity_img )
                                    <img src="../upload/{{ $activity->activity_img }}" class="activity_img">
                                @else
                                    <img src="../upload/foto-tartaruga-_plastica.jpg" class="activity_img">
                                    <!-- アピール ------------>
                                    <!--<div>APPEAL:{{ $activity->appeal }}</div>-->
                                    <!-- ネクストアクション -->
                                    <!--<div>NEXTACTION:{{ $activity->nextaction }}</div>-->
                                    <!-- フリー -------------->
                                    <!--<div>FREE:{{ $activity->free }}</div>-->
                                @endif
                            </div>
                            <!--テキスト-->
                            <div class="activity_record_text">
                                <!-- 活動日 --->
                                <div class="activity_record_date">{{ $activity->activity_at->format('Y/n/j') }}</div>
                                <!--タイトル--->
                                <div class="activity_record_title">{{ str_limit($activity->act_title, $limit = 38, $end = '....') }}</div>
                                <!-- 競技 ----->
                                <!--<div>{{ $activity->language }}　Lv.◯◯/Gauge</div>-->
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <!--ACTIVITY RECORD END----------------------------------------------------------------------->


    <!--GOAL & DREAM------------------------------------------------------------------------------>
    <div class="panel panel-default">
        <div class="slider_wrapper">
            <div class="goal_dream_title">
                <h4><a href="{{ action('GoalsController@all') }}" class="goal_dream_text">目標/夢　</a></h4>
                <!-- 登録フォーム --->
                <form enctype="multipart/form-data" action="{{ url('index') }}" method="POST">
                {{ csrf_field() }}
                    
                    <div class="goal_input">
                        
                        <!-- エラー判定 -->
                        @if ($errors->has('goal'))
                            <span class="error">{{ $errors->first('goal') }}</span>
                        @endif
                    </div>
                </form>
                <!-- 登録フォーム END--->
            </div>
            
            
            <div class="slider">
                @foreach ($goals as $goal)
                     <div class="unit_goal"> 
                        <div> 
                             <div class="activity_record_text">
                                <!-- コミットDATE -->
                                @if ( $goal->commit_at )
                                    <p>【達成日】{{ $goal->commit_at->format('Y/n/j') }}</p>
                                @else
                                    <p class="activity_record_date">【達成日】20YY/MM/DD</p>
                                @endif
                                
                                <p class="card-text">{{ str_limit($goal->goal, $limit = 22, $end = '....') }}</a></p>
                                <p class="card-text">WHY:{{ str_limit($goal->why, $limit = 14, $end = '....') }}</p>
                                <p class="card-text">HOW:{{ str_limit($goal->how, $limit = 14, $end = '....') }}</p>
                                <p class="card-text">WHAT:{{ str_limit($goal->what, $limit = 14, $end = '....') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>   
    </div>
    <!--GOAL & DREAM------------------------------------------------------------------------------>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script src="{{ asset('js/friend.js') }}"></script>

<script>
    
    const toWho = document.getElementById("to_who").value;
    window.sessionStorage.setItem("to_who", toWho);
</script>

@endsection





