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
<link href="{{ asset('css/index.css') }}" rel="stylesheet">


@extends('layouts.app')
@section('content')

@include('common.errors')

<!-- Backボタン ---->
<a class="btn btn-link pull-right" href="{{ url('/') }}">
    <i class="glyphicon glyphicon-backward"></i>  Back
</a>
<!-- Backボタン ---->
<br>
<br>


<div class="panel-body">
    <!--ディスカッション ----------------------------------------------------------------------------------------->
    <div class="well discussion_wrapper">
        @foreach ($discussions as $discuss) 
            @if ($today == $discuss->created_at)
                <h4><a href="{{ action('DiscussionsController@all_discussion') }}" class="discussion_text">ディスカッション　</a></h4>
                <div class="thema"><h5 class="thema_text">〜本日のテーマ〜</h5></div>
                <div><h4 class="discussion_title_text"> {{ $discuss->title }}</h4></div>

                <div class="form-group discussion_comment">
                    
                     @if ( $discussion_sum )
                        <a href="{{ action('DiscussionsController@all_comment') }}">コメント{{ $discussion_sum }}件</a>
                    @endif
                    
                    <form method="get" action="{{ route('comment.add') }}">
                        {{ csrf_field() }}
                    
                        <div class="form-group">
                            <input type="text" name="comment" class="form-control" placeholder="Add a comment.." />
                            <input type="hidden" name="post_id" value="{{ $discuss->id }}" />
                        </div>
                        
                        
                        <!--<div class="form-group">-->
                        <!--    <input type="submit" class="btn btn-warning" value="Add Comment" />-->
                        <!--</div>-->
                    </form>
                    
                    
                    <h4>Comment</h4>
                    @include('partials._comment_replies2', ['comments' => $discussion_id->comments, 'post_id' => $discussion_id->id])
                    
                </div>
            @endif
        @endforeach
        
        <!--<div class="see_more">-->
        <!--    @if ( $discussion_sum > 15 )-->
        <!--        <a href="{{ action('DiscussionsController@all_comment') }}">もっとみる</a>-->
        <!--    @endif-->
        <!--</div>-->
    </div>
    <!--ディスカッション END-------------------------------------------------------------------------------------->
</div>  
    
@endsection




