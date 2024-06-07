<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Handbook;
use App\Models\Publications;
use App\Models\Publish;
use App\Models\Spectrum;
use App\Models\Evaluation;
use App\Models\Criteria;
use App\Models\Question;
use App\Models\Responses;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ImpuController extends Controller
{

    public function index()
    {
        $role = Session::get('role');
        // $handbook = Handbook::find(1);
        $handbook = Handbook::orderBy('id', 'desc')->first();
        // \Log::info('Handbook:', ['handbook' => $handbook]);
        $publications = Publications::where('is_archive', 0)
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();
        $spectrums = Spectrum::where('is_archive', 0)
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();
        $evaluations = Evaluation::where('is_archive', 0)
            ->where('is_default', 1)
            ->orderBy('year', 'desc')
            ->orderBy('semester', 'desc')
            ->limit(2)
            ->get();

        return view('impu.index', compact('handbook', 'publications', 'role', 'spectrums', 'evaluations'));
    }

    public function uploadHandbook(Request $request)
    {

        $request->validate([
            'file_name' => 'required|mimes:pdf|max:40000',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $handbook = new Handbook();
        $handbook->file_name = $request->input('file_name');

        if ($request->hasFile('file_name')) {
            $pdfFile = $request->file('file_name');
            $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();
            $pdfFile->storeAs('handbook', $pdfFileName, 'upload');
            $handbook->file_name = 'upload/handbook/' . $pdfFileName;
        }

        if ($request->hasFile('cover')) {
            $coverFile = $request->file('cover');
            $coverFileName = time() . '.' . $coverFile->getClientOriginalExtension();
            $coverFile->storeAs('handbook/img', $coverFileName, 'upload');
            $handbook->cover = 'upload/handbook/img/' . $coverFileName;
        }

        $handbook->uploaded_on = now()->format('d-m-Y');
        $handbook->save();

        return redirect()->route('impu')->with('status_success_added', 'success');
    }

    public function publications()
    {
        $publications = Publications::where('is_archive', 0)
            ->orderBy('id', 'desc')
            ->get();

        return view('publications.index', compact('publications'));
    }

    public function storePublication(Request $request)
    {

        $publication = new Publications();
        $publication->title = $request->input('title');
        $publication->description = $request->input('description');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('img', $imageName, 'upload');
            $publication->image = 'upload/img/' . $imageName;
        }

        $publication->is_archive = 0;

        $publication->save();

        return redirect()->route('publications.index')->with('success', 'Publication added successfully.');
    }

    public function fetchPublication(Request $request)
    {
        $publication = Publications::find($request->pub_id);
        if (!$publication) {
            return response()->json(['error' => 'No rows found.']);
        }
        return response()->json(['data' => $publication]);
    }

    public function updatePublication(Request $request)
    {
        $request->validate([
            'pub_id' => 'required|integer',
            'titles' => 'required|string|max:255',
            'descriptions' => 'required|string',
            'pubImg' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $publication = Publications::find($request->pub_id);
        if (!$publication) {
            return redirect()->back()->withErrors(['Publication not found.']);
        }

        if ($request->hasFile('pubImg')) {
            $image = $request->file('pubImg');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('img', $imageName, 'upload');
            $publication->image = 'img/' . $imageName;
        }

        $publication->title = $request->titles;
        $publication->description = $request->descriptions;
        $publication->save();

        return redirect()->route('publications.index')->with('success', 'Publication updated successfully.');
    }

    public function archivePublication(Request $request)
    {
        $publication = Publications::find($request->archive_id_input);
        if (!$publication) {
            return redirect()->back()->withErrors(['Publication not found.']);
        }

        $publication->is_archive = 1;
        $publication->save();

        return redirect()->route('publications.index')->with('success', 'Publication archived successfully.');
    }

    public function showPage($id)
    {
        $publication = Publications::findOrFail($id);

        $posts = Publish::where('own_by', $id)
            ->where('is_archive', 0)
            ->orderBy('date_created', 'desc')
            ->get();

        return view('publications.page', compact('publication', 'posts'));
    }

    public function storePost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'myfile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the file validation rules as needed
            'own_by' => 'required|exists:publications,id',
        ]);

        // Upload image file
        $imageName = time() . '.' . $request->myfile->getClientOriginalExtension();
        $request->myfile->storeAs('img', $imageName, 'upload');

        // Create new post
        $post = new Publish();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = 'upload/img/' . $imageName;
        $post->own_by = $request->own_by;
        $post->save();

        return redirect()->back()->with('success', 'Post added successfully.');
    }

    public function showDetails($id)
    {
        $post = Publish::findOrFail($id);

        $publicationPageOwner = Publications::findOrFail($post->own_by);

        return view('publications.details', compact('post', 'publicationPageOwner'));
    }

    public function updatePostDetails(Request $request, $id)
    {
        $post = Publish::findOrFail($id);

        $post->title = $request->input('title');
        $post->descriptions = $request->input('descriptions');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('img', $imageName, 'upload');
            $post->image = 'upload/img/' . $imageName;
        }

        $post->save();

        // Redirect back to the details page with a success message
        return redirect()->route('publications.details', ['id' => $id])->with('success', 'Post details updated successfully');
    }

    // bug
    public function archivePostDetails($id)
    {
        $post = Publish::findOrFail($id);
        $post->is_archive = 1;
        $post->save();

        //must redirect to publications.page !!
        return redirect()->route('publications.page')->with('success', 'Post details archived successfully');
    }

    public function spectrums()
    {
        $spectrums = Spectrum::where('is_archive', 0)
            ->orderBy('id', 'desc')
            ->get();

        return view('spectrum.index', compact('spectrums'));
    }

    public function uploadSpectrum(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'pdf_file' => 'required|mimes:pdf|max:100000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $spectrum = new Spectrum();


        $spectrum->title = $request->title; // Assign the title from the request

        if ($request->hasFile('pdf_file')) {
            $pdfFile = $request->file('pdf_file');
            $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();
            $pdfFile->storeAs('newsletter', $pdfFileName, 'upload');
            $spectrum->pdf_file = 'upload/newsletter/' . $pdfFileName;
        }

        if ($request->hasFile('image')) {
            $coverFile = $request->file('image');
            $coverFileName = time() . '.' . $coverFile->getClientOriginalExtension();
            $coverFile->storeAs('newsletter/img', $coverFileName, 'upload');
            $spectrum->image = 'upload/newsletter/img/' . $coverFileName;
        }

        $spectrum->date_created = now()->format('d-m-Y');
        $spectrum->is_archive = 0;
        $spectrum->save();

        return redirect()->route('spectrum.index')->with('status_success_added', 'success');
    }

    public function fetchSpectrum(Request $request)
    {
        $spectrum = Spectrum::find($request->spec_id);
        if (!$spectrum) {
            return response()->json(['error' => 'No rows found.']);
        }
        return response()->json(['data' => $spectrum]);
    }

    public function updateSpectrum(Request $request)
    {
        $request->validate([
            'spec_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'specFile' => 'nullable|mimes:pdf|max:100000',
            'specImg' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $spectrum = Spectrum::find($request->spec_id);
        if (!$spectrum) {
            return redirect()->back()->withErrors(['Spectrum not found.']);
        }

        if ($request->hasFile('specImg')) {
            $image = $request->file('specImg');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('newsletter/img', $imageName, 'upload');
            $spectrum->image = 'upload/newsletter/img/' . $imageName;
        }

        if ($request->hasFile('specFile')) {
            $pdfFile = $request->file('specFile');
            $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();
            $pdfFile->storeAs('newsletter', $pdfFileName, 'upload');
            $spectrum->pdf_file = 'upload/newsletter/' . $pdfFileName;
        }


        $spectrum->title = $request->title;
        $spectrum->save();

        return redirect()->route('spectrum.index')->with('success', 'Publication updated successfully.');
    }

    public function archiveSpectrum(Request $request)
    {
        $spectrum = Spectrum::find($request->archive_id_input);
        if (!$spectrum) {
            return redirect()->back()->withErrors(['Spectrum not found.']);
        }

        $spectrum->is_archive = 1;
        $spectrum->save();

        return redirect()->route('spectrum.index')->with('success', 'Spectrum archived successfully.');
    }

    public function evaluations()
    {
        $evaluations = Evaluation::where('is_archive', 0)
            ->where('is_default', 1)
            ->orderBy('id', 'desc')
            ->get();

        return view('evaluations.index', compact('evaluations'));
    }

    public function show(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'eval_id' => 'required|integer|exists:evaluation_list,id',
        ]);

        $id = $request->input('eval_id');

        // Fetch the evaluation details
        $evaluation = Evaluation::find($id);
        if (!$evaluation) {
            return redirect()->back()->with('error', 'Evaluation not found');
        }

        // Fetch criteria for the evaluation
        $criteria = Criteria::where('evaluation_id', $id)->get();

        // Fetch questions related to each criteria
        $criteriaWithQuestions = $criteria->map(function ($criteriaItem) {
            $criteriaItem->questions = Question::where('criteria_id', $criteriaItem->id)->get();
            return $criteriaItem;
        });

        return view('evaluations.student.index', compact('evaluation', 'criteriaWithQuestions'));
    }

    public function submitEvaluation(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'eval_id' => 'required|integer|exists:evaluation_list,id',
            'qid.*' => 'required|integer',
            'rate.*' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:255',
        ]);

        // Retrieve the data from the request
        $eval_id = $request->input('eval_id');
        $qid = $request->input('qid');
        $rate = $request->input('rate');
        $comments = $request->input('comments');

        // Retrieve the currently logged-in user's ID
        $userID = Auth::userID();

        // Loop through the responses and save them to the database
        foreach ($qid as $index => $question_id) {
            $response = $rate[$index];

            // Create a new response instance
            $responseModel = new Responses();
            $responseModel->evaluation_id = $eval_id;
            $responseModel->userID = $userID;
            $responseModel->question_id = $question_id;
            $responseModel->response = $response;
            $responseModel->save();
        }

        // Save comments to the database if provided
        if (!empty($comments)) {
            // Create a new comment instance
            $comment = new Comments();
            $comment->evaluation_id = $eval_id;
            $comment->comment = $comments;
            $comment->save();
        }

        // Redirect to another page after successful form submission
        return redirect()->route('evaluation.index');
    }

    public function adminEvaluations()
    {
        $evaluations = Evaluation::where('is_archive', 0)
            ->orderBy('id', 'desc')
            ->get();

        return view('evaluations.admin.index', compact('evaluations'));
    }

    public function storeEvaluation(Request $request)
    {
        $evaluations = new Evaluation();
        $evaluations->year = $request->input('year');
        $evaluations->semester = $request->input('semester');
        $evaluations->title = $request->input('title');

        date_default_timezone_set("Asia/Manila");
        $created_at = date("Y-m-d H:i:s");
        $evaluations->date_created = $created_at;

        $evaluations->status = 2;
        $evaluations->is_default = 0;
        $evaluations->is_archive = 0;

        $evaluations->save();

        return redirect()->route('evaluations.admin.index')->with('success', 'Evaluation added successfully.');
    }

    public function fetchEvaluation(Request $request)
    {
        $evaluations = Evaluation::find($request->eval_id);
        if (!$evaluations) {
            return response()->json(['error' => 'No rows found.']);
        }
        return response()->json(['data' => $evaluations]);
    }

    public function updateEvaluation(Request $request)
    {
        $request->validate([
            'eval_id' => 'required|integer',
            'titles' => 'required|string|max:255',
            'years' => 'required|integer',
            'semesters' => 'required|integer',
            'is_default' => 'required|integer',
        ]);

        $evaluations = Evaluation::find($request->eval_id);
        if (!$evaluations) {
            return redirect()->back()->withErrors(['Evaluation not found.']);
        }

        $evaluations->title = $request->titles;
        $evaluations->year = $request->years;
        $evaluations->semester = $request->semesters;
        $evaluations->is_default = $request->is_default;
        $evaluations->save();

        return redirect()->route('evaluations.admin.index')->with('success', 'Evaluation updated successfully.');
    }

    public function archiveEvaluation(Request $request)
    {
        $evaluations = Evaluation::find($request->archive_id_input);
        if (!$evaluations) {
            return redirect()->back()->withErrors(['Evaluation not found.']);
        }

        $evaluations->is_archive = 1;
        $evaluations->save();

        return redirect()->route('evaluations.admin.index')->with('success', 'Evaluation archived successfully.');
    }

    public function questionnaires()
    {
        $evaluations = Evaluation::where('is_archive', 0)
            ->orderByRaw('ABS(year) DESC, ABS(semester) DESC')
            ->withCount('questions')
            ->get();

        return view('evaluations.admin.questionnaires', compact('evaluations'));
    }

    public function manage($evaluationId)
    {
        $evaluation = Evaluation::findOrFail($evaluationId);
        return view('evaluations.admin.manage', compact('evaluation'));
    }

    public function addQuestion(Request $request, $evaluationId)
    {
        $request->validate([
            'criteria_id' => 'required|exists:criteria_list,id',
            'question' => 'required|string|max:255',
        ]);

        $evaluation = Evaluation::findOrFail($evaluationId);

        $evaluation->questions()->create([
            'criteria_id' => $request->criteria_id,
            'question' => $request->question,
        ]);

        return redirect()->route('questionnaire.manage', $evaluationId)->with('success', 'Question added successfully.');
    }

    public function fetchQuestion(Request $request)
    {
        $question = Question::find($request->question_id);
        if (!$question) {
            return response()->json(['error' => 'No rows found.']);
        }
        return response()->json(['data' => $question]);
    }

    public function updateQuestion(Request $request, $evaluationId)
    {
        $request->validate([
            'question_id' => 'required|exists:question_list,id',
            'questions' => 'required|string|max:255',
        ]);

        $question = Question::findOrFail($request->question_id);
        $question->update([
            'question' => $request->questions,
        ]);

        return redirect()->route('questionnaire.manage', $evaluationId)->with('success', 'Question updated successfully.');
    }

    public function deleteQuestion(Request $request, $evaluationId)
    {
        $request->validate([
            'question_id_input' => 'required|exists:question_list,id',
        ]);

        $question = Question::findOrFail($request->question_id_input);
        $question->delete();

        return redirect()->route('questionnaire.manage', $evaluationId)->with('success', 'Question deleted successfully.');
    }

    public function addCriteria(Request $request, $evaluationId)
    {
        $request->validate([
            'criteria' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Criteria::create([
            'evaluation_id' => $evaluationId,
            'criteria' => $request->criteria,
            'description' => $request->description,
        ]);

        return redirect()->route('questionnaire.manage', $evaluationId)->with('success', 'Criteria added successfully.');
    }

    public function fetchCriteria(Request $request)
    {
        $criteria = Criteria::find($request->criteria_id);
        if (!$criteria) {
            return response()->json(['error' => 'No rows found.']);
        }
        return response()->json(['data' => $criteria]);
    }

    public function updateCriteria(Request $request, $evaluationId)
    {
        $request->validate([
            'criteria_id' => 'required|exists:criteria_list,id',
            'criterias' => 'required|string|max:255',
            'descriptions' => 'required|string|max:255',
        ]);

        $criteria = Criteria::findOrFail($request->criteria_id);
        $criteria->update([
            'criteria' => $request->criterias,
            'description' => $request->descriptions,
        ]);

        return redirect()->route('questionnaire.manage', $evaluationId)->with('success', 'Criteria updated successfully.');
    }

    public function deleteCriteria(Request $request, $evaluationId)
    {
        $request->validate([
            'criteria_id_input' => 'required|exists:criteria_list,id',
        ]);

        $criteria = Criteria::findOrFail($request->criteria_id_input);

        $criteria->questions()->delete();

        $criteria->delete();

        return redirect()->route('questionnaire.manage', $evaluationId)->with('success', 'Criteria and its associated questions deleted successfully.');
    }

    public function report()
    {
        $evaluations = Evaluation::where('is_archive', 0)
            ->orderBy('id', 'desc')
            ->get();

        return view('evaluations.admin.report', compact('evaluations'));
    }

    public function fetchReportInfo(Request $request)
    {
        $evaluationId = $request->input('evaluationID');

        // Fetch evaluation title
        $evaluationTitle = DB::table('evaluation_list')
            ->where('id', $evaluationId)
            ->value('title');

        // Fetch questions related to the selected evaluation
        $questions = DB::table('question_list')
            ->select('id', 'question')
            ->where('evaluation_id', $evaluationId)
            ->get();

        // Fetch user responses for the selected evaluation
        $userResponses = DB::table('responses as r')
            ->select('r.response', 'q.id as question_id', 'q.question')
            ->join('question_list as q', 'r.question_id', '=', 'q.id')
            ->where('r.evaluation_id', $evaluationId)
            ->get();

        // Fetch college counts
        $collegeCounts = DB::table('responses as u')
            ->select('a.college', DB::raw('COUNT(DISTINCT u.userID) as total_colleges'))
            ->join('account as a', 'u.userID', '=', 'a.userID')
            ->where('u.evaluation_id', $evaluationId)
            ->groupBy('a.college')
            ->get();

        // Calculate average scores for questions
        $totalScores = [];
        $countScores = [];
        foreach ($userResponses as $response) {
            $questionId = $response->question_id;
            $score = $response->response;

            if (!isset($totalScores[$questionId])) {
                $totalScores[$questionId] = 0;
                $countScores[$questionId] = 0;
            }

            $totalScores[$questionId] += $score;
            $countScores[$questionId]++;
        }

        foreach ($questions as &$question) {
            $questionId = $question->id;
            $averageScore = ($countScores[$questionId] > 0) ? ($totalScores[$questionId] / $countScores[$questionId]) : 0;
            $question->average_score = round($averageScore, 1);

            // Determine the status based on the average score
            if ($averageScore >= 5) {
                $question->status = 'Very Satisfied';
            } elseif ($averageScore >= 4) {
                $question->status = 'Satisfied';
            } elseif ($averageScore >= 3) {
                $question->status = 'Neutral';
            } elseif ($averageScore >= 2) {
                $question->status = 'Dissatisfied';
            } else {
                $question->status = 'Very Dissatisfied';
            }
        }

        // Prepare response data
        $response = [
            'title' => $evaluationTitle,
            'questions' => $questions,
            'college_counts' => $collegeCounts
        ];

        return response()->json(['data' => $response]);
    }

    public function printInfo($id)
    {
        // Fetch data from the database
        $evaluation = DB::table('evaluation_list')->where('id', $id)->first();
        $questions = DB::table('question_list')->where('evaluation_id', $id)->get();
        $responses = DB::table('responses')
            ->join('question_list', 'responses.question_id', '=', 'question_list.id')
            ->where('responses.evaluation_id', $id)
            ->get();
        $comments = DB::table('comments')->where('evaluation_id', $id)->get();

        // Process data
        $averageScores = [];
        $totalScores = [];
        $countScores = [];

        foreach ($responses as $response) {
            $questionId = $response->question_id;
            $score = $response->response;

            if (!isset($totalScores[$questionId])) {
                $totalScores[$questionId] = 0;
                $countScores[$questionId] = 0;
            }

            $totalScores[$questionId] += $score;
            $countScores[$questionId]++;
        }

        foreach ($questions as &$question) {
            $questionId = $question->id;
            $averageScore = ($countScores[$questionId] > 0) ? ($totalScores[$questionId] / $countScores[$questionId]) : 0;
            $question->average_score = $averageScore;

            if ($averageScore >= 5) {
                $question->status = 'Very Satisfied';
            } elseif ($averageScore >= 4) {
                $question->status = 'Satisfied';
            } elseif ($averageScore >= 3) {
                $question->status = 'Neutral';
            } elseif ($averageScore >= 2) {
                $question->status = 'Dissatisfied';
            } else {
                $question->status = 'Very Dissatisfied';
            }
        }

        // Create a PDF
        $mpdf = new Mpdf();
        $mpdf->WriteHTML('<h3>Evaluation Title: ' . $evaluation->title . '</h3>');
        $mpdf->WriteHTML('<table style="border-collapse: collapse; width: 100%;">');
        $mpdf->WriteHTML('<thead><tr><th>#</th><th>Question</th><th>Average Score</th><th>Status</th></tr></thead><tbody>');

        $i = 1;
        foreach ($questions as $question) {
            $mpdf->WriteHTML('<tr><td>' . $i++ . '</td><td>' . $question->question . '</td><td>' . number_format($question->average_score, 2) . '</td><td>' . $question->status . '</td></tr>');
        }
        $mpdf->WriteHTML('</tbody></table>');

        if (!empty($comments)) {
            $mpdf->WriteHTML('<h4>Comments</h4>');
            foreach ($comments as $comment) {
                $mpdf->WriteHTML('<p>' . $comment->comment . '</p>');
            }
        } else {
            $mpdf->WriteHTML('<p>No comments for this evaluation.</p>');
        }

        $mpdf->Output('Evaluation-Report.pdf', 'D');
    }

    public function listInfo($id)
    {
        $respondents = DB::table('responses')
            ->join('account', 'responses.userID', '=', 'account.userID')
            ->where('responses.evaluation_id', $id)
            ->distinct()
            ->get(['account.fullname', 'account.email', 'account.course', 'account.college']);

        $evaluation = DB::table('evaluation_list')->where('id', $id)->first();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Respondents from ' . $evaluation->title);
        $sheet->setCellValue('A3', 'Name');
        $sheet->setCellValue('B3', 'Course');
        $sheet->setCellValue('C3', 'College');
        $sheet->setCellValue('D3', 'Email');

        $row = 4;
        foreach ($respondents as $respondent) {
            $sheet->setCellValue('A' . $row, $respondent->fullname);
            $sheet->setCellValue('B' . $row, $respondent->course);
            $sheet->setCellValue('C' . $row, $respondent->college);
            $sheet->setCellValue('D' . $row, $respondent->email);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'List-of-respondents.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit;
    }

    public function excelInfo($id)
    {
        $evaluation = DB::table('evaluation_list')->where('id', $id)->first();
        $questions = DB::table('question_list')->where('evaluation_id', $id)->get();
        $responses = DB::table('responses')
            ->join('question_list', 'responses.question_id', '=', 'question_list.id')
            ->where('responses.evaluation_id', $id)
            ->get();
        $comments = DB::table('comments')->where('evaluation_id', $id)->get();
        $collegeRespondents = DB::table('responses')
            ->join('account', 'responses.userID', '=', 'account.userID')
            ->where('responses.evaluation_id', $id)
            ->select('account.college', DB::raw('COUNT(DISTINCT responses.userID) AS total_respondents'))
            ->groupBy('account.college')
            ->get();
        $courseRespondents = DB::table('responses')
            ->join('account', 'responses.userID', '=', 'account.userID')
            ->where('responses.evaluation_id', $id)
            ->select('account.course', DB::raw('COUNT(DISTINCT responses.userID) AS total_respondents'))
            ->groupBy('account.course')
            ->get();

        // Process data
        $averageScores = [];
        $totalScores = [];
        $countScores = [];
        $scaleCountsPerQuestion = [];

        foreach ($responses as $response) {
            $questionId = $response->question_id;
            $score = $response->response;

            if (!isset($totalScores[$questionId])) {
                $totalScores[$questionId] = 0;
                $countScores[$questionId] = 0;
                $scaleCountsPerQuestion[$questionId] = [
                    'Very Dissatisfied' => 0,
                    'Dissatisfied' => 0,
                    'Neutral' => 0,
                    'Satisfied' => 0,
                    'Very Satisfied' => 0,
                ];
            }

            $totalScores[$questionId] += $score;
            $countScores[$questionId]++;

            if ($score == 1) {
                $scaleCountsPerQuestion[$questionId]['Very Dissatisfied']++;
            } elseif ($score == 2) {
                $scaleCountsPerQuestion[$questionId]['Dissatisfied']++;
            } elseif ($score == 3) {
                $scaleCountsPerQuestion[$questionId]['Neutral']++;
            } elseif ($score == 4) {
                $scaleCountsPerQuestion[$questionId]['Satisfied']++;
            } elseif ($score == 5) {
                $scaleCountsPerQuestion[$questionId]['Very Satisfied']++;
            }
        }

        foreach ($questions as &$question) {
            $questionId = $question->id;
            $averageScores[$questionId] = ($countScores[$questionId] > 0) ? ($totalScores[$questionId] / $countScores[$questionId]) : 0;
            $question->average_score = $averageScores[$questionId];

            if ($averageScores[$questionId] >= 5) {
                $question->status = 'Very Satisfied';
            } elseif ($averageScores[$questionId] >= 4) {
                $question->status = 'Satisfied';
            } elseif ($averageScores[$questionId] >= 3) {
                $question->status = 'Neutral';
            } elseif ($averageScores[$questionId] >= 2) {
                $question->status = 'Dissatisfied';
            } else {
                $question->status = 'Very Dissatisfied';
            }
        }

        // Create Excel file
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Evaluation Report: ' . $evaluation->title);
        $sheet->mergeCells('A1:E1');

        $sheet->setCellValue('A3', 'Question');
        $sheet->setCellValue('B3', 'Average Score');
        $sheet->setCellValue('C3', 'Status');
        $sheet->setCellValue('D3', 'Very Dissatisfied');
        $sheet->setCellValue('E3', 'Dissatisfied');
        $sheet->setCellValue('F3', 'Neutral');
        $sheet->setCellValue('G3', 'Satisfied');
        $sheet->setCellValue('H3', 'Very Satisfied');

        $row = 4;
        foreach ($questions as $question) {
            $questionId = $question->id;
            $sheet->setCellValue('A' . $row, $question->question);
            $sheet->setCellValue('B' . $row, number_format($question->average_score, 2));
            $sheet->setCellValue('C' . $row, $question->status);
            $sheet->setCellValue('D' . $row, $scaleCountsPerQuestion[$questionId]['Very Dissatisfied']);
            $sheet->setCellValue('E' . $row, $scaleCountsPerQuestion[$questionId]['Dissatisfied']);
            $sheet->setCellValue('F' . $row, $scaleCountsPerQuestion[$questionId]['Neutral']);
            $sheet->setCellValue('G' . $row, $scaleCountsPerQuestion[$questionId]['Satisfied']);
            $sheet->setCellValue('H' . $row, $scaleCountsPerQuestion[$questionId]['Very Satisfied']);
            $row++;
        }

        $row++;
        $sheet->setCellValue('A' . $row, 'Comments');
        $sheet->mergeCells('A' . $row . ':H' . $row);
        $row++;

        if (!empty($comments)) {
            foreach ($comments as $comment) {
                $sheet->setCellValue('A' . $row, $comment->comment);
                $sheet->mergeCells('A' . $row . ':H' . $row);
                $row++;
            }
        } else {
            $sheet->setCellValue('A' . $row, 'No comments for this evaluation.');
            $sheet->mergeCells('A' . $row . ':H' . $row);
        }

        $row++;
        $sheet->setCellValue('A' . $row, 'Respondents by College');
        $sheet->mergeCells('A' . $row . ':B' . $row);
        $row++;
        $sheet->setCellValue('A' . $row, 'College');
        $sheet->setCellValue('B' . $row, 'Total Respondents');
        $row++;
        foreach ($collegeRespondents as $collegeRespondent) {
            $sheet->setCellValue('A' . $row, $collegeRespondent->college);
            $sheet->setCellValue('B' . $row, $collegeRespondent->total_respondents);
            $row++;
        }

        $row++;
        $sheet->setCellValue('A' . $row, 'Respondents by Course');
        $sheet->mergeCells('A' . $row . ':B' . $row);
        $row++;
        $sheet->setCellValue('A' . $row, 'Course');
        $sheet->setCellValue('B' . $row, 'Total Respondents');
        $row++;
        foreach ($courseRespondents as $courseRespondent) {
            $sheet->setCellValue('A' . $row, $courseRespondent->course);
            $sheet->setCellValue('B' . $row, $courseRespondent->total_respondents);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Evaluation-Report.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit;
    }
}
