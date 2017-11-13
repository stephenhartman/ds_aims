<div>
    @foreach ($posts as $post)
        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <hr>
                <p class="h4 text-center">{{ $post->title }}
                </p>
                <p class="text-muted text-right">{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</p>
                <p>{{ $post->body }}</p>
            </div>
        </div>
    @endforeach
</div>