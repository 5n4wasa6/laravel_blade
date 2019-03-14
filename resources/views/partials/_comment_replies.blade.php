

@foreach($comments as $comment)
    @if ($loop->index < 2 )
    
        <div class="display-comment">
            <div class="middle_comment">
            
                @foreach ( $profile_tls as $profile_tl )
                    @if ( $profile_tl && $comment->user_id == $profile_tl->user_id )
                       
                        <div class="comment_wrapper">
                            <a href="{{ action('ActivitiesController@show',$comment) }}">
                                <img src="upload/{{ $profile_tl->comment_img }}" height="28px" width="28px" style="border-radius:50%">
                            </a>
                            <a href="{{ action('ActivitiesController@show',$comment) }}">
                                <strong class="discuss_comment_name">{{ $comment->user->name }}</strong>
                            </a>
                            <div class="comennt_body">{{ $comment->body }}</div>
                            <a href="" id="reply"></a>
                        </div>
                    @elseif ( count($profile_tl->user_id == $profile_tl->user_id) < 1  )
                        <div class="comment_wrapper">
                            <a href="{{ action('ActivitiesController@show',$comment) }}">
                                <img src="upload/sports_fencing.png" height="28px" width="28px" style="border-radius:50%">
                            </a>
                        </div>
                    @endif
                @endforeach
                
            </div>
            
            @foreach ($tests as $test)
                @if( $comment->id == $test->id && $comment->parent_id == NULL )
                
                <div class="reply_comments">
                    <form method="get" action="{{ route('reply.add') }}">
                        {{ csrf_field() }}
                        <div class="small_comment">
                            
                            <div>
                                <input type="text" name="comment_body" class="form-control" placeholder="Add a comment.."/>
                                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                                <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                            </div>
                            
                            <div>
                                <input type="submit" class="btn btn-warning" value="Reply" />
                            </div>
            
                        </div>
                    </form>
                </div>
                    
                @endif
            @endforeach
            
            @include('partials._comment_replies', ['comments' => $comment->replies])
        </div>
    
    @endif
@endforeach