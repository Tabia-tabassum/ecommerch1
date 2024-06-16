<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;

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

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/about', [SiteController::class, 'About']);
Route::get('/contact', [SiteController::class, 'Contact']);
Route::get('/blog', [SiteController::class, 'Blog']);
Route::get('/details/{id}', [SiteController::class, 'Details']);
Route::post('/product-order/{id}', [SiteController::class, 'orderProduct'])->name('orderProduct');

// authentication
Route::get('/reg', [SiteController::class, 'Registation']);
Route::get('/login', [SiteController::class, 'Login'])->name('admin.login');
Route::post('/admin-registaion', [SiteController::class, 'admin_registaion']);
Route::post('/admin-login', [SiteController::class, 'admin_login']);
Route::post('/admin-logout', [SiteController::class, 'admin_logout']);

// this is admin route
Route::get('/admin', [SiteController::class, 'Admin_Home'])->middleware('AdminAuth');
Route::get('/add-blog', [SiteController::class, 'Add_blog'])->middleware('AdminAuth');
Route::get('/update', [SiteController::class, 'update_blog'])->middleware('AdminAuth');
Route::get('/show-order-details', [SiteController::class, 'showOrderDetails'])->middleware('AdminAuth')->name('show-order-details');
Route::get('/remove-order', [SiteController::class, 'removeOrder'])->middleware('AdminAuth')->name('remove-order');

Route::get('/post-category', [CategoryController::class, 'index'])->name('admin.category')->middleware('AdminAuth');
Route::post('/store-post-category', [CategoryController::class, 'storeCategory'])->name('admin.category.store')->middleware('AdminAuth');
Route::post('/update-post-category', [CategoryController::class, 'updateCategory'])->name('admin.category.update')->middleware('AdminAuth');
Route::get('/delete-post-category', [CategoryController::class, 'deleteCategory'])->name('admin.category.delete')->middleware('AdminAuth');
Route::get('/category/{id}', [CategoryController::class, 'categoryDetails'])->name('admin.category.details');

// admin works
Route::get('/update-form/{id}', [SiteController::class, 'update_form_submit'])->middleware('AdminAuth');
Route::post('/add-blog-submit', [SiteController::class, 'add_blog_submit'])->middleware('AdminAuth');
Route::get('/remove-blog', [SiteController::class, 'remove_blog'])->middleware('AdminAuth');
Route::post('/update-blog-submit', [SiteController::class, 'update_blog_submit_form'])->middleware('AdminAuth');
