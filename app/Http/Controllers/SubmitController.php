<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Research;

class SubmitController extends Controller
{
    function submit()
    {
        return view('submit');
    }
    public function submitPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'id_number' => 'required',
            'phone' => 'required',
            'research_interests' => 'required|array',
        ]);

        if ($validator->fails()) {
            return redirect(route('submit'))->withErrors($validator)->withInput();
        }

        $data['name'] = $request->name;
        $data['id_number'] = $request->id_number;
        $data['phone'] = $request->phone;
        $data['research_interests'] = json_encode($request->research_interests);

        $isPatient = Patients::where('id_number', $request->id_number)->first();

        if ($isPatient) {
            return redirect(route('submit'))->with('error', 'Submission Failed: Patient with ID number ' . $request->id_number . ' already exists. Researches: ' . json_encode($request->research_interests));
        }
        //$researches= Research::all();

        $patient = Patients::create($data);

        if (!$patient) {
            return redirect(route('submit'))->with('error', 'Submission Failed, try again!');
        }

        return redirect(route('home'))->with('success', 'REGISTERED!!!')->with('patient', $patient);
    }
}
