@extends('layouts.app')
@section('content')

@include('common.errors')

<link href='{{asset("css/edit2.css")}}' rel="stylesheet" type="text/css">


<!-- Backボタン ---->
<div>
    <a class="btn btn-link pull-right" href="{{ url('/') }}">
        <i class="glyphicon glyphicon-backward"></i>  Back
    </a>
</div>
<!-- Backボタン ---->
<br>
<br>


<div class="panel-body">
    <form enctype="multipart/form-data" action="{{ url('goalsedit') }}" method="POST" id="task-manager" class="container-fluid">
        <div class="row content">
            <!-- title -------->
            <div>
                <label for="goal">タイトル</label>
                <div class="row task-view ocean">
                    <p type="text" id="act_title" name="act_title" rows="1">{{$title->act_title}}</p>
                </div>
            </div>
            <!-- activity_at -------->
            <div>
                <label for="activity_at">日時</label>
                <div class="row task-view ocean">
                    <p type="datetime" id="activity_at" name="activity_at" rows="1">{{$title->activity_at}}</p>
                </div>
            </div>
            <!-- language -------->
            <div>
                <label for="language">競技</label>
                <div class="row task-view ocean">
                    <p type="datetime" id="language" name="language" rows="1">{{$title->language}}</p>
                </div>
            </div>
            <!-- appeal -------->
            <div>
                <label for="goal">Goal</label>
                <div class="row task-view ocean">
                    <p type="text" id="appeal" name="appeal" rows="1">{{$title->appeal}}</p>
                </div>
            </div>
            <!-- free -------->
            <div>
                <label for="freegoal">FREE</label>
                <div class="row task-view ocean">
                    <p type="text" id="free" name="free" rows="1">{{$title->free}}</p>
                </div>
            </div>
            <!-- title END----->
            
            <!-- id値を送信 -->
            <input type="hidden" name="id" value="{{$title->id}}" />
            {{ csrf_field() }}
        </div> 
    </form>
    <br>
    
    <div>
        @foreach ($comments as $comment)
            <div class="comments">
                <div>{{ $comment->user->name }}:</div>
                <div>{{ $comment->activity_comment }}</div>
            </div>
        @endforeach
    </div>
</div>

@endsection