@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
    @include('common.errors')
    
    <form enctype="multipart/form-data" action="{{ url('activitiesedit') }}" method="POST">
        <!-- Activityのタイトル--------------------------------------------------------------------------->
            <div class="form-group">
                <!-- タイトル--------------------->
                <div class="col-sm-6">
                    <label for="activity">タイトル</label>
                    <input type="text" name="title" id="title"class="form-control" value="{{$title->act_title}}"/>
                    @if ($errors->has('title'))
                    <span class="error">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <!-- 活動日 -------------------->
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="activity_at">日付</label>
                        <input type="text" id="activity_at" name="activity_at" class="form-control" value="{{$title->activity_at}}"/>
                    </div>
                </div>
                <!-- 種目------------------------>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="subject">種目</label>
                        <input type="text" id="subject" name="subject" class="form-control" value="{{$title->language}}"/>
                    </div>
                </div>
                
                <!-- アピール--------------------->
                <div class="col-sm-6">
                    <label for="appeal">アピールポイント</label>
                    <input type="text" name="appeal" id="appeal"class="form-control" value="{{$title->appeal}}"/>
                </div>
                <!-- ネクストアクション--------------------->
                <div class="col-sm-6">
                    <label for="nextaction">ネクストアクション</label>
                    <input type="text" name="nextaction" id="nextaction"class="form-control" value="{{$title->nextaction}}"/>
                </div>
                <!-- フリー--------------------->
                <div class="col-sm-12">
                    <label for="free">自由欄</label>
                    <input type="text" name="free" id="free"class="form-control" value="{{$title->free}}"/>
                </div>
                 <!--画像--------------------->
                <div class="col-sm-12">
                    <label for="activity_img">画像</label>
                    <input type="file" name="activity_img" id="activity_img" value="{{$title->activity_img}}">
                </div>
            </div>
        
        <!-- Saveボタン/Backボタン -->
        <div class="well well-sm">
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-link pull-right" href="{{ url('/comment') }}">
                <i class="glyphicon glyphicon-backward"></i>  Back
            </a>
        </div>
        
         <!-- id値を送信 -->
         <input type="hidden" name="id" value="{{$title->id}}" />
         <!-- CSRF -->
         {{ csrf_field() }}
         
    </form>
    </div>
</div>
@endsection