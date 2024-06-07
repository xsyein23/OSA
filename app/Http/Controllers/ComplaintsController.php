<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaints;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class ComplaintsController extends Controller
{

    public function index()
    {
        $complaints = Complaints::where('is_send', 0)->get();

        return view('complaints.index', compact('complaints'));
    }

    public function fetchDetails(Request $request)
    {
        // \Log::info('Fetch details called with ID: ' . $request->input('id'));
        $complaintId = $request->input('id');
        $complaint = Complaints::find($complaintId);

        if ($complaint) {
            $html = view('complaints.partials.complaint-details', compact('complaint'))->render();
            return response()->json(['html' => $html]);
        }

        return response()->json(['html' => 'Complaint not found.']);
    }

    public function reply(Request $request)
    {
        $request->validate([
            'complaint_id' => 'required|integer',
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $complaint = Complaints::find($request->complaint_id);

        if ($complaint) {
            // Prepare the email data
            $emailData = [
                'name' => $request->name,
                'email' => $request->email,
                'adminMessage' => $request->message,
                'complaint_id' => $request->complaint_id,
            ];

            try {
                // Send the email
                Mail::send('complaints.emails.reply', $emailData, function ($message) use ($emailData) {
                    $message->to($emailData['email'], $emailData['name'])
                        ->subject('Complaint Feedback');
                });

                // Update complaint status
                $complaint->is_send = 1;
                $complaint->save();
                
                return redirect()->back()->with('success', 'Reply sent successfully!');
            } catch (\Exception $e) {
                // \Log::error('Error sending email: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Failed to send reply: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('error', 'Complaint not found.');
    }

    public function previous()
    {
        $complaints = Complaints::where('is_send', 1)->get();

        return view('complaints.previous', compact('complaints'));
    }

    public function fetchPrevDetails(Request $request)
    {
        // \Log::info('Fetch details called with ID: ' . $request->input('id'));
        $complaintId = $request->input('id');
        $complaint = Complaints::find($complaintId);

        if ($complaint) {
            $html = view('complaints.partials.previous-details', compact('complaint'))->render();
            return response()->json(['html' => $html]);
        }

        return response()->json(['html' => 'Complaint not found.']);
    }
}
