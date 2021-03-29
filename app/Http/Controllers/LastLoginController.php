<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LastLoginController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->withLastLoginAt()
            ->orderBy('name')
            ->paginate();

        return view('last-logins', ['users' => $users]);
    }
}
