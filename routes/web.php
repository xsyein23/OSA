<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ImpuController;
use App\Http\Controllers\ArchivesController;
use App\Http\Controllers\ComplaintsController;
use App\Http\Controllers\CdesuController;
use App\Http\Controllers\GsuController;
use App\Http\Controllers\SouController;
use App\Http\Controllers\SDBController;
use App\Http\Controllers\RegisterController;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/manage-profile', [UserController::class, 'showProfile'])->name('manage-profile');
Route::post('/manage-profile', [UserController::class, 'updateProfile'])->name('manage-profile.post');


Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/news', [WelcomeController::class, 'news'])->name('news.index');
Route::get('/news/allnews', [WelcomeController::class, 'allnews'])->name('news.allnews');
Route::post('/news/fetchYears', [WelcomeController::class, 'fetchYears'])->name('news.fetchYears');
Route::post('/news/fetchMonths', [WelcomeController::class, 'fetchMonths'])->name('news.fetchMonths');
Route::post('/news/fetchMonthEntries', [WelcomeController::class, 'fetchMonthEntries'])->name('news.fetchMonthEntries');
Route::get('/news/details/{id}', [WelcomeController::class, 'show'])->name('news.details');
Route::post('/news/store', [WelcomeController::class, 'store'])->name('news.store');
Route::post('/news/{news}/update', [WelcomeController::class, 'update'])->name('news.update');
Route::post('/news/{news}/archive', [WelcomeController::class, 'archive'])->name('news.archive');
Route::post('/complaint', [WelcomeController::class, 'complaintSubmit'])->name('complaint.submit');


Route::get('/about_us', [AboutUsController::class, 'index'])->name('about_us');
Route::post('/personnel/fetch', [AboutUsController::class, 'fetchPersonnel'])->name('personnel.fetch');
Route::post('/personnel/update', [AboutUsController::class, 'updatePersonnel'])->name('personnel.update');
Route::post('/personnel/archive', [AboutUsController::class, 'archivePersonnel'])->name('personnel.archive');
Route::post('/personnel/store', [AboutUsController::class, 'store'])->name('personnel.store');


Route::get('/impu', [ImpuController::class, 'index'])->name('impu');
Route::post('/upload-handbook', [ImpuController::class, 'uploadHandbook'])->name('upload.handbook');
Route::get('/impu/publications', [ImpuController::class, 'publications'])->name('publications.index');
Route::post('/impu/publications/store', [ImpuController::class, 'storePublication'])->name('publications.store');
Route::post('/impu/publications/fetch', [ImpuController::class, 'fetchPublication'])->name('publications.fetch');
Route::post('/impu/publications/update', [ImpuController::class, 'updatePublication'])->name('publications.update');
Route::post('/impu/publications/archive', [ImpuController::class, 'archivePublication'])->name('publications.archive');
Route::get('/impu/publications/{publication_ID}', [ImpuController::class, 'showPage'])->name('publications.page');
Route::post('/impu/publications/post/store', [ImpuController::class, 'storePost'])->name('posts.store');
Route::get('/impu/publications/details/{id}', [ImpuController::class, 'showDetails'])->name('publications.details');
Route::get('/impu/publications/get-details/{id}', [ImpuController::class, 'getPostDetails'])->name('publications.get-details');
Route::post('/impu/publications/details/update/{id}', [ImpuController::class, 'updatePostDetails'])->name('publications.updatePostDetails');
Route::post('/impu/publications/details/archive/{id}', [ImpuController::class, 'archivePostDetails'])->name('publications.archivePostDetails');
Route::get('/impu/spectrum', [ImpuController::class, 'spectrums'])->name('spectrum.index');
Route::post('/impu/spectrum/upload-spectrum', [ImpuController::class, 'uploadSpectrum'])->name('upload.spectrum');
Route::post('/impu/spectrum/fetch', [ImpuController::class, 'fetchSpectrum'])->name('spectrum.fetch');
Route::post('/impu/spectrum/update', [ImpuController::class, 'updateSpectrum'])->name('spectrum.update');
Route::post('/impu/spectrum/archive', [ImpuController::class, 'archiveSpectrum'])->name('spectrum.archive');
Route::get('/impu/evaluations', [ImpuController::class, 'evaluations'])->name('evaluations.index');
Route::post('/impu/evaluations/student', [ImpuController::class, 'show'])->name('evaluations.student.index');
Route::post('/impu/evaluations/student/submit', [ImpuController::class, 'submitEvaluation'])->name('evaluation.submit');

Route::get('/impu/evaluations/admin/evaluation', [ImpuController::class, 'adminEvaluations'])->name('evaluations.admin.index');
Route::post('/impu/evaluations/admin/evaluation/store', [ImpuController::class, 'storeEvaluation'])->name('evaluation.store');
Route::post('/impu/evaluations/admin/evaluation/fetch', [ImpuController::class, 'fetchEvaluation'])->name('evaluation.fetch');
Route::post('/impu/evaluations/admin/evaluation/update', [ImpuController::class, 'updateEvaluation'])->name('evaluation.update');
Route::post('/impu/evaluations/admin/evaluation/archive', [ImpuController::class, 'archiveEvaluation'])->name('evaluation.archive');

Route::get('/impu/evaluations/admin/questionnaires', [ImpuController::class, 'questionnaires'])->name('questionnaire.index');
Route::get('/impu/evaluations/admin/questionnaires/{evaluation}/manage', [ImpuController::class, 'manage'])->name('questionnaire.manage');
Route::post('/impu/evaluations/admin/questionnaires/{evaluation}/add-question', [ImpuController::class, 'addQuestion'])->name('questionnaire.addQuestion');
Route::post('/impu/evaluations/admin/questionnaires/question-fetch', [ImpuController::class, 'fetchQuestion'])->name('questionnaire.fetchQuestion');
Route::post('/impu/evaluations/admin/questionnaires/{evaluation}/update-question', [ImpuController::class, 'updateQuestion'])->name('questionnaire.updateQuestion');
Route::post('/impu/evaluations/admin/questionnaires/{evaluation}/delete-question', [ImpuController::class, 'deleteQuestion'])->name('questionnaire.deleteQuestion');
Route::post('/impu/evaluations/admin/questionnaires/{evaluation}/add-criteria', [ImpuController::class, 'addCriteria'])->name('questionnaire.addCriteria');
Route::post('/impu/evaluations/admin/questionnaires/criteria-fetch', [ImpuController::class, 'fetchCriteria'])->name('questionnaire.fetchCriteria');
Route::post('/impu/evaluations/admin/questionnaires/{evaluation}/update-criteria', [ImpuController::class, 'updateCriteria'])->name('questionnaire.updateCriteria');
Route::post('/impu/evaluations/admin/questionnaires/{evaluation}/delete-criteria', [ImpuController::class, 'deleteCriteria'])->name('questionnaire.deleteCriteria');

Route::get('/impu/evaluations/admin/report', [ImpuController::class, 'report'])->name('report.index');
Route::post('/impu/evaluations/admin/fetch-report-info', [ImpuController::class, 'fetchReportInfo'])->name('report.fetchReportInfo');
Route::get('/list-info/{downloadID}', [ImpuController::class, 'listInfo'])->name('report.listInfo');
Route::get('/print-info/{downloadID}', [ImpuController::class, 'printInfo'])->name('report.printInfo');
Route::get('/excel-info/{downloadID}', [ImpuController::class, 'excelInfo'])->name('report.excelInfo');
// Route::get('/evaluation/report/{id}', [ImpuController::class, 'generateReport'])->name('evaluation.report');
// Route::get('/evaluation/list/{id}', [ImpuController::class, 'generateList'])->name('evaluation.list');
// Route::get('/evaluation/excel/{id}', [ImpuController::class, 'generateExcel'])->name('evaluation.excel');


Route::get('/archives', [ArchivesController::class, 'showArchives'])->name('archives.index');
Route::post('/archives/fetch', [ArchivesController::class, 'fetchArchives'])->name('archives.fetch');
Route::post('/archives/restore', [ArchivesController::class, 'restore'])->name('archives.restore');


Route::get('/complaints/recent', [ComplaintsController::class, 'index'])->name('complaints.index');
Route::post('/complaints/details', [ComplaintsController::class, 'fetchDetails'])->name('complaints.details');
Route::post('/complaints/reply', [ComplaintsController::class, 'reply'])->name('complaints.reply');
Route::get('/complaints/previous', [ComplaintsController::class, 'previous'])->name('complaints.previous');
Route::post('/complaints/previous/details', [ComplaintsController::class, 'fetchPrevDetails'])->name('previous.details');


Route::get('/cdesu', [CdesuController::class, 'index'])->name('cdesu');
Route::get('/gsu', [GsuController::class, 'index'])->name('gsu');
Route::get('/sou', [SouController::class, 'index'])->name('sou');
Route::get('/sdb', [SDBController::class, 'index'])->name('sdb');
