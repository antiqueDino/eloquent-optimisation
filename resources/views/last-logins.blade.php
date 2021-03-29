@extends('layout', ['title' => 'Last Activity'])

@section('content')

<h1>Users
    <small class="text-muted font-weight-light">
        {{-- ({{ number_format($users->total()) }} found) --}}
    </small>
</h1>

<table class="table my-4">
    <tr>
        <th><a  href="#">Name</a></th>
        <th><a href="#">Last Login</a></th>
        <th></th>
    </tr>
    @foreach ($users as $user)
        <tr>
            <td><a href="#">{{ $user->name }}</a></td>
            <td>
                {{ $user->last_login_at->diffForHumans() }}
            </td>
            <td>
                <a class="btn btn-link" href="#" role="button">Edit</a>
            </td>
        </tr>
    @endforeach
</table>

{{ $users->appends(request()->all())->links() }}

@endsection
