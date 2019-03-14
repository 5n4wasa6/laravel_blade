<!-- Bootstrap ------------------------------------>
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


<link href='{{asset("css/committerm.css")}}' rel="stylesheet" type="text/css">

@extends('layouts.app')
@section('content')
    
<div class="panel-body">
    @include('common.errors')
    
    
    <!--MyPageに戻る--------------------->
    <a class="btn btn-link pull-right" href="{{ url('/comment') }}">
        <i class="glyphicon glyphicon-backward"></i>  Back
    </a>
    <!--MyPageに戻る END----------------->
    <br>
    
    <!-- COMMITMENT登録 ------------------------------------------------------------------------------------------>
    <div class="commit_wrapper">
        <h4 class="commit_text">コミットする</h4>
    </div>
    <!-- COMMITMENT登録  END-------------------------------------------------------------------------------------->
    
    
    <!--COMMITMENT表示-------------------------------------------------------------------------------------------->
    <!-- タブ -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#A" data-toggle="tab">長期</a></li>
        <li><a href="#B" data-toggle="tab">中期</a></li>
        <li><a href="#C" data-toggle="tab">短期</a></li>
    </ul>
    
    <div class="tabbable">
        <div class="tab-content">
            <!--長期------------------------------->
            <div class="tab-pane active" id="A">
                <div class="panel panel-default">
                    
                    <!--入力フォーム-->
                    <form action="{{ url('comments') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="commit_wrapper">
                            <div class="commit_input">
                                <input type="text"   name="comment" id="comment" value="{{ old('comment') }}" placeholder=" 5年以上先の目標を入力">
                                <input type="date" name="commit_at" value="{{ old('commit_at') }}"/>
                                <input type="hidden" name="term" id="term" value="1">
                                
                                <!-- 登録ボタン -->
                                <div class="commit_btn">
                                    <button type="submit" class="btn btn-default">
                                        <i class="glyphicon glyphicon-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                
                    @if (count($comments) > 0)
                        <div class="panel-body">
                        <table class="table table-striped task-table">
                            <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    @if ($comment->term == 1)
                                        
                                        <td class="commit_list">
                                            {{ $comment->created_at->format('Y/n/j') }}：
                                            {{ $comment->comment }} <br>
                                            (達成日:{{ $comment->commit_at->format('Y/n/j') }})　
                                        </td>
                                        
                                        <td>
                                            <a href="{{ action('IntroductionsController@edit',$comment) }}">
                                                <button type="button" class="btn btn-primary">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                </button>
                                            </a>
                                            <form action="{{ url('comments/'.$comment->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger"> <i class="glyphicon glyphicon-trash"></i> </button>
                                            </form>
                                        </td>
                                        <!--</div>-->
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    @endif
                </div>
            </div>
            <!--中期------------------------------------->
            <div class="tab-pane" id="B">
                <div class="panel panel-default">
                    
                    <!--入力フォーム-->
                    <form action="{{ url('comments') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="commit_wrapper">
                            <div class="commit_input">
                                <input type="text"   name="comment" id="comment" value="{{ old('comment') }}" placeholder=" 2年~5年以内の目標を入力">
                                <input type="date" name="commit_at" value="{{ old('commit_at') }}"/>
                                <input type="hidden" name="term" id="term" value="2">
                                
                                <!-- 登録ボタン -->
                                <div class="commit_btn">
                                    <button type="submit" class="btn btn-default">
                                        <i class="glyphicon glyphicon-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    @if (count($comments) > 0)
                        <div class="panel-body">
                        <table class="table table-striped task-table">
                            <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    @if ($comment->term == 2)
                                        <td class="commit_list">
                                            {{ $comment->created_at->format('Y/n/j') }}：
                                            {{ $comment->comment }} <br>
                                            (達成日:{{ $comment->commit_at->format('Y/n/j') }})　
                                        </td>
                                        
                                        <td>
                                            <a href="{{ action('IntroductionsController@edit',$comment) }}">
                                                <button type="button" class="btn btn-primary">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                </button>
                                            </a>
                                            <form action="{{ url('comments/'.$comment->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger"> <i class="glyphicon glyphicon-trash"></i> </button>
                                            </form>
                                        </td>
                                        <!--</div>-->
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    @endif
                </div>
            </div>
            <!--短期------------------------------->
            <div class="tab-pane" id="C">
                <div class="panel panel-default">
                    
                    <!--入力フォーム-->
                    <form action="{{ url('comments') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="commit_wrapper">
                            <div class="commit_input">
                                <input type="text"   name="comment" id="comment" value="{{ old('comment') }}" placeholder=" 2年以内の目標を入力">
                                <input type="date" name="commit_at" value="{{ old('commit_at') }}"/>
                                <input type="hidden" name="term" id="term" value="3">
                                
                                <!-- 登録ボタン -->
                                <div class="commit_btn">
                                    <button type="submit" class="btn btn-default">
                                        <i class="glyphicon glyphicon-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    @if (count($comments) > 0)
                        <div class="panel-body">
                        <table class="table table-striped task-table">
                            <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    @if ($comment->term == 3)
                                        <td class="commit_list">
                                            {{ $comment->created_at->format('Y/n/j') }}：
                                            {{ $comment->comment }} <br>
                                            (達成日:{{ $comment->commit_at->format('Y/n/j') }})　
                                        </td>
                                        
                                        <td>
                                            <a href="{{ action('IntroductionsController@edit',$comment) }}">
                                                <button type="button" class="btn btn-primary">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                </button>
                                            </a>
                                            <form action="{{ url('comments/'.$comment->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger"> <i class="glyphicon glyphicon-trash"></i> </button>
                                            </form>
                                        </td>
                                        <!--</div>-->
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
    <!--COMMITMENT表示 END----------------------------------------------------------------------------------------->

    
</div>
    
    
@endsection





