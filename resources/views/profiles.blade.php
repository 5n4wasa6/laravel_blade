
<link href='{{asset("css/profile.css")}}' rel="stylesheet" type="text/css">

@extends('layouts.app')
@section('content')
    
    
<!--MyPageに戻る--------------------->
<a class="btn btn-link pull-right" href="{{ url('/comment') }}">
    <i class="glyphicon glyphicon-backward"></i>  Back
</a>
<!--MyPageに戻る END----------------->
<br>


<div class="panel-body">
@include('common.errors')


    <!-- ICON登録 ---------------------------------------------------------------------------->
    <form enctype="multipart/form-data" action="{{ url('profiles') }}" method="POST">
        {{ csrf_field() }}
        <h4 class="icon_setting">アイコンを設定する</h4>
        <div class="icon_wrapper">
            <div>
                <input type="file" accept="image/*" name="comment_img" id="comment_img">
            </div>
            <!-- 登録ボタン -->
            <div>
                <button type="submit" class="btn btn-default">
                    <i class="glyphicon glyphicon-plus"></i>
                </button>
            </div>
            <!-- 登録ボタン -->
        </div>
    </form>
    <!-- ICON登録 END------------------------------------------------------------------------->
    
    
    <!--ICONリスト---------------------------------------------------------------------------->
    @if (count($profiles) > 0)
        <div class="panel panel-default">
            <div class="panel-heading"> 
                <h4 class="icon_text">アイコン</h4>
            </div>
            
            <!--▲横幅いっぱいまでは横並びにする-->
            <div class="panel-body">
                 @foreach ($profiles as $profile)
                     <div class="icon_img_wrapper">
                        <!-- コメント --->
                        <img src="upload/{{ $profile->comment_img }}" class="icon_img">
                       
                        <!-- 削除ボタン --->
                        <form action="{{ url('profiles/'.$profile->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger"> <i class="glyphicon glyphicon-trash"></i></button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    <!--ICONリスト END------------------------------------------------------------------------>
    
    
@endsection





