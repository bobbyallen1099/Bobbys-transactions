<?php

namespace App\Http\Controllers;

use App\User;
use App\Note;
use Auth;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminUsersController extends Controller
{

    /**
     * Show all users
     * @return View
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }


    /**
     * Show create form
     * @return View
     */
    public function create() {
        return view('users.create');
    }

    /**
     * Store a new user
     * @param Request $request
     * @return redirect
     */
    public function store(Request $request) {

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user = new User();
        $user->fill($request->except('password'));
        $user->is_admin = $request->is_admin ? true : false;
        $user->password = Hash::make($request->password);
        $user->save();

        Session::flash('message', 'Successfully added user');
        Session::flash('name', $user->email);
        Session::flash('alert-class', 'alert-success');

        return redirect(route('admin.users.show', $user));
    }

    /**
     * Show user
     * @param User $user
     * @return View
     */
    public function show(User $user) {
        return view('users.show', compact('user'));
    }

    /**
     * Show profile
     * @param User $user
     * @return View
     */
    public function profile() {
        $user = Auth::User();
        return view('users.profile', compact('user'));
    }

    /**
     * Show all users
     * @return View
     */
    public function transactions(User $user)
    {
        return view('users.transactions', compact('user'));
    }

    /**
     * Show edit user form
     * @param User $user
     * @return View
     */
    public function edit(User $user) {
        return view('users.edit', compact('user'));
    }

    /**
     * Update user
     * @param request $request
     * @param User $user
     * @return View
     */
    public function update(request $request, User $user) {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);


        $user->fill($request->except('password'));

        // Change password if something is inputted
        if($request->password != '') {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        Session::flash('message', 'Successfully updated user');
        Session::flash('name', $user->firstname . " " . $user->surname);
        Session::flash('alert-class', 'alert-success');

        return redirect(route('admin.users.show', $user));
    }

    /**
     * Show confirm delete post
     * @param User $user
     * @return View
     */
    public function confirmdelete(User $user) {
        return view('users.confirmdelete', compact('user'));
    }

    /**
     * Delete user
     * @param User $user
     * @return View
     */
    public function delete(User $user) {
        $user->delete();

        Session::flash('message', 'Successfully deleted user');
        Session::flash('name', $user->name);
        Session::flash('alert-class', 'alert-success');

        return redirect(route('admin.users.index'));
    }

    /**
     * Show create note page
     * @param User $user
     * @return View
     */
    public function noteCreate(User $user) {
        return view('users.createnote', compact('user'));
    }

    /**
     * Store a new user note
     * @param Request $request
     * @return redirect
     */
    public function noteStore(User $user, Request $request) {

        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $note = $user->notes()->create([
            'entity_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description
        ]);

        Session::flash('message', 'Successfully added note');
        Session::flash('name', $request->title);
        Session::flash('alert-class', 'alert-success');

        return redirect(route('admin.users.show', $user));
    }
}