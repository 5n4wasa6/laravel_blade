@extends('layouts.app')
@section('content')

@include('common.errors')


<div class="panel-body">
    <form action="{{ url('commentsedit') }}" method="POST">
        <div>
            <div class="form-group">
                <label for="comment">Subject</label>
                <input type="text" id="comment" name="comment" class="form-control" value="{{$comment->comment}}"/>
            </div>
            
            <!-- Save/Backボタン -->
            <div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-link pull-right" href="{{ url('/term') }}">
                    <i class="glyphicon glyphicon-backward"></i>  Back
                </a>
            </div>
    
             <!-- id値を送信 -->
             <input type="hidden" name="id" value="{{$comment->id}}" />
             {{ csrf_field() }}
        </div>
    </form>
</div>


@endsection