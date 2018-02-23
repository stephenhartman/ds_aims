<div>
    @foreach ($posts as $post)
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1">
                <p class="h4">
                    {{ $post->title }}
                    <span class="text-muted pull-right">
												By <strong>{{ $post->user->name }}</strong> on
                        {{ date('M j, Y', strtotime($post->created_at)) }}
											</span>
                </p>
                <hr>
                <p>{!! $post->body !!}</p>
            </div>
        </div>
        <hr class="posts">
    @endforeach
</div>
