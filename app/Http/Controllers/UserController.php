<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userPage(){
        return view('pages.user-page');
    }

    public function showUser(){
        $userData = User::get();
        return response()->json($userData);

    }

    public function createUser(Request $request)
    {
        try {
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'department' => $request->input('department'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password'),
            ]);

            return response()->json([
                'status' => 'Success',
                'message' => 'User Created Successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ]);
        }
    }



    public function deleteUser(Request $request) {
        try {
            $user_id = $request->input('id');
            $deleted = User::where('id', $user_id)->delete();
    
            if ($deleted) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'User deleted successfully'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'User deletion failed'
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
    }
    
    public function getUser(Request $request) {
        try {
            $user_id = $request->input('id');
            $userData = User::where('id', $user_id)->first();
            return response()->json($userData);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
    }

    public function updateUser(Request $request) {
        try {
            // Fetch the user by ID
            $user = User::findOrFail($request->input('id'));

            // Update user details
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->department = $request->input('department');
            $user->mobile = $request->input('mobile');
            $user->save();

            // Return success response
            return response()->json([
                'status' => 'Success', 
                'message' => 'User updated successfully'
            ]);
        } catch (Exception $e) {
            // Handle exceptions
            return response()->json([
                'status' => 'Failed',
                'message' => 'Update failed: ' . $e->getMessage()
            ]);
        }
    }



}
