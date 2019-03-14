
@extends('layouts.app')
@section('content')

@include('common.errors')
{{ csrf_field() }}

<!-- Bootstrap の定形コード... -->
<!-- Styles -->
<link href="{{ asset('css/activity.css') }}" rel="stylesheet">    


<div class="container" id="gauge">
    
    <div class="panel-body">
        
        <div class="well activity_wrapper"> 
            <form class="form-horizontal" role="form">
                <h4>活動を入力する</h4>
                <div class="form-group" style="padding:14px;">
                    
                    <!-- タイトル--------------------->
                    <div class="col-sm-6">
                        <label for="act_title">タイトル</label>
                        <input type="text" name="act_title" id="act_title"class="form-control" value="{{ old('act_title') }}" v-model="act_title">
                    </div>
                    <!-- 活動日 -------------------->
                    <div class="col-sm-4">
                            <label for="activity_at">日付</label>
                            <input type="date" id="activity_at" name="activity_at" class="form-control" value="{{ old('activity_at') }}"/>
                    </div>
                    <!-- 種目------------------------>
                    <div class="col-sm-2">
                        <label for="subject">種目</label>
                        <select id="subject" name="subject" class="form-control" v-model="subject_name">
                            <option value="SWIM">SWIM</option>
                            <option value="BIKE">BIKE</option>
                            <option value="RUN">RUN</option>
                        </select>
                    </div>
                    <!-- アピール--------------------->
                    <div class="col-sm-6">
                        <label for="appeal">アピールポイント</label>
                        <input type="text" name="appeal" id="appeal" class="form-control" value="{{ old('appeal') }}" v-model="appeal">
                    </div>
                    <!-- ネクストアクション--------------------->
                    <div class="col-sm-6">
                        <label for="nextaction">ネクストアクション</label>
                        <input type="text" name="nextaction" id="nextaction" class="form-control" value="{{ old('nextaction') }}" v-model="nextaction">
                    </div>
                    <!-- フリー--------------------->
                    <div class="col-sm-12">
                        <label for="free">フリー欄</label>
                        <textarea type="text" name="free" id="free" class="form-control" value="{{ old('free') }}"  v-model="free"></textarea>
                    </div>
                    <!-- 画像--------------------->
                    <div class="col-sm-12">
                        <label for="activity_img">Image</label>
                        <input type="file" accept="image/*" name="activity_img" id="activity_img" value="{{ old('activity_img') }}" v-model="activity_img">
                    </div>
                    
                </div>
                <button class="btn btn-primary pull-right" type="button" @click="start()">投稿</button>
                <ul class="list-inline">
                    <li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li>
                    <li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li>
                    <li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li>
                </ul>
            </form>
        </div>

    </div>
    
    
    <!--vue.jsにセッション経由でuser_idを渡す処理---------------->
    <input type="hidden" id="user_id" value="{{ $auths->id }}"/>
    
    <!--vue.jsにセッション経由でcoin数値を渡す処理-->
    @if ( $user_coins )
        <input type="hidden" id="coin_done"  value="{{ $user_coins->coin}}"/>
    @else
        <input type="hidden" id="coin_done"  value="100000"/>
    @endif
    
    
    <!--SWIM処理------------------------------------------->
    @if ( isset($swims["0"]) ) 
       @foreach ($swims as $swim)
            @if ($swim->user_id == $auths->id )
                <input type="hidden" id="progress_done1"    value="{{ $swim->exp }}"/>
                <input type="hidden" id="denominator_done1" value="{{ $swim->denominator }}"/>
                <input type="hidden" id="ttl_done1"         value="{{ $swim->ttl }}"/>
                <input type="hidden" id="level_done1"       value="{{ $swim->level }}"/>
            @else
                <input type="hidden" id="progress_done1"    value="0"/>
                <input type="hidden" id="denominator_done1" value="2"/>
                <input type="hidden" id="ttl_done1"         value="0"/>
                <input type="hidden" id="level_done1"       value="1"/>
            @endif
        @endforeach
    @else
        <input type="hidden" id="progress_done1"    value="0"/>
        <input type="hidden" id="denominator_done1" value="2"/>
        <input type="hidden" id="ttl_done1"         value="0"/>
        <input type="hidden" id="level_done1"       value="1"/>
    @endif
    <!--BIKE処理------------------------------------------->
    @if ( isset($bikes["0"]) ) 
        @foreach ($bikes as $bike)
            @if ($bike->user_id == $auths->id )
                <input type="hidden" id="progress_done2"    value="{{ $bike->exp}}"/>
                <input type="hidden" id="denominator_done2" value="{{ $bike->denominator }}"/>
                <input type="hidden" id="ttl_done2"         value="{{ $bike->ttl }}"/>
                <input type="hidden" id="level_done2"       value="{{ $bike->level }}"/>
            @else
                <input type="hidden" id="progress_done2"    value="0"/>
                <input type="hidden" id="denominator_done2" value="2"/>
                <input type="hidden" id="ttl_done2"         value="0"/>
                <input type="hidden" id="level_done2"       value="1"/>
            @endif
        @endforeach
    @else
        <input type="hidden" id="progress_done2"    value="0"/>
        <input type="hidden" id="denominator_done2" value="2"/>
        <input type="hidden" id="ttl_done2"         value="0"/>
        <input type="hidden" id="level_done2"       value="1"/>
    @endif
    <!--RUN処理------------------------------------------->
    @if ( isset($runs["0"]) ) 
        @foreach ($runs as $run)
            @if ($run->user_id == $auths->id )
                <input type="hidden" id="progress_done3"    value="{{ $run->exp }}"/>
                <input type="hidden" id="denominator_done3" value="{{ $run->denominator }}"/>
                <input type="hidden" id="ttl_done3"         value="{{ $run->ttl }}"/>
                <input type="hidden" id="level_done3"       value="{{ $run->level }}"/>
            @else
                <input type="hidden" id="progress_done3"    value="0"/>
                <input type="hidden" id="denominator_done3" value="2"/>
                <input type="hidden" id="ttl_done3"         value="0"/>
                <input type="hidden" id="level_done3"       value="1"/>
            @endif
        @endforeach
    @else
        <input type="hidden" id="progress_done3"    value="0"/>
        <input type="hidden" id="denominator_done3" value="2"/>
        <input type="hidden" id="ttl_done3"         value="0"/>
        <input type="hidden" id="level_done3"       value="1"/>
    @endif
</div>


<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script src="{{ asset('js/gauge.js') }}"></script>
<script>
// --vue.jsにセッション経由でuser_idを渡す処理----------------
    const userId = document.getElementById("user_id").value;
    window.sessionStorage.setItem("user_id", userId);
    
    
   
    const coinDone = document.getElementById("coin_done").value;
    window.sessionStorage.setItem("coin_done", coinDone);
    
    // SWIM処理-----------------------------
        const progressDone1    = document.getElementById("progress_done1").value;
        const denominatorDone1 = document.getElementById("denominator_done1").value;
        const ttlDone1         = document.getElementById("ttl_done1").value;
        const levelDone1       = document.getElementById("level_done1").value;
        
        window.sessionStorage.setItem("progress_done1", progressDone1);
        window.sessionStorage.setItem("denominator_done1", denominatorDone1);
        window.sessionStorage.setItem("ttl_done1", ttlDone1);
        window.sessionStorage.setItem("level_done1", levelDone1);
    
    // BIKE処理-----------------------------    if ( coinDone &
        const progressDone2    = document.getElementById("progress_done2").value;
        const denominatorDone2 = document.getElementById("denominator_done2").value;
        const ttlDone2         = document.getElementById("ttl_done2").value;
        const levelDone2       = document.getElementById("level_done2").value;
        
        window.sessionStorage.setItem("progress_done2", progressDone2);
        window.sessionStorage.setItem("denominator_done2", denominatorDone2);
        window.sessionStorage.setItem("ttl_done2", ttlDone2);
        window.sessionStorage.setItem("level_done2", levelDone2);
    
    // RUN処理-----------------------------
        const progressDone3    = document.getElementById("progress_done3").value;
        const denominatorDone3 = document.getElementById("denominator_done3").value;
        const ttlDone3         = document.getElementById("ttl_done3").value;
        const levelDone3       = document.getElementById("level_done3").value;
        
        window.sessionStorage.setItem("progress_done3", progressDone3);
        window.sessionStorage.setItem("denominator_done3", denominatorDone3);
        window.sessionStorage.setItem("ttl_done3", ttlDone3);
        window.sessionStorage.setItem("level_done3", levelDone3);
    
</script>
    
@endsection






