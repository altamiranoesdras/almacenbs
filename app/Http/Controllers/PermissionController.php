<?php

namespace App\Http\Controllers;

use App\DataTables\PermissionDataTable;
use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Permission;

class PermissionController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Permisos')->only('show');
        $this->middleware('permission:Crear Permisos')->only(['create','store']);
        $this->middleware('permission:Editar Permisos')->only(['edit','update']);
        $this->middleware('permission:Eliminar Permisos')->only('destroy');
    }
    /**
     * Display a listing of the Permission.
     */
    public function index(PermissionDataTable $permissionDataTable)
    {
    return $permissionDataTable->render('admin.permissions.index');
    }


    /**
     * Show the form for creating a new Permission.
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created Permission in storage.
     */
    public function store(CreatePermissionRequest $request)
    {
        $input = $request->all();

        /** @var Permission $permission */
        $permission = Permission::create($input);

        flash()->success('Permission guardado.');

        return redirect(route('permissions.index'));
    }

    /**
     * Display the specified Permission.
     */
    public function show($id)
    {
        /** @var Permission $permission */
        $permission = Permission::find($id);

        if (empty($permission)) {
            flash()->error('Permission no encontrado');

            return redirect(route('permissions.index'));
        }

        return view('admin.permissions.show')->with('permission', $permission);
    }

    /**
     * Show the form for editing the specified Permission.
     */
    public function edit($id)
    {
        /** @var Permission $permission */
        $permission = Permission::find($id);

        if (empty($permission)) {
            flash()->error('Permission no encontrado');

            return redirect(route('permissions.index'));
        }

        return view('admin.permissions.edit')->with('permission', $permission);
    }

    /**
     * Update the specified Permission in storage.
     */
    public function update($id, UpdatePermissionRequest $request)
    {
        /** @var Permission $permission */
        $permission = Permission::find($id);

        if (empty($permission)) {
            flash()->error('Permission no encontrado');

            return redirect(route('permissions.index'));
        }

        $permission->fill($request->all());
        $permission->save();

        flash()->success('Permission actualizado.');

        return redirect(route('permissions.index'));
    }

    /**
     * Remove the specified Permission from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Permission $permission */
        $permission = Permission::find($id);

        if (empty($permission)) {
            flash()->error('Permission no encontrado');

            return redirect(route('permissions.index'));
        }

        $permission->delete();

        flash()->success('Permission eliminado.');

        return redirect(route('permissions.index'));
    }
}
