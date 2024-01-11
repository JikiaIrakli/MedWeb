<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Research;

class SubmitController extends Controller
{
    public function submitPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'id_number' => 'required',
            'phone' => 'required',
            'researches' => 'required|array', 
        ]);
    
        if ($validator->fails()) {
            return redirect(route('submit'))->withErrors($validator)->withInput();
        }
    
        
        $researches = Research::all();
    
        $data['name'] = $request->name;
        $data['id_number'] = $request->id_number;
        $data['phone'] = $request->phone;
        $data['research_interests'] = $request->researches; 
    
        
        $ispatient = Patients::where('id_number', $request->id_number)->first();
    
        if ($ispatient) {
            
            return redirect(route('submit'))->with('error', 'Submission Failed: Patient with ID number ' . $request->id_number . ' already exists.');
        }
    
        
        $patient = Patients::create($data);
    
        if (!$patient) {
            return redirect(route('submit'))->with('error', 'Submission Failed, try again!');
        }
    
        
        return redirect(route('home'))->with('success', 'REGISTERED!!!')->with('patient', $patient)->with('researches', $researches);
    }
}
