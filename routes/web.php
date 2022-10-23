<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\NhomsanphamController;
use App\Http\Controllers\SanphamController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CounponsController;
use App\Http\Controllers\TrancisionController;
use App\Http\Middleware\CheckAdminLogin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckOut;
use App\Http\Livewire\TestComponent;
use App\Http\Middleware\CheckCustomer;
use Illuminate\Http\Request;// cho
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/admin/login', [AdminLoginController::class,'getlogin'])->name('admin.getlogin');
Route::post('/admin/login', [AdminLoginController::class,'postlogin'])->name('admin.postlogin');
Route::get('/admin/logout', [AdminLoginController::class,'getlogout'])->name('admin.getlogout');

// ->middleware([CheckAdminLogin::class])
Route::prefix('admin')->name('admin.')->middleware([CheckAdminLogin::class])->group(function(){
    Route::get('/', [AdminLoginController::class, 'dashboard'])->name('dashboard');

    Route::get('/file', function () {
        return view('admin.file');
    })->name('file');

    Route::resources([
        'nhomsanpham' => NhomsanphamController::class,
        'sanpham' => SanphamController::class,
        'usermanagement' => UserManagementController::class,
        'counpons' => CounponsController::class,
        'review' => ReviewController::class,
        'trancision' => TrancisionController::class,
    ]);

});

Route::get('/', function () {
    return view('site.index');
})->name('home');

Route::get('/shop', function () {
    return view('site.shop');
})->name('shop');

Route::get('/cart', function () {
    return view('site.cart');
})->name('cart')->middleware([CheckAdminLogin::class]);


Route::get('/cart1', function () {
    return view('site.test');
})->name('cart1')->middleware([CheckAdminLogin::class]);


Route::get('/orderdetail', function () {
    return view('site.orderdetail');
})->name('orderdetail')->middleware([CheckAdminLogin::class]);

Route::get('/productdetail/{param}',App\Http\Livewire\ProductDetail::class)->name('productdetail')->middleware([CheckAdminLogin::class]);

Route::get('/checkout',App\Http\Livewire\CheckOut::class)->name('checkout')->middleware([CheckAdminLogin::class]);
Route::get('/blog1',App\Http\Livewire\Blog::class)->name('blog');
Route::get('/contact',App\Http\Livewire\Contact::class)->name('contact');
Route::get('/blog-detail',App\Http\Livewire\BlogDetail::class)->name('blog-detail');
Route::get("/register", [RegistrationController::class, 'create'])->name('register');
Route::post("/register/create", [RegistrationController::class, 'store']);

Route::get('/deleteorder/{id_item}',[CheckOut::class, 'deleteOrder'])->name('deleteorder');
Route::get('/returnpayment',[CheckOut::class, 'payment'])->name('returnpayment')->middleware([CheckAdminLogin::class]);


Route::get("/checkoutbycontroller", [CheckOut::class, 'index'])->name('checkoutbycontroller');

Route::post("/checkoutbycontrollercreate", [CheckOut::class, 'create'])->name('checkoutbycontrollercreate');

Route::get("/orderstatus", [CheckOut::class, 'orderstatus'])->name('orderstatus');

Route::put("/user/{id}", [UserManagementController::class, 'change'])->name('change');
Route::get("/modifile/{id}", [UserManagementController::class, 'modifile'])->name('modifile');
Route::delete("/deleteuser/{id}", [UserManagementController::class, 'deleteuser'])->name('deleteuser');

Route::get('uploadfile', function () {
    $flag = 0;
    return view('upload',compact('flag'));
});
Route::get('testfile', function () {
    $flag = 2;
    return view('upload',compact('flag'));
});
Route::post('upload', function (Request $request) {
    // Kiểm tra xem người dùng có upload file nên không
if (!$request->hasFile('image')) {
    // Nếu không thì in ra thông báo

    return "Mời chọn file cần upload";
}

//dd($request->hasFile('image'));
// Nếu có thì thục hiện lưu trữ file vào public/images
$image = $request->file('image');

$storedPath = $image->move('images', $image->getClientOriginalName());
$flag = 1;
$path = $image->getClientOriginalName();
return view('upload',compact('flag','path'));

})->name('upload.handle');
