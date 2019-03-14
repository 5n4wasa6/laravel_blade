<!-- Styles -->
<link href="{{ asset('css/index.css') }}" rel="stylesheet">


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
    
    <!---------------------------------------------------------------------------------------------------------------------- 友達申請 --->

    <!--@foreach ($applies as $apply)-->
    <!--    @if ( $apply->to_who == $auth->id )-->
    <!--        <div>-->
                
                
    <!--            @if ( count($approvals) > 0 )-->
    <!--                @foreach ($approvals as $approval)-->
    <!--                    @if ( count($approval->from_who == $apply->to_who) > 0)-->
                            
    <!--                    @endif-->
    <!--                @endforeach-->
    <!--            @else-->
    <!--                <div>-->
    <!--                    <form action="{{ url('approval') }}" method="GET">-->
    <!--                        <div>-->
                                
                                <!-- アイコン -->
    <!--                            <div>-->
    <!--                                @foreach ( $profile_tls as $profile_tl )-->
    <!--                                    @if ( $profile_tl && $apply->user_id == $profile_tl->user_id )-->
    <!--                                        <a href="{{ action('NotificationController@show',$apply) }}">-->
    <!--                                            <img src="upload/{{ $profile_tl->comment_img }}" height="28px" width="28px" style="border-radius:50%">-->
    <!--                                        </a>-->
    <!--                                    @endif-->
    <!--                                @endforeach-->
    <!--                            </div>-->
                                <!-- 名前 -->
    <!--                            <div>-->
    <!--                                <p><a href="{{ action('NotificationController@show',$apply) }}" class="post_name">{{ $apply->user->name }}</a></p>-->
    <!--                            </div>-->
    <!--                        </div>-->
                            
    <!--                        <div>-->
    <!--                            <input type="hidden" name="from_who" value="{{ $apply->user_id }}"/>-->
    <!--                            <input type="hidden" name="approval" value="1"/>-->
    <!--                            <button class="btn btn-primary" type="submit">承認</button>-->
    <!--                        </div>-->
    <!--                    </form>-->
    <!--                </div>-->
                    
    <!--                <div>-->
    <!--                    <form action="{{ url('apply_delete/'.$apply->id) }}" method="POST">-->
    <!--                        {{ csrf_field() }}-->
    <!--                        {{ method_field('DELETE') }}-->
    <!--                        <button type="submit" class="btn btn-primary">削除</button>-->
    <!--                    </form>-->
    <!--                </div>-->
    <!--            @endif-->
                
                
                <!--<div>-->
                <!--    <form action="{{ url('approval') }}" method="GET">-->
                <!--        <div>-->
                            
                <!--             アイコン -->
                <!--            <div>-->
                <!--                @foreach ( $profile_tls as $profile_tl )-->
                <!--                    @if ( $profile_tl && $apply->user_id == $profile_tl->user_id )-->
                <!--                        <a href="{{ action('NotificationController@show',$apply) }}">-->
                <!--                            <img src="upload/{{ $profile_tl->comment_img }}" height="28px" width="28px" style="border-radius:50%">-->
                <!--                        </a>-->
                <!--                    @endif-->
                <!--                @endforeach-->
                <!--            </div>-->
                <!--             名前 -->
                <!--            <div>-->
                <!--                <p><a href="{{ action('NotificationController@show',$apply) }}" class="post_name">{{ $apply->user->name }}</a></p>-->
                <!--            </div>-->
                <!--        </div>-->
                        
                <!--        <div>-->
                <!--            <input type="hidden" name="from_who" value="{{ $apply->user_id }}"/>-->
                <!--            <input type="hidden" name="approval" value="1"/>-->
                <!--            <button class="btn btn-primary" type="submit">承認</button>-->
                <!--        </div>-->
                <!--    </form>-->
                <!--</div>-->
                    
                <!--<div>-->
                <!--    <form action="{{ url('apply_delete/'.$apply->id) }}" method="POST">-->
                <!--        {{ csrf_field() }}-->
                <!--        {{ method_field('DELETE') }}-->
                <!--        <button type="submit" class="btn btn-primary">削除</button>-->
                <!--    </form>-->
                <!--</div>-->
                
    <!--        </div>-->
    <!--    @endif-->
    <!--@endforeach -->


        @foreach ($approvals as $approval)
            
            <div>
                <form action="{{ url('approval') }}" method="GET">
                    {{ csrf_field() }}
                    <div>
                         <!--アイコン -->
                        <div>
                            @foreach ( $profile_tls as $profile_tl )
                                @if ( $profile_tl && $approval->user_id == $profile_tl->user_id )
                                    <a href="{{ action('NotificationController@show',$approval) }}">
                                        <img src="upload/{{ $profile_tl->comment_img }}" height="28px" width="28px" style="border-radius:50%">
                                    </a>
                                @endif
                            @endforeach
                        </div>
                         <!--名前 -->
                        <div>
                            <p>{{ $approval->user->name }}</p>
                        </div>
                    </div>
                    
                    <div>
                        <input type="hidden" name="user_id" value="{{ $approval->user_id }}"/>
                        <input type="hidden" name="to_who" value="{{ $approval->to_who }}"/>
                        <input type="hidden" name="status" value="2">
                        <button class="btn btn-primary" type="submit">承認</button>
                    </div>
                    
                    <input type="hidden" name="id" value="{{$approval->id}}" />
                    {{ csrf_field() }}
                </form>
            </div>
                
            <div>
                <form action="{{ url('approval_delete/'.$approval->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-primary">削除</button>
                </form>
            </div>
        
        @endforeach
        
    
</div>


@endsection



