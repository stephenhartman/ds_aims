<div id="load" style="position: relative;">
    @foreach ($posts as $post)
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1">
                @if (Auth::user()->hasRole('admin'))
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-default btn-sm">Edit</a>
                @endif
                <div class="row">
                    <h5>
                        <div class="col-md-6 col-xs-12">
                            <h4 class="pull-left">
                                {{ $post->title }}
                            </h4>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="text-muted text-right">
                                @if ($post->user->photo_url !== null)
                                    <img class="img-rounded text-right" height="50px" width="auto" src="{{ $post->user->photo_url }}">
                                @endif
                                <strong>{{ $post->user->name }}</strong>
                                <br>
                                Posted {{ date('M j, Y', strtotime($post->created_at)) }}
                            </div>
                        </div>
                    </h5>
                </div>
                <hr>
                <p>{!! $post->body !!}</p>
            </div>
        </div>
        <div class="row">
            <hr>
        </div>
    @endforeach
    <div class="text-center">
        {{ $posts->links() }}
    </div>
</div>
