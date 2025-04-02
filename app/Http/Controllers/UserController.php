<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{

    public function index(): View
    {
        $users = User::with('domains')->orderBy('created_at', 'desc')->paginate(20);

        return view('users.index', compact('users'));
    }
}
