<div id="load" style="position: relative;">
    @foreach ($posts as $post)
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1">
                @if (Auth::user()->hasRole('admin'))
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-default btn-sm">Edit</a>
                @endif
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
        <div class="row">
            <hr class="posts">
        </div>
    @endforeach
    <div class="text-center">
        {{ $posts->links() }}
    </div>
</div>
