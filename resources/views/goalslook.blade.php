@extends('layouts.app')
@section('content')


<link href='{{asset("css/edit2.css")}}' rel="stylesheet" type="text/css">

<div class="row">
    <div class="col-md-12">
    @include('common.errors')
    
    <form enctype="multipart/form-data" action="{{ url('goalsedit') }}" method="POST" id="task-manager" class="container-fluid">
      <div class="row content">
        
        <!-- company_name ----------------------------------------------------->
        <!--<div class="col-sm-7">-->
        <!--    <label for="company_name">社名 or PJ名</label>-->
        <!--    <div class="row task-view ocean">-->
        <!--        <p type="text" id="company_name" name="company_name" rows="1">{{$goal->company_name}}</p>-->
        <!--    </div>-->
        <!--</div>-->
        <!-- company_name END-------------------------------------------------->
        
        <!-- nameCEO ---------------------------------------------------------->       
        <!--<div class="col-sm-5">-->
        <!--    <label for="item_name">CEO</label>-->
        <!--    <div class="row task-view ocean">-->
        <!--        <p type="text" rows="1">{{ Auth::user()->name }} 社長</p>-->
        <!--    </div>-->
        <!--</div>-->
        <!-- nameCEO END ------------------------------------------------------> 
        
        <!-- priority --------------------------------------------------------->
        <!--<div class="col-sm-1">-->
        <!--    <label for="priority">CEO</label>-->
        <!--    <div class="row task-view">-->
        <!--        <select id="priority" name="priority" class="form-control">-->
        <!--            <option value="高">高</option>-->
        <!--            <option value="中">中</option>-->
        <!--            <option value="低">低</option>-->
        <!--        </select>-->
        <!--    </div>-->
        <!--</div>-->
        <!-- priority END------------------------------------------------------>        
        
        <!-- goal ------------------------------------------------------------->
        <div class="col-sm-6">
            <label for="goal">Goal</label>
            <div class="row task-view ocean">
                <p type="text" id="goal" name="goal" rows="1">{{$goal->goal}}</p>
            </div>
        </div>
        <!-- goal END---------------------------------------------------------->
        
        <!-- commit_at -------------------------------------------------------->
        <div class="col-sm-6">
            <label for="commit_at">COMMIT_DATE</label>
            <div class="row task-view ocean">
                <p type="datetime" id="commit_at" name="commit_at" rows="1">{{$goal->commit_at}}</p>
            </div>
        </div>
        <!-- commit_at END----------------------------------------------------->
        
        <!-- why -------------------------------------------------------------->
        <div class="col-sm-4">
        <label for="why">Why</label>
        
            <div class="row task-view darkorchid">
                <p id="why" name="why" rows="6">{{$goal->why}}</p>
            </div>
        </div>
        <!-- why END----------------------------------------------------------->
        
        <!-- how -------------------------------------------------------------->
        <div class="col-sm-4">
        <label for="how">How</label>
            <div class="row task-view green">
                <p id="how" name="how" id="how" name="how" rows="6">{{$goal->how}}</p>
            </div>
        </div>
        <!-- how END----------------------------------------------------------->
        
        <!-- what ------------------------------------------------------------->
        <div class="col-sm-4">
        <label for="what">WHAT</label>
            <div class="row task-view red">
                <p id="what" name="what" id="what" name="what" rows="6">{{$goal->what}}</p>
            </div>
        </div>
        <!-- target ----------------------------------------------------------->
        <!--<div class="col-sm-4">-->
        <!--<label for="target">TARGET</label>-->
        <!--    <div class="row task-view abc">-->
        <!--        <p id="target" name="target" id="target" name="target" rows="6">{{$goal->target}}</p>-->
        <!--    </div>-->
        <!--</div>-->
        <!-- target END-------------------------------------------------------->
        
        <!-- market ----------------------------------------------------------->
        <!--<div class="col-sm-4">-->
        <!--<label for="market">MARKET</label>-->
        <!--    <div class="row task-view aaa">-->
        <!--        <p id="market" name="market" id="market" name="market" rows="6">{{$goal->market}}</p>-->
        <!--    </div>-->
        <!--</div>-->
        <!-- market END-------------------------------------------------------->
        
        <!-- competitor ------------------------------------------------------->
        <!--<div class="col-sm-4">-->
        <!--<label for="competitor">COMPETITOR</label>-->
        <!--    <div class="row task-view aaaa">-->
        <!--        <p id="competitor" name="competitor" id="competitor" name="competitor" rows="6">{{$goal->competitor}}</p>-->
        <!--    </div>-->
        <!--</div>-->
        <!-- competitor END---------------------------------------------------->
        
        <!-- schedule --------------------------------------------------------->
        <!--<div class="col-sm-6">-->
        <!--<label for="schedule">SCHEDULE</label>-->
        <!--    <div class="row task-view xyz">-->
        <!--        <p id="schedule" name="schedule" id="schedule" name="schedule" rows="6">{{$goal->schedule}}</p>-->
        <!--    </div>-->
        <!--</div>-->
        <!-- schedule END------------------------------------------------------>
        
        <!-- nextaction ------------------------------------------------------->
        <div class="col-sm-6">
        <label for="nextaction">NEXTACTION</label>
            <div class="row task-view zzz">
                <p id="nextaction" name="nextaction" id="nextaction" name="nextaction" rows="6">{{$goal->nextaction}}</p>
            </div>
        </div>
        <!-- nextaction END---------------------------------------------------->
        
        <!-- goal_img --------------------------------------------------------->
        <!--<div class="col-sm-12">-->
        <!--    <label for="goal_img" control-label>Image</label>-->
        <!--    <img src="{{ $goal->goal_img }}"/>-->
        <!--</div>-->
        <!-- goal_img END------------------------------------------------------>
        
        <!-- Schedule --------------------------------------------------------->
        <!--<p>SCHEDULE</p>-->
        <!--<div class="Grid">-->
        <!--    <div class="s">1</div><div class="s">2</div><div class="s">3</div><div class="s">4</div><div class="s">5</div><div class="s">6</div><div class="s">7</div>-->
        <!--    <div class="s">8</div><div class="s">9</div><div class="s">10</div><div class="s">11</div><div class="s">12</div><div class="s">13</div>-->
        <!--    <div class="s">14</div><div class="s">15</div><div class="s">16</div><div class="s">17</div><div class="s">18</div><div class="s">19</div>-->
        <!--    <div class="s">20</div><div class="s">21</div><div class="s">22</div><div class="s">23</div><div class="s">24</div><div class="s">25</div>-->
        <!--    <div class="s">26</div><div class="s">27</div><div class="s">28</div><div class="s">29</div><div class="s">30</div><div class="s">31</div>-->
        <!--</div>-->
        <!-- Schedule END------------------------------------------------------>
        
        <!-- Saveボタン/Backボタン -------------------------------------------->
        <div class="well well-sm">
            <a class="btn btn-link pull-right" href="{{ url('/') }}">
                <i class="glyphicon glyphicon-backward"></i>  Back
            </a>
        </div>
        <!-- Saveボタン/Backボタン END----------------------------------------->
        
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
    <!--    <p v-model="message"></p>-->
    <!--    <br>-->
    <!--    <button type="button" @click="send()">送信</button>-->
    <!--    <p>@{{ message }}</p>-->
        
    <!--    <div v-for="m in messages">-->
    <!--        <span v-text="m.created_at"></span>：&nbsp;-->
    <!--        <span v-text="m.body"></span>-->
    <!--    </div>-->
    <!--</div>-->
    <!--チャット END----------------------------------------------------------------------->
    

@endsection