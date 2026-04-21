<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //

    public function index(){

        $users = User::latest()->paginate(5);

        return view('users',compact('users'));

        // return response()->json([
        //     'status' => true,
        //     'users' => $users
        // ],200);


    }

    public function getUser(Request $request){

        $user = User::where('id', $request->id)->first();

        if(!$user){
            return response()->json([
                'status' => false,
                'message' => 'User id is not exists'
            ]);
        }

        return view('editUser', compact('user'));

       
    }

    public function editUser(Request $request){
         //validate
            $validated = $request->validate([
                'username' => 'required|regex:/^[a-zA-Z\s]+$/',
                'email' => 'required|email',
                'mobile' => 'required|digits:10',
                'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg'

            ],
            [
                'username.required' => 'Name is required.',
                'username.regex' => 'Name must contain only letter and spaces',

                'email.required' => 'Email is required.',
                'email.email' => 'Enter a valid email.',

                'mobile.required' => 'Mobile number is required',
                'mobile.digits' => 'Mobile number must be exactly 10 digits',


                'profile_pic.required' => 'Profile Picture is required.',
                'profile_pic.image' => 'Only JPEG, PNG, JPG formats are allowed'
            ]);

            

            $user = User::findOrFail($request->id);

            //if image has uploaded
            if($request->hasFile('profile_pic')){
                $path = $request->file('profile_pic')->store('profiles', 'public');
                $validated['profile_pic'] = $path;
            }

            $user->update($validated);

            return redirect()->back()->with('success', 'User updated successfully!');


    }


    public function destroy($id){

        $user = User::findOrFail($id);

        //delete profile image
        if($user->profile_pic && Storage::disk('public')->exists($user->profile_pic)){
            Storage::disk('public')->delete($user->profile_pic);
        }

        //delete user
        $user->delete();

        return redirect()->back()->with('success','User Deleted Successfully');
    }

    public function export(){
        $users = User::all();

        $filename = 'users.csv';

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $callback = function() use ($users){
            $file = fopen('php://output', 'w');

            //CSV header row
            fputcsv($file, [ 'Name', 'Email', 'Mobile']);

            // Data Rows
            foreach($users as $user){
                fputcsv($file,[
                    $user->username,
                    $user->email,
                    $user->mobile
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback,200,$headers);
    }
}
