<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserController extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public function create(Request $request)
    {
        $rules = [
            'name'     => 'required|max:125',
            'email'    => 'required|max:125|unique:users',
            'password' => 'required|min:6',
        ];
        $data = $request->json()->all();
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => [
                    'messages' => $validator->errors(),
                    'type'     => 'UserCreateError',
                    'status'   => 422
                ],

            ], 422);
        }

        try {
            User::create($data);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => [
                    'messages' => $th->getMessage(),
                    'type'     => 'UserCreateError',
                    'status'   => 422
                ]
            ], 422);
        }

        return response(json_encode($data), 201)
            ->header('Content-Type', 'application/json');
    }

    public function updateF(Request $request)
    {
        $rules = [
            'name'     => 'max:125',
            'password' => 'min:6',
        ];
        $data = $request->json()->all();
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => [
                    'messages' => $validator->errors(),
                    'type'     => 'UserUpdateError',
                    'status'   => 404
                ],

            ], 404);
        }

        try {
            User::where('email', '=', $data['email'])->update(array(
                'name'     => $data['name'],
                'password' => $data['password']
            ));
        } catch (\Throwable $th) {
            return response()->json([
                'error' => [
                    'messages' => $th->getMessage(),
                    'type'     => 'UserUpdateError',
                    'status'   => 404
                ]
            ], 404);
        }

        return response()->json([
            'success' => [
                'message' => 'Update finished with success.',
                'type'    => 'UserUpdateSuccess',
                'status'  => 200
            ]
        ], 200);
    }

    // public function destroy(Request $request)
    // {
    // }

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
