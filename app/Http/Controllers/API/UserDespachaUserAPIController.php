<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserDespachaUserAPIRequest;
use App\Http\Requests\API\UpdateUserDespachaUserAPIRequest;
use App\Models\UserDespachaUser;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class UserDespachaUserController
 * @package App\Http\Controllers\API
 */

class UserDespachaUserAPIController extends AppBaseController
{
    /**
     * Display a listing of the UserDespachaUser.
     * GET|HEAD /userDespachaUsers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = UserDespachaUser::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $userDespachaUsers = $query->get();

        return $this->sendResponse($userDespachaUsers->toArray(), 'User Despacha Users retrieved successfully');
    }

    /**
     * Store a newly created UserDespachaUser in storage.
     * POST /userDespachaUsers
     *
     * @param CreateUserDespachaUserAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateUserDespachaUserAPIRequest $request)
    {
        $input = $request->all();

        /** @var UserDespachaUser $userDespachaUser */
        $userDespachaUser = UserDespachaUser::create($input);

        return $this->sendResponse($userDespachaUser->toArray(), 'User Despacha User guardado exitosamente');
    }

    /**
     * Display the specified UserDespachaUser.
     * GET|HEAD /userDespachaUsers/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var UserDespachaUser $userDespachaUser */
        $userDespachaUser = UserDespachaUser::find($id);

        if (empty($userDespachaUser)) {
            return $this->sendError('User Despacha User no encontrado');
        }

        return $this->sendResponse($userDespachaUser->toArray(), 'User Despacha User retrieved successfully');
    }

    /**
     * Update the specified UserDespachaUser in storage.
     * PUT/PATCH /userDespachaUsers/{id}
     *
     * @param int $id
     * @param UpdateUserDespachaUserAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserDespachaUserAPIRequest $request)
    {
        /** @var UserDespachaUser $userDespachaUser */
        $userDespachaUser = UserDespachaUser::find($id);

        if (empty($userDespachaUser)) {
            return $this->sendError('User Despacha User no encontrado');
        }

        $userDespachaUser->fill($request->all());
        $userDespachaUser->save();

        return $this->sendResponse($userDespachaUser->toArray(), 'UserDespachaUser actualizado con éxito');
    }

    /**
     * Remove the specified UserDespachaUser from storage.
     * DELETE /userDespachaUsers/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var UserDespachaUser $userDespachaUser */
        $userDespachaUser = UserDespachaUser::find($id);

        if (empty($userDespachaUser)) {
            return $this->sendError('User Despacha User no encontrado');
        }

        $userDespachaUser->delete();

        return $this->sendSuccess('User Despacha User deleted successfully');
    }
}
