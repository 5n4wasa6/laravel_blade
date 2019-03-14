@extends('layouts.app')
@section('content')

@include('common.errors')
    
    <form enctype="multipart/form-data" action="{{ url('fencing_event_update') }}" method="GET">
      <div>
        
        <!-- TITLE --------->
        <div>
            <label>Title</label>
            <textarea type="text" id="title" name="title">{{$all_event->title}}</textarea>
        </div>
        
        <!-- SUBJECT ------->
        <div>
            <label for="subject">Subject</label>
            <select id="subject" name="subject" value="{{ $all_event->body }}">
                <option value="Fencing">Fencing</option>
                <option value="Wheelchair Fencing">Wheelchair Fencing</option>
            </select>
        </div>
        
        <!-- DATE --------->
        <div>
            <label>Date</label>
            <textarea type="datetime" id="date" name="date">{{ $all_event->date }}</textarea>
        </div>
        
        <!-- PLACE ------->
        <div>
            <label>PLACE</label>
            <textarea type="text" id="place" name="place">{{ $all_event->place }}</textarea>
        </div>
          
        <!-- BODY ------->
        <div>
            <label>BODY</label>
            <textarea type="text" id="body" name="body">{{ $all_event->body }}</textarea>
        </div>
        
        <!-- IMAGE ----->
        <div>
            <label>IMAGE</label>
            <img src="upload/{{ $all_event->event_img }}" width="2vh">
            <!--<textarea type="file" id="event_img" name="event_img">{{ $all_event->event_img }}</textarea>-->
        </div>
            
        <!-- Save/Backボタン ----->
        <div class="well well-sm">
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-link pull-right" href="{{ url('/fencing_event') }}">
                <i class="glyphicon glyphicon-backward"></i>  Back
            </a>
        </div>
        
        <!-- id値を送信 -->
        <input type="hidden" name="id" value="{{$all_event->id}}" />
        {{ csrf_field() }}
        
      </div> 
    </form>

    
@endsection