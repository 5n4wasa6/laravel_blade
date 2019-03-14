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


<link href='{{asset("css/likedislikes.css")}}' rel="stylesheet" type="text/css">


@extends('layouts.app')
@section('content')
    
<div class="panel-body">
    @include('common.errors')
    
    
    <!--MyPageに戻る----------------->
    <a class="btn btn-link pull-right" href="{{ url('/comment') }}">
        <i class="glyphicon glyphicon-backward"></i>  Back
    </a>
    <!--MyPageに戻る----------------->
    <br>
    
    
    <form action="{{ url('oneword') }}" method="POST">
        {{ csrf_field() }}
        
        <h4 class="oneeord_title">一言コメント</h4>
        <div class="oneword_wrapper">
            <div>
                <input type="text" name="oneword" id="oneword" value="{{ old('oneword') }}" placeholder=" 一言コメント (15文字以内)">
            </div>
            <!-- 登録ボタン -->
            <div>
                <button type="submit" class="btn btn-default">
                    <i class="glyphicon glyphicon-plus"></i>
                </button>
            </div>
        </div>
    </form>
                
                
                
    
    
    <!--好き/嫌いリスト------------------------------------------------------------------------------------------------------------>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#A" data-toggle="tab">好き</a></li>
        <li><a href="#B" data-toggle="tab">嫌い</a></li>
    </ul>
    
    <div class="tabbable">
        <div class="tab-content">
            <!--好き----------------------------------------------------------->
            <div class="tab-pane active" id="A">
                <form enctype="multipart/form-data" action="{{ url('likes') }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="likedislike_wrapper">
                        <div class="likelike">
                            <input type="text" name="like" id="like" class="form-control" value="{{ old('like') }}" placeholder="Input your Like">
                        </div>
                        <!-- 登録ボタン -->
                        <div class="like_btn">
                            <button type="submit" class="btn btn-default">
                                <i class="glyphicon glyphicon-plus"></i>
                            </button>
                        </div>
                    </div>
                </form>
                
                @if (count($likes) > 0)
                    <div class="panel panel-default">
                        <div class="panel-heading">好き</div>
                        <div class="panel-body">
                        <table class="table table-striped task-table">
                            <tbody>
                                @foreach ($likes as $like)
                                    <tr>
                                        <td class="table-text">
                                            <div>{{ $like->like }}</div>
                                        </td>
                                        <!-- 削除ボタン -->
                                        <td>
                                            <form action="{{ url('likes/'.$like->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger"> <i class="glyphicon glyphicon-trash"></i> </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                @endif
            </div>    
            <!--好き END------------------------------------------------------->
            
            <!--嫌い----------------------------------------------------------->
            <div class="tab-pane" id="B">
                <form enctype="multipart/form-data" action="{{ url('dislikes') }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    
                    <div class="likedislike_wrapper">
                        <div  class="likelike">
                            <input type="text" name="dislike" id="dislike"class="form-control" value="{{ old('dislike') }}" placeholder="Input your Disike">
                        </div>
                        <div class="like_btn">
                            <button type="submit" class="btn btn-default">
                                <i class="glyphicon glyphicon-plus"></i>
                            </button>
                        </div>
                    </div>
                </form>
                
                <!--Dislikeの表示を追加していく処理-->
                @if (count($dislikes) > 0)
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
                            嫌い
                        </div>
                        <div class="panel-body">
                        <table class="table table-striped task-table">
                            <tbody>
                                 @foreach ($dislikes as $dislike)
                                    <tr>
                                        <!-- タイトル  ------------------------------------>
                                        <td class="table-text">
                                            <div>{{ $dislike->dislike }}</div>
                                        </td>
                                        <!-- タイトル  END--------------------------------->
                                        
                                        <!-- Dislike: 削除ボタン -->
                                        <td>
                                            <form action="{{ url('dislikes/'.$dislike->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
            
                                                <button type="submit" class="btn btn-danger"> <i class="glyphicon glyphicon-trash"></i> 
                                                    <!--削除-->
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                 @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                @endif
            </div>
            <!--嫌い END------------------------------------------------------->
         </div>
    </div>
    <!--好き/嫌いリスト END-------------------------------------------------------------------------------------------------------->
    
    
    


</div>
    
    
@endsection





