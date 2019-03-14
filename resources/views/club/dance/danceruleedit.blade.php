@extends('layouts.app')
@section('content')

@include('common.errors')

<div class="panel-body">

    <form enctype="multipart/form-data" action="{{ url('dance_rule_update') }}" method="GET">
        <div>
            <!-- RULE --->
            <div>
                <label>Rule</label>
                <div>
                    <textarea type="text" id="rule" name="rule">{{$rule->rule}}</textarea>
                </div>
            </div>
            <!-- Save/Backボタン ---->
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-link pull-right" href="{{ url('/dance_rule') }}">
                    <i class="glyphicon glyphicon-backward"></i>  Back
                </a>
            </div>
            
            <!-- id値を送信 -->
            <input type="hidden" name="id" value="{{$rule->id}}" />
            {{ csrf_field() }}
        </div> 
    </form>

</div>    

    
@endsection