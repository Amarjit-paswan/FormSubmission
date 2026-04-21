<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    //save user
    public function save(Request $request){


            //validate
            $validated = $request->validate([
                'name' => 'required|regex:/^[a-zA-Z\s]+$/',
                'email' => 'required|email|unique:users,email',
                'mobile' => 'required|digits:10',
                'password' => 'required|min:6',
                'confirm_password' => 'required|same:password',
                'profile_pic' => 'required|image|mimes:jpeg,png,jpg'

            ],
            [
                'name.required' => 'Name is required.',
                'name.regex' => 'Name must contain only letter and spaces',

                'email.required' => 'Email is required.',
                'email.email' => 'Enter a valid email.',
                'email.unique' => 'This email is already registered.',

                'mobile.required' => 'Mobile number is required',
                'mobile.digits' => 'Mobile number must be exactly 10 digits',

                'password.required' => 'Password is required.',
                'password.min' => 'Password length must be at least 6 characters',

                'confirm_password.required' => 'Confirm Password is required.',
                'confirm_password.same' => 'Password do not match.',

                'profile_pic.required' => 'Profile Picture is required.',
                'profile_pic.image' => 'Only JPEG, PNG, JPG formats are allowed'
            ]);

            $path = $request->file('profile_pic')->store('profiles','public');

            $users = User::create([
                'username' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'mobile' => $validated['mobile'],
                'profile_pic' => $path
            ]);


            return redirect()->back()->with('success', "User created Successfully");

   
        
        


    }
}
