@extends('layouts.app')
@section('content')

@include('common.errors')
    
    <!--DISCUSSIONスレ編集 -------------------------------------------------------------------------->
    <form action="{{ url('dance_discussion_update') }}" method="GET">
        <div>
            <!-- title ---->
            <!--<div>-->
            <!--    <label>Title</label>-->
            <!--    <div>-->
            <!--        <textarea type="text" id="title" name="title">{{$all->title}}</textarea>-->
            <!--    </div>-->
            <!--</div>-->
            <!-- POST ----->
            <div>
                <label>投稿内容</label>
                <div>
                    <textarea id="body" name="body"   class="form-control">{{$all->body}}</textarea>
                </div>
            </div>
            <!-- Save/Backボタン ---->
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-link pull-right" href="{{ url('/dance') }}">
                    <i class="glyphicon glyphicon-backward"></i>  Back
                </a>
            </div>
            
            <!-- id値を送信 -->
            <input type="hidden" name="id" value="{{$all->id}}" />
            {{ csrf_field() }}
        </div> 
    </form>
    <!--DISCUSSIONスレ編集 -------------------------------------------------------------------------->

    
@endsection