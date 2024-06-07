<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Publications;
use App\Models\Publish;
use App\Models\Spectrum;
use App\Models\Evaluation;
use App\Models\Personnel;
use App\Models\Announcement;

use Illuminate\Support\Facades\DB;

class ArchivesController extends Controller
{
    public function index()
    {
        return view('archives.index');
    }

    // public function fetch(Request $request)
    // {
    //     $option = $request->input('option');
    //     switch ($option) {
    //         case '1':
    //             $archives = DB::table('announcement')->where('is_archive', 1)->get();
    //             break;
    //         case '2':
    //             $archives = DB::table('publication_page')->where('is_archive', 1)->get();
    //             break;
    //         case '3':
    //             $archives = DB::table('publish_post')
    //                 ->leftJoin('publication_page', 'publish_post.own_by', '=', 'publication_page.id')
    //                 ->where('publish_post.is_archive', 1)
    //                 ->select('publish_post.*', 'publication_page.title as publication_page_name')
    //                 ->get();
    //             break;
    //         case '4':
    //             $archives = DB::table('evaluation_list')->where('is_archive', 1)->get();
    //             break;
    //         case '5':
    //             $archives = DB::table('spectrum_post')->where('is_archive', 1)->get();
    //             break;
    //         case '6':
    //             $archives = DB::table('personnel')->where('is_archive', 1)->get();
    //             break;
    //         default:
    //             $archives = collect();
    //     }

    //     return view('archives.partials.archive_data', compact('archives', 'option'));
    // }

    public function showArchives()
    {
        $role = Session::get('role');
        $publications = Publications::where('is_archive', 1)
            ->orderBy('id', 'desc')
            ->get();
        $spectrums = Spectrum::where('is_archive', 1)
            ->orderBy('id', 'desc')
            ->get();
        $evaluations = Evaluation::where('is_archive', 1)
            ->orderBy('id', 'desc')
            ->get();
        $personnel = Personnel::where('is_archive', 1)
            ->orderBy('id', 'desc')
            ->get();
        $publish = Publish::where('is_archive', 1)
            ->with('publicationPage')
            ->orderBy('id', 'desc')
            ->get();
        $announcements = Announcement::where('is_archive', 1)
            ->orderBy('date_created', 'desc')
            ->get();

        return view('archives.index', compact('publications', 'role', 'spectrums', 'evaluations', 'personnel', 'publish', 'announcements'));
    }

    public function fetchArchives(Request $request)
    {
        $option = $request->option;
        $archives = [];

        switch ($option) {
            case 'announcements':
                $archives = Announcement::where('is_archive', 1)->orderBy('id', 'desc')->get();
                break;
            case 'publications':
                $archives = Publications::where('is_archive', 1)->orderBy('id', 'desc')->get();
                break;
            case 'publish':
                $archives = Publish::where('is_archive', 1)
                    ->with('publicationPage') // Load the publicationPage relationship
                    ->orderBy('id', 'desc')
                    ->get();
                break;
                // case 'publish':
                //     $archives = Publish::where('is_archive', 1)->orderBy('id', 'desc')->get();
                //     break;
            case 'evaluations':
                $archives = Evaluation::where('is_archive', 1)->orderBy('id', 'desc')->get();
                break;
            case 'spectrums':
                $archives = Spectrum::where('is_archive', 1)->orderBy('id', 'desc')->get();
                break;
            case 'personnel':
                $archives = Personnel::where('is_archive', 1)->orderBy('id', 'desc')->get();
                break;
        }

        $view = view('archives.archive_data', compact('option', 'archives'))->render();

        return response()->json(['html' => $view]);
    }

    public function restore(Request $request)
    {
        $type = $request->input('type');
        $id = $request->input('id');

        switch ($type) {
            case 'announcement':
                $archive = Announcement::find($id);
                if ($archive) {
                    $archive->is_archive = 0;
                    $archive->save();
                }
                break;
            case 'page':
                $archive = Publications::find($id);
                if ($archive) {
                    $archive->is_archive = 0;
                    $archive->save();
                }
                break;
            case 'publish':
                $archive = Publish::find($id);
                if ($archive) {
                    $archive->is_archive = 0;
                    $archive->save();
                }
                break;
            case 'spectrum':
                $archive = Spectrum::find($id);
                if ($archive) {
                    $archive->is_archive = 0;
                    $archive->save();
                }
                break;
            case 'evaluation':
                $archive = Evaluation::find($id);
                if ($archive) {
                    $archive->is_archive = 0;
                    $archive->save();
                }
                break;
            case 'personnel':
                $archive = Personnel::find($id);
                if ($archive) {
                    $archive->is_archive = 0;
                    $archive->save();
                }
                break;
                // Add cases for other types of archives as needed
            default:
                // Handle unknown archive type
                break;
        }

        return redirect()->back()->with('success', 'Record restored successfully.');
    }
}
