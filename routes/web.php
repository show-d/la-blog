<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\CommentController;

use App\Http\Controllers\Admin\AdminMemberController;
use App\Http\Controllers\Admin\AdminContentController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminCommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index']);
Route::get('/field/{htmlName}', [ContentController::class, 'detail']);
Route::post('/content/addHitAction', [ContentController::class, 'addHitAction']);
Route::get('/category', [CategoryController::class, 'list']);
Route::get('/category/{catName}', [CategoryController::class, 'listFilter']);
Route::get('/tags', [TagsController::class, 'index']);
Route::get('/tags/{tagName}', [TagsController::class, 'list']);
Route::get('/about', [AboutController::class, 'about']);

$cfAdminPath = env('ADMIN_PATH');
Route::get("/$cfAdminPath/signIn", [AdminMemberController::class, 'signIn']);
Route::post("/$cfAdminPath/signInAction", [AdminMemberController::class, 'signInAction']);
Route::post("/signOutAction", [AdminMemberController::class, 'signOutAction']);
Route::get("/$cfAdminPath/addEdit/{contentId?}", [AdminContentController::class, 'addEdit']);
Route::post("/$cfAdminPath/addEditAction/{contentId?}", [AdminContentController::class, 'addEditAction']);
    Route::post("/$cfAdminPath/deleteContentAction", [AdminContentController::class, 'deleteContentAction']);
Route::get("/$cfAdminPath/addEditCategory/{catName?}", [AdminCategoryController::class, 'addEditCategory']);
Route::post("/$cfAdminPath/addEditCategoryAction/{catName?}", [AdminCategoryController::class, 'addEditCategoryAction']);
Route::post("/comment/addEditCommentAction/{commentId?}", [CommentController::class, 'addEditCommentAction']);
Route::post("/$cfAdminPath/deleteCommentAction", [AdminCommentController::class, 'deleteCommentAction']);

Route::get('/message/{message?}/{bool?}', [CommonController::class, 'showMessagePage'])->name('common.message');
Route::get('/captcha', [CaptchaController::class, 'generateCaptcha'])->name('captcha');
Route::post('/signOut', [CaptchaController::class, 'signOut'])->name('signOut');
Route::post('/convertToPinyin', [CommonController::class, 'convertToPinyin'])->name('convertToPinyin');