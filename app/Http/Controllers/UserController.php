<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct(
        protected UserRepository $userRepository
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return new UserCollection($this->userRepository->allPaginate(request()->query('itemsPerPage')));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            return $this->userRepository->find($id);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            return $this->userRepository->update($id, $request->all());
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            if ($this->userRepository->delete($id)) {
                return $this->sendResponse(1, 'User delete succesfully');
            }
            return $this->sendError('Could not delete user');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
