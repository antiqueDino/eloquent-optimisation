@extends('layout', ['title' => 'Users'])

@section('content')

<h1>Users
    <small class="text-muted font-weight-light">
        {{-- ({{ number_format($users->total()) }} found) --}}
    </small>
</h1>

<form class="input-group my-4" action="{{ route('users') }}" method="get">
    <input type="hidden" name="order" value="{{ request('order') }}">
    <input type="text" class="w-50 form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
    <select name="filter" class="custom-select">
        <option value="" selected>Filters...</option>
        {{-- <option value="birthday_this_week" {{ request('filter') === 'birthday_this_week' ? 'selected' : '' }}>Birthday this week</option> --}}
    </select>
    <div class="input-group-append">
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
</form>

<table class="table my-4">
    <tr>
        <th><a class="{{ request('order', 'name') === 'name' ? 'text-dark' : '' }}" href="{{ route('users', ['order' => 'name'] + request()->except('page')) }}">Name</a></th>
        <th><a class="{{ request('order') === 'company' ? 'text-dark' : '' }}" href="{{ route('users', ['order' => 'company'] + request()->except('page')) }}">Company</a></th>
        <th><a class="{{ request('order') === 'email' ? 'text-dark' : '' }}" href="{{ route('users', ['order' => 'email'] + request()->except('page')) }}">Email</a></th>
        {{-- <th><a href="#">Last Login</a></th> --}}
        <th></th>
    </tr>
    @foreach ($users as $user)
        <tr>
            <td><a href="#">{{ $user->name }}</a></td>
            <td>{{ $user->company->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <a class="btn btn-link" href="#" role="button">Edit</a>
            </td>
        </tr>
    @endforeach
</table>

{{ $users->appends(request()->all())->links() }}

@endsection
