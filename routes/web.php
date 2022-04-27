<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('chi-tiet-san-pham/{id}', [ProductController::class, 'detailProduct'])->name('product.detail');
Route::get('/', [HomeController::class, 'index']);
Route::get('danh-muc/{slug}', [CategoryController::class, 'index'])->name('product.category');
Route::get('san-pham/{slug}', [ProductController::class, 'productContent']);
Route::get('lien-he', [ContactController::class, 'index']);


Route::get('/quan-tri', [AdminController::class, 'index']);

Route::group(['prefix' => 'quan-tri'], function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('product_line_list/{id}', [AdminController::class, 'getProductLine']);
    Route::get('product_type_list/{id}/{id2}', [AdminController::class, 'getProductType']);

    Route::group(['prefix' => 'san-pham'], function () {
        Route::get('danh-sach', [AdminController::class, 'productList'])->name('admin.product.list');
        Route::get('loai-san-pham', [AdminController::class, 'productType'])->name('admin.product.type');
        Route::get('loai-san-pham/them-moi', [AdminController::class, 'addProductType'])->name('admin.product.type.add');

        Route::get('them-moi', [AdminController::class, 'addProduct'])->name('admin.product.add');
        Route::post('them-moi', [AdminController::class, 'addProductPost'])->name('admin.product.add.post');

        Route::get('xoa/{id}', [AdminController::class, 'delProduct'])->name('admin.product.del');

        Route::get('sua/{id}', [AdminController::class, 'editProduct'])->name('admin.product.edit');
    });


    Route::group(['prefix' => 'khach-hang'], function () {
        Route::get('danh-sach', [AdminController::class, 'customerList']);
        Route::get('don-hang', [AdminController::class, 'orderList']);
    });

    Route::group(['prefix' => 'hang-san-xuat'], function(){
        Route::get('/', [CompanyController::class, 'listCompany'])->name('admin.company.list');
        Route::get('them-moi', [CompanyController::class, 'addCompany'])->name('admin.company.add');
        Route::post('them-moi', [CompanyController::class, 'addCompanyPost'])->name('admin.company.add.post');
        Route::get('sua/{id}', [CompanyController::class, 'editCompany'])->name('admin.company.edit');
        Route::get('xoa/{id}', [CompanyController::class, 'delCompany'])->name('admin.company.del');
    });

    Route::group(['prefix' => 'khoang-gia'], function() {
        Route::get('/', [PriceController::class, 'listPrice'])->name('admin.price.list');
        Route::get('them-moi', [PriceController::class, 'addPrice'])->name('admin.price.add');
        Route::post('them-moi', [PriceController::class, 'addPricePost'])->name('admin.price.add.post');
        Route::get('sua/{id}', [PriceController::class, 'editPrice'])->name('admin.price.edit');
        Route::get('xoa/{id}', [PriceController::class, 'delPrice'])->name('admin.price.del');
    });

    Route::group(['prefix' => 'quan-ly-trang'], function() {
        Route::get('danh-sach', [PageController::class, 'list'])->name('admin.page.list');
        Route::get('them-moi', [PageController::class, 'add'])->name('admin.page.add');
    });
});
Route::get('menu', [AdminController::class, 'menu'])->name('admin.menu.add');
Route::post('menu', [AdminController::class, 'menu']);
Route::get('danh-sach-menu', [AdminController::class, 'menuList'])->name('admin.menu.list');

Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');
