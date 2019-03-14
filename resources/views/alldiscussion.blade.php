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
    @foreach ($discussions as $discussion)
        <div class="panel panel-default">
            <!--<form action="{{ url('discussion') }}" method="POST" role="form">-->
                {{ csrf_field() }}
                
                <a href="{{ action('DiscussionsController@all_comment') }}">
                    <div class="thema">
                        <h5 class="thema_text">{{ $discussion->created_at->format('Y/m/d') }}</h5>
                    </div>
                    
                    <div>
                        <h4 class="discussion_title_text"> {{ $discussion->title }}</h4>
                    </div>
                </a>
                
                <!--<div class="form-group discussion_comment">-->
                <!--    <input type="hidden" name="post_id" value="{{ $discussion->id }}"/>-->
                <!--    <input type="text"   name="comment" class="form-control" placeholder="コメントを追加"/>-->
                <!--    <button type="submit" class="btn btn-primary pull-right">投稿</button>-->
                <!--</div>-->
        	<!--</form>-->
        </div>
    @endforeach
    <!--ディスカッション END-------------------------------------------------------------------------------------->
</div>    

@endsection




