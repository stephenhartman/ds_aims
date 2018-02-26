<div id="load" style="position: relative;">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Administrator?</th>
            <th>Action</th>
        </tr>
        </thead>
    @foreach ($users as $user)
            <tr>
                {{ Form::open( ['route' => ['users.update', $user], 'method' => 'PUT']) }}
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                @if ($user->id == Auth::id())
                    <td><input class="form-control" type="checkbox" name="role" disabled="disabled" checked></td>
                @elseif ($user->hasRole('admin'))
                    <td><input class="form-control" type="checkbox" name="role" checked></td>
                @elseif ($user->hasRole('alumni'))
                    <td><input class="form-control" type="checkbox" name="role" unchecked></td>
                @endif
                <td>
                    {{ Form::submit('Save', ['class' => 'btn btn-success btn-sm btn-block']) }}
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
        </table>
        <div class="text-center">
            {{ $users->links() }}
        </div>
</div>
