<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Complaints;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{
    public function index()
    {
        // Fetch announcements
        $announcements = Announcement::where('is_archive', 0)
            ->orderBy('date_created', 'desc')
            ->limit(3)
            ->get();

        // Check if the user is authenticated
        // $user = Auth::check() ? Auth::user() : null;

        // Pass both the announcements and the user data to the view
        return view('welcome', [
            'announcements' => $announcements,
            // 'user' => $user,
        ]);
    }

    public function news()
    {
        $latestAnnouncement = Announcement::where('is_archive', 0)
            ->orderBy('date_created', 'desc')
            ->first();

        $announcements = Announcement::where('is_archive', 0)
            ->orderBy('date_created', 'desc')
            ->skip(1)
            ->take(6)
            ->get();

        return view('news.index', compact('latestAnnouncement', 'announcements'));
    }

    public function allnewss()
    {
        $years = Announcement::selectRaw('YEAR(date_created) as year')
            ->where('is_archive', 0)
            ->distinct()
            ->orderBy('year', 'desc')
            ->get();

        $currentYear = date('Y');

        $months = Announcement::selectRaw('MONTH(date_created) as month')
            ->whereYear('date_created', $currentYear)
            ->where('is_archive', 0)
            ->distinct()
            ->orderBy('month', 'asc')
            ->get();

        $currentMonthAnnouncements = Announcement::whereYear('date_created', Carbon::now()->year)
            ->whereMonth('date_created', Carbon::now()->month)
            ->where('is_archive', 0)
            ->get();

        return view('news.allnews', compact('years', 'months', 'currentYear', 'currentMonthAnnouncements'));
    }

    public function allnews()
    {
        $years = Announcement::selectRaw('YEAR(date_created) as year')
            ->where('is_archive', 0)
            ->distinct()
            ->orderBy('year', 'desc')
            ->get();

        $currentYear = date('Y');

        return view('news.allnews', compact('years', 'currentYear'));
    }

    public function fetchYears(Request $request)
    {
        $years = Announcement::selectRaw('YEAR(date_created) as year')
            ->where('is_archive', 0)
            ->distinct()
            ->orderBy('year', 'desc')
            ->get();

        return response()->json(['years' => $years]);
    }

    public function fetchMonths(Request $request)
    {
        $year = $request->input('year');
        $months = Announcement::selectRaw('MONTH(date_created) as month, MONTHNAME(date_created) as month_name')
            ->whereYear('date_created', $year)
            ->where('is_archive', 0)
            ->distinct()
            ->orderBy('month', 'asc')
            ->get();

        return response()->json(['months' => $months]);
    }

    public function fetchMonthEntries(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('month');

        // Fetch entries for the selected month and year
        $entries = Announcement::whereYear('date_created', $year)
            ->whereMonth('date_created', $month)
            ->where('is_archive', 0)
            ->get();

        // Return the entries as JSON response
        return response()->json(['entries' => $entries]);
    }

    public function show($id)
    {
        $announcement = Announcement::findOrFail($id);
        $coverImage = $announcement->cover;
        $imagePaths = $announcement->image ? explode(',', $announcement->image) : [];

        return view('news.details', compact('announcement', 'coverImage', 'imagePaths'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'myfile.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $announcement = new Announcement();
        $announcement->title = $request->title;
        $announcement->descriptions = $request->description;

        if ($request->hasFile('cover')) {
            $coverImage = $request->file('cover');
            $imageName = time() . '.' . $coverImage->getClientOriginalExtension();
            $coverImage->storeAs('announcements', $imageName, 'upload');
            $announcement->cover = 'upload/announcements/' . $imageName;
        }

        if ($request->hasFile('myfile')) {
            $imagePaths = [];
            foreach ($request->file('myfile') as $file) {
                $path = $file->store('upload/announcements', 'upload');
                $imagePaths[] = $path;
            }
            $announcement->image = implode(',', $imagePaths);
        } else {
            $announcement->image = '';
        }

        date_default_timezone_set("Asia/Manila");
        $created_at = date("Y-m-d H:i:s");
        $announcement->date_created = $created_at;

        $announcement->is_archive = 0;
        $announcement->save();

        // return redirect()->route('news.index')->with('status_success', 'News post added successfully');
        return response()->json(['success' => true, 'message' => 'News post added successfully']);
    }

    public function update(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);

        $announcement->title = $request->input('title');
        $announcement->descriptions = $request->input('descriptions');

        // if ($request->hasFile('cover')) {
        //     $coverPath = $request->file('cover')->storeAs('upload/announcements', $request->file('cover')->getClientOriginalName(), 'public');
        //     $announcement->cover = $coverPath;
        // }

        if ($request->hasFile('cover')) {
            // Handle image upload
            $cover = $request->file('cover');
            $imageName = time() . '.' . $cover->getClientOriginalExtension();
            $cover->storeAs('announcements', $imageName, 'upload');
            $announcement->cover = 'upload/announcements/' . $imageName;
        }

        // Update additional images if provided
        if ($request->hasFile('myfile')) {
            $imagePaths = [];
            foreach ($request->file('myfile') as $file) {
                $path = $file->storeAs('upload/announcements', $file->getClientOriginalName(), 'public');
                $imagePaths[] = $path;
            }
            $announcement->image = implode(',', $imagePaths);
        }

        $announcement->save();

        return redirect()->route('news.details', $announcement->id)->with('status_success_update', 'success');
    }

    public function archive($id)
    {
        try {
            $announcement = Announcement::findOrFail($id);
            $announcement->is_archive = 1;
            $announcement->save();
            return redirect()->route('news.index')->with('status', 'Announcement archived successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Failed to archive announcement.']);
        }
    }

    public function complaintSubmit(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string',
            'course' => 'required|string',
            'college' => 'required|string',
            'email' => 'required|string',
            'message' => 'required|string',
            'student_id' => 'required|integer',
            'myfile' => 'required|mimes:pdf|max:10000'
        ]);

        $complaint = new Complaints();
        $complaint->fullname = $request->fullname;
        $complaint->course = $request->course;
        $complaint->college = $request->college;
        $complaint->email = $request->email;
        $complaint->message = $request->message;
        $complaint->student_id = $request->student_id;

        if ($request->hasFile('myfile')) {
            $pdfFile = $request->file('myfile');
            $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();
            $pdfFile->storeAs('complaints', $pdfFileName, 'upload');
            $complaint->user_file = 'upload/complaints/' . $pdfFileName;
        }
        date_default_timezone_set("Asia/Manila");
        $created_at = date("Y-m-d H:i:s");
        $complaint->date_filed = $created_at;

        $complaint->is_send = 0;
        $complaint->save();

        Mail::to($request->email)->send('complaints.emails.auto')->subject('Complaint Feedback');;

        return redirect()->route('welcome')->with('status_success', 'Complaint sent successfully');
    }
}
