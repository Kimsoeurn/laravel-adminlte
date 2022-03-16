<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RolePermissionController extends Controller
{
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
        $this->title = __('Role and Permissions');
        $this->activeRoute = route('roles.index');
    }

    private function permissions()
    {
        return Permission::orderBy('group_order')
            ->orderBy('group_name')
            ->get()->groupBy('group_name');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->breadcrumb = [
            __('Home') => route('dashboard'),
            __('Role and Permissions') => false,
        ];

        return view('roles.index', [
            'title' => __('Role and Permissions'),
            'breadcrumb' => $this->breadcrumb,
            'activeRoute' => $this->activeRoute,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->breadcrumb = [
            __('Home') => route('dashboard'),
            __('Role and Permissions') => route('roles.index'),
            __('Create') => false,
        ];

        return view('roles.create', [
            'role' => $this->role,
            'title' => __('Role and Permissions'),
            'breadcrumb' => $this->breadcrumb,
            'activeRoute' => $this->activeRoute,
            'permissions' => $this->permissions(),
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
        $data = $this->validate($request, [
                    'name' => ['required', 'unique:roles'],
                    'perm' => ['nullable'],
                ]);

        $role = $this->role->create(['name' => $data['name']]);
        if (! empty($data['perm'])) {
            $role->givePermissionTo($data['perm']);
        }

        if ($role) {
            return redirect()
            ->back()->withMessage(__('Created'));
        }

        return redirect()
            ->back()
            ->withInput()
            ->withType('danger')
            ->withMessage(__('Fail Create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->breadcrumb = [
            __('Home') => route('dashboard'),
            __('Role and Permissions') => route('roles.index'),
            __('Edit') => false,
        ];

        $role = $this->role->findOrFail($id);

        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('roles.create', [
            'role' => $role,
            'title' => __('Role and Permissions'),
            'breadcrumb' => $this->breadcrumb,
            'activeRoute' => $this->activeRoute,
            'permissions' => $this->permissions(),
            'rolePermissions' => $rolePermissions,
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
        $role = $this->role->find($id);
        $data = $request->only(['name', 'perm']);

        $this->validate($request, [
            'name' => 'required|unique:roles,name,'.$role->id,
        ]);

        $role->name = $data['name'];
        $role->save();
        $role->syncPermissions($data['perm'] ?? []);

        if ($role) {
            return redirect()
                ->back()
                ->withMessage(__('Updated'));
        }

        return redirect()
            ->back()
            ->withInput()
            ->withType('danger')
            ->withMessage(__('Fail Update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->role->find($id);

        if ($role->delete()) {
            return ['error' => false, 'message' => __('Deleted')];
        }

        return ['error' => true, 'message' => __('Fail Delete')];
    }

    public function dataTable()
    {
        $roles = $this->role->query();
        $i = 1;

        return Datatables::of($roles)
            ->editColumn('id', function () use (&$i) {
                return $i++;
            })
            ->editColumn('role_permissions', function ($role) {
                return $role->name == 'Super Admin' ? 'All' : count($role->permissions);
            })
            ->editColumn('action', function ($role) {
                return view('roles.inc.actions', ['role' => $role]);
            })
            ->rawColumns(['role_permissions','action'])
            ->make(true);
    }
}
