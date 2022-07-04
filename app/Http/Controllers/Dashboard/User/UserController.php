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
        $users = User::getUsers();
        return view('dashboard.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws AuthorizationException
     */
    public function checkMembers() {
        $currentUser = auth()->user();
        $this->authorize('checkMembers', $currentUser);
        $members = User::getMembers();
        return view('dashboard.users.members', [
            'members' => $members,
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
        $data = $request->validated();
        User::storeData($data);
        return redirect()->route('dashboard.user.index')->with('success', 'Korisnik uspješno dodan');
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
        User::updateData($user, $data);
        return redirect()->route('dashboard.user.index')->with('success', 'Korisnik uspješno ažuriran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        return redirect()->back()->with('warning', 'Korisnik, zajedno sa svojim podacima, je uspješno arhiviran');
    }

    /**
     * Check the list of the archived users.
     *
     * @return void
     * @throws AuthorizationException
     */
    public function archived() {
        $currentUser = auth()->user();
        $this->authorize('archived', $currentUser);
        $users = User::onlyTrashed()->select(['id', 'name', 'email', 'isAdmin', 'isMember', 'status'])->paginate(15);
        return view('dashboard.users.archived', [
            'users' => $users
        ]);
    }

    /**
     * Restore archived user.
     *
     * @param $id
     * @return void
     * @throws AuthorizationException
     */
    public function restore($id) {
        $user = User::withTrashed()->where('id', $id)->first();
        $this->authorize('restore', $user);
        $user->restore();
        return redirect()->back()->with('info', 'Korisnik, zajedno sa svojim podacima, uspješno vraćen');
    }

    /**
     * Permanently delete archived user.
     *
     * @param $id
     * @return void
     * @throws AuthorizationException
     */
    public function forceDelete($id) {
        $user = User::withTrashed()->where('id', $id)->first();
        $this->authorize('forceDelete', $user);
        $user->forceDelete();
        return redirect()->back()->with('danger', 'Korisnik je, zajedno sa svojim podacima, trajno obrisan');
    }
}
