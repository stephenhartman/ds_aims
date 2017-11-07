<div class="row">
    <div class="col-md-12">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                <strong>Success!</strong> {{Session::get('success')}}
            </div>

        @endif

        @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">
                <strong>Error!</strong> {{Session::get('error')}}
            </div>
        @endif

        @if(Session::has('message'))
            <div class="alert alert-warning" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif

        @if(count($errors)>0)
            <div class="alert alert-danger" role="alert">
                <strong>Errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
