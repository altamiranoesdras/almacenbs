<?php

namespace App\Http\Controllers;

use App\DataTables\UserDespachaUserDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUserDespachaUserRequest;
use App\Http\Requests\UpdateUserDespachaUserRequest;
use App\Models\UserDespachaUser;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class UserDespachaUserController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver User Despacha Users')->only(['show']);
        $this->middleware('permission:Crear User Despacha Users')->only(['create','store']);
        $this->middleware('permission:Editar User Despacha Users')->only(['edit','update',]);
        $this->middleware('permission:Eliminar User Despacha Users')->only(['destroy']);
    }

    /**
     * Display a listing of the UserDespachaUser.
     *
     * @param UserDespachaUserDataTable $userDespachaUserDataTable
     * @return Response
     */
    public function index(UserDespachaUserDataTable $userDespachaUserDataTable)
    {
        return $userDespachaUserDataTable->render('user_despacha_users.index');
    }

    /**
     * Show the form for creating a new UserDespachaUser.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_despacha_users.create');
    }

    /**
     * Store a newly created UserDespachaUser in storage.
     *
     * @param CreateUserDespachaUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserDespachaUserRequest $request)
    {
        $input = $request->all();

        /** @var UserDespachaUser $userDespachaUser */
        $userDespachaUser = UserDespachaUser::create($input);

        Flash::success('User Despacha User guardado exitosamente.');

        return redirect(route('userDespachaUsers.index'));
    }

    /**
     * Display the specified UserDespachaUser.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var UserDespachaUser $userDespachaUser */
        $userDespachaUser = UserDespachaUser::find($id);

        if (empty($userDespachaUser)) {
            Flash::error('User Despacha User no encontrado');

            return redirect(route('userDespachaUsers.index'));
        }

        return view('user_despacha_users.show')->with('userDespachaUser', $userDespachaUser);
    }

    /**
     * Show the form for editing the specified UserDespachaUser.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var UserDespachaUser $userDespachaUser */
        $userDespachaUser = UserDespachaUser::find($id);

        if (empty($userDespachaUser)) {
            Flash::error('User Despacha User no encontrado');

            return redirect(route('userDespachaUsers.index'));
        }

        return view('user_despacha_users.edit')->with('userDespachaUser', $userDespachaUser);
    }

    /**
     * Update the specified UserDespachaUser in storage.
     *
     * @param  int              $id
     * @param UpdateUserDespachaUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserDespachaUserRequest $request)
    {
        /** @var UserDespachaUser $userDespachaUser */
        $userDespachaUser = UserDespachaUser::find($id);

        if (empty($userDespachaUser)) {
            Flash::error('User Despacha User no encontrado');

            return redirect(route('userDespachaUsers.index'));
        }

        $userDespachaUser->fill($request->all());
        $userDespachaUser->save();

        Flash::success('User Despacha User actualizado con éxito.');

        return redirect(route('userDespachaUsers.index'));
    }

    /**
     * Remove the specified UserDespachaUser from storage.
     *
     * @param  int $id
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
            Flash::error('User Despacha User no encontrado');

            return redirect(route('userDespachaUsers.index'));
        }

        $userDespachaUser->delete();

        Flash::success('User Despacha User deleted successfully.');

        return redirect(route('userDespachaUsers.index'));
    }
}
