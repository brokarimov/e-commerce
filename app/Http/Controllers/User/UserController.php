<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('pages.user.user-index', ['models' => $users]);
    }

    public function store(UserCreateRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return back();
    }
    public function delete(User $user)
    {
        $user->delete();
        return back();
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user->update($data);
        return back();
    }

    public function status(User $user)
    {
        if ($user->status == 1) {
            $user->status = 2;
        } else {
            $user->status = 1;
        }
        $user->save();
        return back();
    }

    public function search(Request $request)
    {
        $query = $request->input('name');

        $models = User::where('name', 'LIKE', '%' . $query . '%')->paginate(10);

        return view('pages.user.user-index', ["models" => $models]);
    }

    public function view(User $user)
    {
        return view('pages.user.user-view', ["model" => $user]);
    }
}
