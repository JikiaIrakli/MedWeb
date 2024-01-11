<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Research;




class AuthManager extends Controller
{
    function login()
    {
        if(Auth::check()){
            return redirect(route('home'));
        }
       return view('login'); 
    }

    function registration()
    {
        return view('registration');
    }
    function submit()
    {
        return view('submit');
    }
    function loginPost(Request $request)
    {
        $request -> validate([
            'email'=> 'required',
            'password'=> 'required',
            ]);

        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)) {
            return redirect()->intended(route('home'));
        }
        return redirect(route('login'))->with('error','Login info is not valid');
    }

    function registrationPost(Request $request)
    {
        $request -> validate([
            'name' => 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required'
            
        ]);

        $data['name'] = $request -> name;
        $data['email'] = $request -> input('email');
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if(!$user) {
            return redirect(route('registration'))->with('error','Registration Faild, try again!');
        }
        return redirect(route('login'))->with('success','REGISTERED!!!');
    }
    
    function submitPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'id_number' => 'required',
            'phone' => 'required',
            'researches' => 'required|array', // Assuming researches is an array of interests
        ]);
    
        if ($validator->fails()) {
            return redirect(route('submit'))->withErrors($validator)->withInput();
        }
    
        $data['name'] = $request->name;
        $data['id_number'] = $request->id_number;
        $data['phone'] = $request->phone;
        $data['research_interests'] = $request->researches;

        $researches = Research::all();
    
        // Check if patient with the given ID number already exists
        $ispatient = Patients::where('id_number', $request->id_number)->first();
    
        if ($ispatient) {
            // Patient already exists, show an error message or take appropriate action
            return redirect(route('submit'))->with('error', 'Submission Failed: Patient with ID number ' . $request->id_number . ' already exists.');
        }
    
        // Patient does not exist, add it to the database
        $patient = Patients::create($data);
    
        if (!$patient) {
            return redirect(route('submit'))->with('error', 'Submission Failed, try again!');
        }
    
        // Redirect to home with success message and patient details
        return redirect(route('home'))->with('success', 'REGISTERED!!!')->with('patient', $patient);
    }
    function profile()
    {
        return view('profile');
    }
    function getProfile(Request $request)
    {
        $username = User::get( 'name', $request -> username);
        $useremail = User::get( 'Email', $request -> email);
    }


    function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
