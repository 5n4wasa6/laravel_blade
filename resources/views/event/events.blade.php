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
<link href="{{ asset('css/event.css') }}" rel="stylesheet"> 
    

<!-- バリデーションエラーの表示に使用-->
@include('common.errors')
        
{{ csrf_field() }}

    <!--参加予定のイベント-->
    <div class="panel panel-default">
        <div class="slider_wrapper">
            <h4 class="recommend_event_title"><a href="#">YOU ARE GOING　</a></h4>
            <div class="slider">
                <!--@foreach ($all_events as $all_event)-->
                <!--    <div class="unit">-->
                <!--        <p>作成者: {{ $all_event->user->name }}</p>-->
                <!--        <h4> {{ $all_event->title }}</h4>-->
                <!--        <span>競技: {{  $all_event->subject  }}</span><br>-->
                <!--        <span>日程: {{   $all_event->date    }}</span><br>-->
                <!--        <span>場所: {{   $all_event->place   }}</span><br>-->
                <!--        <span>内容: {{   $all_event->body    }}</span><br>-->
                <!--        <span>      {{ $all_event->event_img }}</span>-->
                <!--    </div>-->
                <!--@endforeach-->
            </div>
        </div>
    </div>
    
    <!--参加部活のイベント-->
    <div class="panel panel-default">
        <div class="slider_wrapper">
            <h4 class="recommend_event_title"><a href="#">YOUR CLUB'S EVENT　</a></h4>
            <div class="slider">
                @foreach ($all_events as $all_event)
                    <div class="unit">
                        <p>作成者: {{ $all_event->user->name }}</p>
                        <h4> {{ $all_event->title }}</h4>
                        <span>競技: {{  $all_event->subject  }}</span><br>
                        <span>日程: {{   $all_event->date    }}</span><br>
                        <span>場所: {{   $all_event->place   }}</span><br>
                        <span>内容: {{   $all_event->body    }}</span><br>
                        <span>      {{ $all_event->event_img }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--SOCCER-->
    <!--TRIATHLON-->
    <!--JUDO-->
    <!--SEE MORE-->
    
    <!--おすすめイベント-->
    <div class="panel panel-default">
        <div class="slider_wrapper">
            <h4 class="recommend_event_title"><a href="#">RECOMMENDED EVENT　</a></h4>
            <div class="slider">
                @foreach ($all_events as $all_event)
                    <div class="unit">
                        <p>作成者: {{ $all_event->user->name }}</p>
                        <h4> {{ $all_event->title }}</h4>
                        <span>競技: {{  $all_event->subject  }}</span><br>
                        <span>日程: {{   $all_event->date    }}</span><br>
                        <span>場所: {{   $all_event->place   }}</span><br>
                        <span>内容: {{   $all_event->body    }}</span><br>
                        <span>      {{ $all_event->event_img }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    
    <!--友達立案のイベント-->
    <div class="panel panel-default">
        <div class="slider_wrapper">
            <h4 class="recommend_event_title"><a href="#">YOUR FRIEND'S EVENT　</a></h4>
            <div class="slider">
                @foreach ($all_events as $all_event)
                    <div class="unit">
                        <p>作成者: {{ $all_event->user->name }}</p>
                        <h4> {{ $all_event->title }}</h4>
                        <span>競技: {{  $all_event->subject  }}</span><br>
                        <span>日程: {{   $all_event->date    }}</span><br>
                        <span>場所: {{   $all_event->place   }}</span><br>
                        <span>内容: {{   $all_event->body    }}</span><br>
                        <span>      {{ $all_event->event_img }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <!--近隣開催のイベント-->
    <div class="panel panel-default">
        <div class="slider_wrapper">
            <h4 class="recommend_event_title"><a href="#">NEAR BY EVENT　</a></h4>
            <div class="slider">
                @foreach ($all_events as $all_event)
                    <div class="unit">
                        <p>作成者: {{ $all_event->user->name }}</p>
                        <h4> {{ $all_event->title }}</h4>
                        <span>競技: {{  $all_event->subject  }}</span><br>
                        <span>日程: {{   $all_event->date    }}</span><br>
                        <span>場所: {{   $all_event->place   }}</span><br>
                        <span>内容: {{   $all_event->body    }}</span><br>
                        <span>      {{ $all_event->event_img }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <!--オンラインイベント-->
    <div class="panel panel-default">
        <div class="slider_wrapper">
            <h4 class="recommend_event_title"><a href="#">ONLINE EVENT　</a></h4>
            <div class="slider">
                @foreach ($all_events as $all_event)
                    <div class="unit">
                        <p>作成者: {{ $all_event->user->name }}</p>
                        <h4> {{ $all_event->title }}</h4>
                        <span>競技: {{  $all_event->subject  }}</span><br>
                        <span>日程: {{   $all_event->date    }}</span><br>
                        <span>場所: {{   $all_event->place   }}</span><br>
                        <span>内容: {{   $all_event->body    }}</span><br>
                        <span>      {{ $all_event->event_img }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    
@endsection