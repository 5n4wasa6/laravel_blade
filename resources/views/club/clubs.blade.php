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



@extends('layouts.app')
@section('content')
    
<link href="{{ asset('css/subject.css') }}" rel="stylesheet"> 

@include('common.errors')
        
    {{ csrf_field() }}

    <p><a href="{{ action('Club\TriathlonController@triathlon') }}">TRIATHLON</a></p>
    <p><a href="{{ action('Club\FencingController@fencing') }}">FENCING</a></p>
    <p><a href="{{ action('Club\DanceController@dance') }}">DANCE</a></p>
    <p><a href="{{ action('Club\SoccerController@soccer') }}">SOCCER</a></p>
    <p><a href="{{ action('Club\JudoController@judo') }}">JUDO</a></p>
    <p><a href="{{ action('Club\BudmintonController@budminton') }}">BUDMINTON</a></p>
    <p><a href="{{ action('Club\TableTennisController@tabletennis') }}">TABLE TENNIS</a></p>
    <p><a href="{{ action('Club\TennisController@tennis') }}">TENNIS</a></p>
    <p><a href="{{ action('Club\RugbyController@rugby') }}">RUGBY</a></p>
    <p><a href="{{ action('Club\JapaneseChessController@japanesechess') }}">JAPANESE CHESS</a></p>
    <p><a href="{{ action('Club\MajanController@majan') }}">MAJAN</a></p>
    
    <p style="text-align:right">新しい競技を申請する<button>+</button></p>
    
    <ul class="nav nav-tabs">
        <li class="active"><a href="#A" data-toggle="tab">My Club</a></li>
        <li><a href="#B" data-toggle="tab">All Club</a></li>
    </ul>
    
    <div class="tabbable">
        <div class="tab-content">
            <!--My Club-------------------------------------------------------------------------------->
            <div class="tab-pane active" id="A">
                <div class="well well-sm">
                    @foreach ($club_ids as $club_id)
                        @foreach ($subjects as $subject)
                            
                            @if ( $club_id->club_id == $subject->club_id )
                                <div class="clubs" >
                                    <!--<a href="{{ url('/fencing ') }}">-->
                                    <p>{{ $subject->subject }}</p>
                                    <button>-</button>
                                </div>
                            @endif
            
                        @endforeach
                    @endforeach
                </div>
            </div>
            
            <!--All Club END----------------------------------------------------------------------------->
            <div class="tab-pane" id="B">
                <div class="well well-sm">
                    @foreach ($subjects as $subject)  
                        
                        <!--ボタン押下後に、「ALL CLUBから消す処理」-->
                            <form action="{{ url('belongs') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="clubs">
                                    <p>{{ $subject->subject }}</p>
                                    <input type="hidden" name="club_id" value="{{ $subject->club_id }}">
                                    
                                    <button type="submit">+</button>
                                </div>
                            </form>
                    
                    @endforeach
                </div>
            </div>
            <!--All Club END---------------------------------------------------------------------------->
     </div>
</div>


@endsection

