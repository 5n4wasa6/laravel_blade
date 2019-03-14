@extends('layouts.app')
@section('content')


<link href='{{asset("css/goalsedit.css")}}' rel="stylesheet" type="text/css">

<div class="row">
    <div class="col-md-12">
    @include('common.errors')
    
        <form enctype="multipart/form-data" action="{{ url('goalsedit') }}" method="POST" id="task-manager" class="container-fluid">
          <div class="row content">
            
            <!-- company_name ------->
            <!--<div class="col-sm-7">-->
            <!--    <label for="company_name">社名 or PJ名</label>-->
            <!--    <div class="row task-view ocean">-->
            <!--        <textarea type="text" id="company_name" name="company_name" class="form-control" rows="1">{{$goal->company_name}}</textarea>-->
            <!--    </div>-->
            <!--</div>-->
            
            <!-- name---->
            <!--<div class="col-sm-5">-->
            <!--    <label for="item_name">CEO</label>-->
            <!--    <div class="row task-view ocean">-->
            <!--        <textarea type="text" class="form-control" rows="1">{{ Auth::user()->name }}</textarea>-->
            <!--    </div>-->
            <!--</div>-->
            
            <!-- priority ------>
            <!--<div class="col-sm-1">-->
            <!--    <label for="priority">Priority</label>-->
            <!--    <div class="row task-view">-->
            <!--        <select id="priority" name="priority" class="form-control">-->
            <!--            <option value="高" @if(old('priority')=='高') selected  @endif>高</option>-->
            <!--            <option value="中" @if(old('priority')=='中') selected  @endif>中</option>-->
            <!--            <option value="低" @if(old('priority')=='低') selected  @endif>低</option>-->
            <!--        </select>-->
            <!--    </div>-->
            <!--</div>-->
            <!-- priority END----->
            
            <!-- goal -------->
            <div class="col-sm-6">
                <label for="goal">目標/夢</label>
                <div class="row task-view ocean">
                    <textarea type="text" id="goal" name="goal" class="form-control" rows="1">{{$goal->goal}}</textarea>
                </div>
            </div>
            <!-- commit_at --->
            <div class="col-sm-6">
                <label for="commit_at">達成日</label>
                <div class="row task-view ocean">
                    <textarea type="datetime" id="commit_at" name="commit_at" class="form-control" rows="1">{{$goal->commit_at}}</textarea>
                </div>
            </div>
            <!-- why --------->
            <div class="col-sm-4">
                <label for="why">なぜ？</label>
                <div class="row task-view ocean">
                    <textarea id="why" name="why"  class="form-control" rows="6">{{$goal->why}}</textarea>
                </div>
            </div>
            <!-- how --------->
            <div class="col-sm-4">
                <label for="how">どのようにして？</label>
                <div class="row task-view ocean">
                    <textarea id="how" name="how" id="how" name="how"  class="form-control" rows="6">{{$goal->how}}</textarea>
                </div>
            </div>
            <!-- what -------->
            <div class="col-sm-4">
                <label for="what">具体的に何をする?</label>
                <div class="row task-view ocean">
                    <textarea id="what" name="what" id="what" name="what"  class="form-control" rows="6">{{$goal->what}}</textarea>
                </div>
            </div>
            
            <!-- schedule ----->
            <!--<div class="col-sm-6">-->
            <!--    <label for="schedule">SCHEDULE</label>-->
            <!--    <div class="row task-view xyz">-->
            <!--        <textarea id="schedule" name="schedule" id="schedule" name="schedule"  class="form-control" rows="2">{{$goal->schedule}}</textarea>-->
            <!--    </div>-->
            <!--</div>-->
            
            <!-- nextaction --->
            <!--<div class="col-sm-6">-->
            <!--    <label for="nextaction">NEXTACTION</label>-->
            <!--    <div class="row task-view zzz">-->
            <!--        <textarea id="nextaction" name="nextaction" id="nextaction" name="nextaction"  class="form-control" rows="2">{{$goal->nextaction}}</textarea>-->
            <!--    </div>-->
            <!--</div>-->
            
            <!-- goal_img ----->
             <div class="col-sm-12">
                <label for="goal_img" control-label>画像/ファイル</label>
                <input type="file" name="goal_img" id="goal_img" accept="image/*" value="{{ $goal->goal_img }}"/>
            </div>
            
            <!-- Schedule ----->
            <!--<p>SCHEDULE</p>-->
            <!--<div class="Grid">-->
            <!--    <div class="s">1</div><div class="s">2</div><div class="s">3</div><div class="s">4</div><div class="s">5</div><div class="s">6</div><div class="s">7</div>-->
            <!--    <div class="s">8</div><div class="s">9</div><div class="s">10</div><div class="s">11</div><div class="s">12</div><div class="s">13</div>-->
            <!--    <div class="s">14</div><div class="s">15</div><div class="s">16</div><div class="s">17</div><div class="s">18</div><div class="s">19</div>-->
            <!--    <div class="s">20</div><div class="s">21</div><div class="s">22</div><div class="s">23</div><div class="s">24</div><div class="s">25</div>-->
            <!--    <div class="s">26</div><div class="s">27</div><div class="s">28</div><div class="s">29</div><div class="s">30</div><div class="s">31</div>-->
            <!--</div>-->
            
            <!-- Saveボタン/Backボタン --------->
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-link pull-right" href="{{ url('/comment') }}">
                    <i class="glyphicon glyphicon-backward"></i>  Back
                </a>
            </div>
            <!-- Saveボタン/Backボタン END----->
            
             <!-- id値を送信 -->
             <input type="hidden" name="id" value="{{$goal->id}}" />
             {{ csrf_field() }}
          </div> 
        </form>
    </div>
</div>

    <!-- Scheduleボタン -->
    <!--<div id="app">-->
    <!--    <button @click="onClick">+</button>-->
    <!--    <svg class="resize-drag" width="450px" height="500px" viewBox="0 0 100 100">-->
    <!--        <rect v-for="(abc, i) in abcs" :key="i" x="10" :y="abc" width="40" height="5" style="fill:#29e; stroke: #29e;"/> -->
    <!--    </svg>-->
    <!--</div>-->
    
    
    <!--チャット -------------------------------------------------------------------------->
    <!--<div id="chat">-->
    <!--    <div class="chat_wrapper">-->
    <!--        <textarea v-model="message"></textarea>-->
    <!--        <br>-->
    <!--        <div class="chat_btn">-->
    <!--            <button type="button" @click="send()">送信</button>-->
    <!--        </div>-->
    <!--    </div>-->

    <!--    <p>@{{ message }}</p>-->
        
    <!--    <div v-for="m in messages">-->
    <!--        <span v-text="m.created_at"></span>：&nbsp;-->
    <!--        <span v-text="m.body"></span>-->
    <!--    </div>-->
    <!--</div>-->
    <!--チャット END----------------------------------------------------------------------->
      
    
    <!--チャット用 ------------------>
    <!--<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>-->
    <!--<script src="{{ asset('js/chat.js') }}"></script>-->
    
    
    <!--スケジュール用 -----------------------------> 
    <!--<script src="{{ asset('js/edit.js') }}"></script>-->

@endsection