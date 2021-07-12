<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->activeRoute = route('users.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! can('show_users')) {
            return unauthorized();
        }

        $this->breadcrumb = [
            __('Home') => route('dashboard'),
            __('Users') => false,
        ];
        $users = User::count();
        $trash = User::onlyTrashed()->count();

        return view('users.index', [
            'title' => __('Users'),
            'breadcrumb' => $this->breadcrumb,
            'activeRoute' => $this->activeRoute,
            'users' => $users,
            'trash' => $trash
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! can('create_users')) {
            return unauthorized();
        }

        $this->breadcrumb = [
            __('Home') => route('dashboard'),
            __('Users') => route('users.index'),
            __('Create') => false
        ];

        return view('users.create', [
            'user' => $this->user,
            'title' => __('Users'),
            'breadcrumb' => $this->breadcrumb,
            'activeRoute' => $this->activeRoute
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! can('show_users')) {
            return unauthorized();
        }

        $this->breadcrumb = [
            __('Home') => route('dashboard'),
            __('Users') => route('users.index'),
            __('Show') => false
        ];

        $user = $this->user->findOrFail($id);

        return view('users.show', [
            'user' => $user,
            'title' => __('Users'),
            'breadcrumb' => $this->breadcrumb,
            'activeRoute' => $this->activeRoute
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! can('change_own_account')) {
            return unauthorized();
        }

        $this->breadcrumb = [
            __('Home') => route('dashboard'),
            __('Users') => route('users.index'),
            __('Edit') => false
        ];

        $user = $this->user->findOrFail($id);

        return view('users.edit', [
            'user' => $user,
            'title' => __('Users'),
            'breadcrumb' => $this->breadcrumb,
            'activeRoute' => $this->activeRoute
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);

        if ($user->id === auth()->id()) {
            return ['error' => true, 'message' => __('Fail Delete')];
        }

        if ($user->delete()) {
            return ['error' => false, 'message' => __('Deleted')];
        }

        return ['error' => true, 'message' => __('Fail Delete')];
    }

    public function dataTable()
    {
        $users = User::query();

        if (!empty(\request('trash'))) {
            $users->onlyTrashed();
        }
        $i = 1;
        return DataTables::of($users)
            ->editColumn('id', function () use (&$i) {
                return $i++;
            })
            ->editColumn('role', function ($user) {
                return role_name($user->role_id);
            })
            ->editColumn('last_login_time', function ($user) {
                return $user->last_login_time ? $user->last_login_time->diffForHumans() : '';
            })
            ->editColumn('action', function ($user) {
                return view('users.inc.actions', [
                    'user' => $user
                ]);
            })
            ->make(true);
    }

}
