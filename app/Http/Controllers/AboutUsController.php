<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personnel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    public function index()
    {
        $personnel = Personnel::where('is_archive', 0)->get();

        // $deans = $personnel->filter(function ($person) {
        //     return $person->position === 'Dean';
        // });

        // $otherPersonnel = $personnel->filter(function ($person) {
        //     return $person->position !== 'Dean';
        // });

        // return view('about_us', compact('deans', 'otherPersonnel'));
        return view('about_us', compact('personnel'));
    }

    public function store(Request $request)
    {

        $personnel = new Personnel();
        $personnel->name = $request->input('name');
        $personnel->position = $request->input('position');
        $personnel->facebook = $request->facebook ?? '';
        $personnel->email = $request->email ?? '';

        if ($request->hasFile('myfile')) {
            $image = $request->file('myfile');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('personnel', $imageName, 'upload');
            $personnel->image = 'upload/personnel/' . $imageName;
        }

        $personnel->is_archive = 0;

        $personnel->save();

        return redirect()->route('about_us')->with('success', 'Personnel added successfully.');
    }

    public function fetchPersonnel(Request $request)
    {
        $personnel = Personnel::find($request->per_id);
        if (!$personnel) {
            return response()->json(['error' => 'No rows found.']);
        }
        return response()->json(['data' => $personnel]);
    }

    public function updatePersonnel(Request $request)
    {
        // $request->validate([
        //     'per_id' => 'required|integer',
        //     'name' => 'required|string|max:255',
        //     'positions' => 'required|string',
        //     'perImg' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        $personnel = Personnel::find($request->per_id);
        if (!$personnel) {
            return redirect()->back()->withErrors(['Personnel not found.']);
        }

        $personnel->name = $request->input('name');
        $personnel->position = $request->input('positions');
        $personnel->facebook = $request->input('facebooks') ?? '';
        $personnel->email = $request->input('emails') ?? '';

        if ($request->hasFile('perImg')) {
            $image = $request->file('perImg');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('personnel', $imageName, 'upload');
            $personnel->image = 'upload/personnel/' . $imageName;
        }

        // Save the changes
        $personnel->save();

        return redirect()->route('about_us')->with('success', 'Personnel updated successfully.');
    }

    public function archivePersonnel(Request $request)
    {
        $personnel = Personnel::find($request->archive_id_input);
        if (!$personnel) {
            return redirect()->back()->withErrors(['Personnel not found.']);
        }

        $personnel->is_archive = 1;
        $personnel->save();

        return redirect()->route('about_us')->with('success', 'Personnel archived successfully.');
    }

    public function edit($id)
    {
        // $personnel = Personnel::findOrFail($id);
        $personnel = Personnel::find($id);
        return response()->json($personnel);
    }



    public function update(Request $request, $id)
    {
        // Retrieve the personnel record by ID
        $personnel = Personnel::findOrFail($id);

        // Update the personnel attributes with the form data
        $personnel->name = $request->input('name');
        $personnel->position = $request->input('positions');
        $personnel->facebook = $request->input('facebooks') ?? '';
        $personnel->email = $request->input('emails') ?? '';

        if ($request->hasFile('perImg')) {
            // Handle image upload
            $image = $request->file('perImg');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('personnel', $imageName, 'upload');
            $personnel->image = 'upload/personnel/' . $imageName;
        }

        // Save the changes
        $personnel->save();

        return redirect()->route('about_us')->with('success', 'Personnel updated successfully.');
    }

    public function archive($id)
    {
        try {
            $personnel = Personnel::findOrFail($id);
            $personnel->is_archive = 1;
            $personnel->save();
            return redirect()->route('about_us')->with('status', 'Personnel archived successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Failed to archive personnel.']);
        }
    }
}
