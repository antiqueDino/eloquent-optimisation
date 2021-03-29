<?php

namespace App\Http\Controllers;

use App\LastLogin;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->with('company', 'last_logins')
            ->orderByField($request->get('order', 'name'))
            ->whereFilters($request->only(['search', 'filter']))
            ->paginate();

        return view('users', ['users' => $users]);
    }
}
