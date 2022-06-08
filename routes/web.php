<?php

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;

use App\Http\Controllers\BlogController;
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

route::get('/', [BlogController::class, 'blogs'])->name('blogs');
route::get('/blog-edit/{id}', [BlogController::class, 'blog_edit'])->name('blog_edit');
route::post('/blog-edit-action/{id}', [BlogController::class, 'blog_edit_action'])->name('blog_edit_action');
route::get('/blog-delete/{id}', [BlogController::class, 'blog_delete'])->name('blog_delete');
