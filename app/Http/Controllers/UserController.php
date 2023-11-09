<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10); // 10 users por página
        return view('panel.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all(); // Obtener todos los roles
        return view('panel.users.create', compact('roles'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, CreatesNewUsers $creator)
    {
        event(new Registered($user = $creator->create($request->all())));

        // Asignar roles al usuario recién creado
        if ($request->has('roles')) {
            $user->assignRole($request->input('roles'));
        }

        return redirect()->route('panel.users.show', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('panel.users.show', compact('user'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all(); // Asegúrate de tener el modelo Role importado
        $userRoles = $user->roles->pluck('name')->toArray();
        return view('panel.users.edit', compact('user', 'roles', 'userRoles'));
    }
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->all());
        $user->syncRoles($request->roles);
        
        return redirect()->route('panel.users.show', ['user' => $user]);
    }
    public function changePassword(PasswordRequest $request, User $user)
    {
        $user->update(['password' => Hash::make($request->input('password'))]);
        
        return redirect()->route('panel.users.show', ['user' => $user]);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('panel.users.index');
    }
}
