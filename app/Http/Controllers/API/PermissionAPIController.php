<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePermissionAPIRequest;
use App\Http\Requests\API\UpdatePermissionAPIRequest;
use App\Models\Permission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class PermissionAPIController
 */
class PermissionAPIController extends AppBaseController
{
    /**
     * Display a listing of the Permissions.
     * GET|HEAD /permissions
     */
    public function index(Request $request): JsonResponse
    {
        $query = Permission::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $permissions = $query->get();

        return $this->sendResponse($permissions->toArray(), 'Permissions retrieved successfully');
    }

    /**
     * Store a newly created Permission in storage.
     * POST /permissions
     */
    public function store(CreatePermissionAPIRequest $request): JsonResponse
    {
        $request->merge([
            'guard_name' => 'web'
        ]);

        /** @var Permission $permission */
        $permission = Permission::create($request->all());

        return $this->sendResponse($permission->toArray(), 'Permission saved successfully');
    }

    /**
     * Display the specified Permission.
     * GET|HEAD /permissions/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Permission $permission */
        $permission = Permission::find($id);

        if (empty($permission)) {
            return $this->sendError('Permission not found');
        }

        return $this->sendResponse($permission->toArray(), 'Permission retrieved successfully');
    }

    /**
     * Update the specified Permission in storage.
     * PUT/PATCH /permissions/{id}
     */
    public function update($id, UpdatePermissionAPIRequest $request): JsonResponse
    {
        /** @var Permission $permission */
        $permission = Permission::find($id);

        if (empty($permission)) {
            return $this->sendError('Permission not found');
        }

        $request->merge([
            'guard_name' => 'web'
        ]);

        $permission->fill($request->all());
        $permission->save();

        return $this->sendResponse($permission->toArray(), 'Permission updated successfully');
    }

    /**
     * Remove the specified Permission from storage.
     * DELETE /permissions/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Permission $permission */
        $permission = Permission::find($id);

        if (empty($permission)) {
            return $this->sendError('Permission not found');
        }

        $permission->delete();

        return $this->sendSuccess('Permission deleted successfully');
    }
}
