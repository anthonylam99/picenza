<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProductLineController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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
Route::get('gio-hang', [ProductController::class, 'cart'])->name('product.cart');
Route::get('/', [HomeController::class, 'index']);
Route::get('danh-muc/{slug}', [CategoryController::class, 'index'])->name('product.category');
Route::get('san-pham/{slug}', [ProductController::class, 'productContent']);
Route::get('lien-he', [ContactController::class, 'index']);
Route::get('danh-muc-hinh-anh', [AdminController::class, 'galery'])->name('admin.galery');
Route::post('/postRatingImage', [CommentController::class, 'postRatingImage'])->name('postRatingImage');
Route::post('/submitRatingComment', [CommentController::class, 'submitRatingComment'])->name('submitRatingComment');
Route::get('/get-image-from-color-and-product-id', [ProductController::class, 'getImageByColorAndProductId'])->name('getImageByColorAndProductId');
Route::get('/update-like-dislike-comment', [CommentController::class, 'updateLikeAndDisLikeCommment'])->name('updateLikeAndDisLikeCommment');
Route::get('/find-comment', [CommentController::class, 'findComment'])->name('findComment');

Route::get('/quan-tri', [AdminController::class, 'index']);

Route::group(['prefix' => 'quan-tri'], function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('product_line_list/{id}', [AdminController::class, 'getProductLine']);
    Route::get('product_type_list/{id}/{id2}', [AdminController::class, 'getProductType']);
    Route::get('product_feature_list/{id}', [AdminController::class, 'getProductFeature']);

    Route::group(['prefix' => 'san-pham'], function () {
        Route::get('danh-sach', [AdminController::class, 'productList'])->name('admin.product.list');
        Route::get('loai-san-pham', [AdminController::class, 'productType'])->name('admin.product.type');
        Route::get('loai-san-pham/them-moi', [AdminController::class, 'addProductType'])->name('admin.product.type.add');

        Route::get('them-moi', [AdminController::class, 'addProduct'])->name('admin.product.add');
        Route::post('them-moi', [AdminController::class, 'addProductPost'])->name('admin.product.add.post');

        Route::get('xoa/{id}', [AdminController::class, 'delProduct'])->name('admin.product.del');

        Route::get('sua/{id}', [AdminController::class, 'editProduct'])->name('admin.product.edit');

        Route::group(['prefix' => 'tinh-nang'], function (){
            Route::get('/', [\App\Http\Controllers\ProductFeatureController::class, 'listProductFeature'])->name('admin.product.feature.list');
            Route::get('them-moi', [\App\Http\Controllers\ProductFeatureController::class, 'addProductFeature'])->name('admin.product.feature.add');
            Route::post('them-moi', [\App\Http\Controllers\ProductFeatureController::class, 'addPostProductFeature'])->name('admin.product.feature.add.post');
            Route::get('sua/{id}', [\App\Http\Controllers\ProductFeatureController::class, 'editProductFeature'])->name('admin.product.feature.edit');
            Route::get('xoa/{id}', [\App\Http\Controllers\ProductFeatureController::class, 'delProductFeature'])->name('admin.product.feature.del');
            Route::post('add-sub-category', [\App\Http\Controllers\ProductFeatureController::class, 'addSubCategory']);
            Route::get('danh-muc-con/sua/{id}', [\App\Http\Controllers\ProductFeatureController::class, 'editSubCategory'])->name('admin.sub.category.edit');
            Route::post('danh-muc-con/sua/{id}', [\App\Http\Controllers\ProductFeatureController::class, 'editSubCategory'])->name('admin.sub.category.edit.post');
            Route::get('danh-muc-con/yeu-thich', [\App\Http\Controllers\ProductFeatureController::class, 'makeFavourite']);
        });
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

    Route::group(['prefix' => 'dong-san-pham'], function(){
        Route::get('/', [ProductLineController::class, 'listLine'])->name('admin.line.list');
        Route::get('them-moi', [ProductLineController::class, 'addLine'])->name('admin.line.add');
        Route::post('them-moi', [ProductLineController::class, 'addLinePost'])->name('admin.line.add.post');
        Route::get('sua/{id}', [ProductLineController::class, 'editLine'])->name('admin.line.edit');
        Route::get('xoa/{id}', [ProductLineController::class, 'delLine'])->name('admin.line.del');
        Route::get('update-status', [ProductLineController::class, 'updateStatus']);
        Route::get('showhome', [ProductLineController::class, 'updateStatusHome']);
    });

    Route::group(['prefix' => 'loai-san-pham'], function(){
        Route::get('/', [ProductTypeController::class, 'listType'])->name('admin.type.list');
        Route::get('them-moi', [ProductTypeController::class, 'addType'])->name('admin.type.add');
        Route::post('them-moi', [ProductTypeController::class, 'addTypePost'])->name('admin.type.add.post');
        Route::get('sua/{id}', [ProductTypeController::class, 'editType'])->name('admin.type.edit');
        Route::get('xoa/{id}', [ProductTypeController::class, 'delType'])->name('admin.type.del');
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
        Route::post('them-moi', [PageController::class, 'addPage'])->name('admin.page.add.post');
        Route::get('sua/{id}', [PageController::class, 'editPage'])->name('admin.page.edit');
    });

    Route::group(['prefix' => 'bai-viet'], function() {
        Route::get('/', [PostController::class, 'listPost'])->name('admin.post.list');
        Route::get('them-moi', [PostController::class, 'addPost'])->name('admin.post.add');
        Route::post('them-moi', [PostController::class, 'addPost'])->name('admin.post.add.post');
        Route::get('sua/{id}', [PostController::class, 'editPost'])->name('admin.post.edit');
        Route::get('xoa/{id}', [PostController::class, 'delPost'])->name('admin.post.del');
        Route::group(['prefix' => 'tag'], function (){
            Route::get('/', [\App\Http\Controllers\TagController::class, 'listTag'])->name('admin.tag.list');
            Route::get('them-moi', [\App\Http\Controllers\TagController::class, 'addTag'])->name('admin.tag.add');
            Route::post('them-moi', [\App\Http\Controllers\TagController::class, 'addTagPost'])->name('admin.tag.add.post');
            Route::get('sua/{id}', [\App\Http\Controllers\TagController::class, 'editTag'])->name('admin.tag.edit');
            Route::get('xoa/{id}', [\App\Http\Controllers\TagController::class, 'delTag'])->name('admin.tag.del');
        });
        Route::group(['prefix' => 'chuyen-muc'], function (){
            Route::get('/', [\App\Http\Controllers\PostCategoryController::class, 'listPostCategory'])->name('admin.post.category.list');
            Route::get('them-moi', [\App\Http\Controllers\PostCategoryController::class, 'addPostCategory'])->name('admin.post.category.add');
            Route::post('them-moi', [\App\Http\Controllers\PostCategoryController::class, 'addPostCategoryPost'])->name('admin.post.category.add.post');
            Route::get('sua/{id}', [\App\Http\Controllers\PostCategoryController::class, 'editPostCategory'])->name('admin.post.category.edit');
            Route::get('xoa/{id}', [\App\Http\Controllers\PostCategoryController::class, 'delPostCategory'])->name('admin.post.category.del');
        });
    });


});
Route::get('menu', [AdminController::class, 'menu'])->name('admin.menu.add');
Route::post('menu', [AdminController::class, 'menu']);
Route::get('danh-sach-menu', [AdminController::class, 'menuList'])->name('admin.menu.list');



//Trang custom
Route::get('/trang/{slug}', [PageController::class, 'showPage'])->name('page.show.custom');
Route::get('/bai-viet/{slug}', [PostController::class, 'showPost'])->name('page.show.post');

Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');
