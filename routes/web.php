<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;
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

use App\Http\Middleware\VerifyCsrfToken;

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
Route::get('/test', [TestController::class, 'index']);
Route::get('/test/index2', [TestController::class, 'index2']);
Route::get('/test/r/{id?}', function (int $id=null){
    //return "pure.$id";
});

Route::get('/', [IndexController::class, 'index']);
Route::get('/field/{htmlName}', [ContentController::class, 'detail']);
Route::post('/content/addHitAction', [ContentController::class, 'addHitAction']);
Route::get('/category', [CategoryController::class, 'list']);
Route::get('/category/{catName}', [CategoryController::class, 'listFilter']);
Route::get('/tags', [TagsController::class, 'index']);
Route::get('/tags/{tagName}', [TagsController::class, 'list']);
Route::get('/about', [AboutController::class, 'about']);
Route::post("/comment/addEditCommentAction/{commentId?}", [CommentController::class, 'addEditCommentAction']);

Route::get('/message/{message?}/{bool?}', [CommonController::class, 'showMessagePage'])->name('common.message');
Route::get('/captcha', [CaptchaController::class, 'generateCaptcha'])->name('captcha');
Route::post('/convertToPinyin', [CommonController::class, 'convertToPinyin'])->name('convertToPinyin');

$cfAdminPath = env('ADMIN_PATH');

/*
Route::get("/$cfAdminPath/signIn", [AdminMemberController::class, 'signIn']);
Route::post("/$cfAdminPath/signInAction", [AdminMemberController::class, 'signInAction']);
Route::post("/$cfAdminPath/signOutAction", [AdminMemberController::class, 'signOutAction']);
*/

//同一控制器，使用分组的方式简化
Route::controller(AdminMemberController::class)->prefix($cfAdminPath)->group(function ()  {
    Route::get("/signIn",  'signIn');
    Route::post("/signInAction",  'signInAction');
    Route::post("/signOutAction",  'signOutAction');
});

$var = 'test params';

//管理员权限验证
Route::middleware('authAdmin')->prefix($cfAdminPath)->group(function () use($var){
    Route::get("/addEdit/{contentId?}", [AdminContentController::class, 'addEdit']);
    Route::post("/addEditAction/{contentId?}", [AdminContentController::class, 'addEditAction']);
    Route::post("/deleteContentAction", [AdminContentController::class, 'deleteContentAction']);
    Route::get("/addEditCategory/{catName?}", [AdminCategoryController::class, 'addEditCategory']);
    Route::post("/addEditCategoryAction/{catName?}", [AdminCategoryController::class, 'addEditCategoryAction']);
    Route::post("/deleteCommentAction", [AdminCommentController::class, 'deleteCommentAction']);
    Route::post("/uploadFileActionHt", [CommonController::class, 'uploadFileAction'])->withoutMiddleware(VerifyCsrfToken::class);
});
