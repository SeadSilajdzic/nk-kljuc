<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\StoreUserRequest;
use App\Http\Requests\Dashboard\User\UpdateUserRequest;
use App\Models\Dashboard\User\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws AuthorizationException
     */
    public function index()
    {
        $currentUser = auth()->user();
        $this->authorize('viewAny', $currentUser);
        $users = User::usersWithPosts();
        return view('dashboard.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     * @throws AuthorizationException
     */
    public function create()
    {
        $currentUser = auth()->user();
        $this->authorize('create', $currentUser);
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return void
     * @throws AuthorizationException
     */
    public function store(StoreUserRequest $request)
    {
        $currentUser = auth()->user();
        $this->authorize('create', $currentUser);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return void
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return void
     * @throws AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('dashboard.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return void
     * @throws AuthorizationException
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $data = $request->validated();

        $user->update([
           'name' => $data['name'],
           'email' => $data['email'],
           'isAdmin' => $data['isAdmin'],
           'isMember' => $data['isMember'],
           'status' => $data['status'],
           'phone' => $data['phone'],
        ]);

        if(isset($data['password'])) {
            $user->update([
                'password' => bcrypt($data['password'])
            ]);
        }

        return redirect()->route('dashboard.user.index')->with('success', 'Korisnik uspješno ažuriran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return void
     */
    public function destroy(User $user)
    {
        //
    }
}
