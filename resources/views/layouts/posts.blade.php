<div>
    @foreach ($posts as $post)
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <p class="h4">
                    {{ $post->title }}
                    <span class="text-muted pull-right">
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
