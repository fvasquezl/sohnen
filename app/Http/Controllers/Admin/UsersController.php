<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UsersStoreRequest;
use App\Http\Requests\Users\UsersUpdateRequest;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function index(Request $request)
    {

        if($request->ajax()){
            $data = User::query();

            return Datatables::of($data)
                ->setRowId(function ($user) {
                    return $user->id;
                })->addColumn('Action', function($data){
                    $btns = '<a href="#" class="btn btn-primary btn-sm update-btn"><i class="fas fa-pencil-alt"></i></a>
                             <a href="#" class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash-alt"></i></a>';
                    return $btns;
                })->rawColumns(['Action'])->make(true);

        }
        //  $users = User::all();

        return view('users.index',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UsersStoreRequest $request
     * @return Response
     */
    public function store(UsersStoreRequest $request)
    {
        User::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'The user has been created successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return User
     */
    public function edit(User $user)
    {
        return $user;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UsersUpdateRequest $request
     * @param User $user
     * @return void
     */
    public function update(UsersUpdateRequest $request, User $user)
    {
        $request->update($user);

        return response()->json([
            'success' => true,
            'message' => 'The user has been updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return void
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'The user has been deleted successfully'
        ], 200);
    }
}

