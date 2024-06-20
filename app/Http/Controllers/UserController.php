<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user_login(Request $request){

        $user = User::where('username', $request->username)->first();



        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Incorrect Username or Password'
            ], 404);
        } elseif ($user->status == 0) {
            return response([
                'message' => 'User Inactive'
            ], 404);
        } else {
            //     // $user->
            //     $token = $user->createToken('web-frontend')->plainTextToken;

            $data = DB::table('users')
                //     ->join('user_types', 'system_users.user_type', '=', 'user_types.id')
                //     ->where('system_users.id', '=', $user->id)
                //         ->select('system_users.*', 'user_types.title as user_type_title')
                ->limit(1)
                ->get();

            //     $data1 = DB::table('personal_access_tokens')
            //     ->latest()
            //         ->get();

            //     if ($data1[0]->id > 5 && $data1[0]->name == 'web-frontend') {
            //         DB::table('personal_access_tokens')
            //         ->where('id', '<=', ($data1[0]->id) - 5)
            //             ->where('name', '=', 'web-frontend')
            //             ->delete();
            //     }
            $filteredUser = [
                'id' => $data[0]->user_id,
                'full_name' => $data[0]->f_name . ' ' . $data[0]->l_name,
                // 'username' => $data[0]->username,
                'user_type' => $data[0]->user_type_id,
                // 'user_type_title' => $data[0]->user_type_title
            ];
            $response = [
                'user' => $filteredUser,
                // 'token' => $token
            ];
            return response()->json($response, 200);
        }
    }
}
