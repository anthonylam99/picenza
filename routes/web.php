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
use App\Http\Controllers\LoginController;
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
Route::post('add-to-cart', [ProductController::class, 'addToCart'])->name('addToCart');
Route::get('remove-item-to-cart', [ProductController::class, 'removeItemCart'])->name('removeItemCart');
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('danh-muc/{slug}', [CategoryController::class, 'index'])->name('product.category');
Route::get('san-pham/{slug}', [ProductController::class, 'productContent']);
Route::get('lien-he', [ContactController::class, 'index'])->name('contact');
Route::get('danh-muc-hinh-anh', [AdminController::class, 'galery'])->name('admin.galery');
Route::post('/postRatingImage', [CommentController::class, 'postRatingImage'])->name('postRatingImage');
Route::post('/submitRatingComment', [CommentController::class, 'submitRatingComment'])->name('submitRatingComment');
Route::get('/get-image-from-color-and-product-id', [ProductController::class, 'getImageByColorAndProductId'])->name('getImageByColorAndProductId');
Route::post('/update-like-dislike-comment', [CommentController::class, 'updateLikeAndDisLikeCommment'])->name('updateLikeAndDisLikeCommment');
Route::get('/find-comment', [CommentController::class, 'findComment'])->name('findComment');
Route::get('locations/district', [ProductController::class, 'district'])->name('locations.district');
Route::get('locations/ward', [ProductController::class, 'ward'])->name('locations.ward');
Route::post('save-order', [ProductController::class, 'saveOrder'])->name('saveOrder');
Route::post('update-quantity-cart', [ProductController::class, 'updateQtyCart'])->name('updateQtyCart');
Route::get('tin-tuc', [HomeController::class, 'news'])->name('home.news.index');
Route::get('tin-tuc/{slug}', [HomeController::class, 'news'])->name('home.news.index.slug');
Route::get('tim-kiem-san-pham', [ProductController::class, 'searchProduct'])->name('action-search');
Route::post('post-contact', [ContactController::class, 'postContact'])->name('post-contact');
Route::get('so-sanh-san-pham', [ProductController::class, 'compareProduct'])->name('product.compare');
Route::get('search-product', [ProductController::class, 'searchProductApi']);

Route::get('/quan-tri', [AdminController::class, 'index']);
Route::get('/quan-tri/dang-nhap', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/post-login', [LoginController::class, 'authenticate'])->name('postLogin');
Route::get('/post-login', [LoginController::class, 'redirectLogin'])->name('getLogin');
Route::post('/post-logout', [LoginController::class, 'postLogout'])->name('postLogout');

Route::group(['prefix' => 'quan-tri', 'middleware' => 'CheckAdmin'], function () {
    Route::group(['middleware' => 'auth'], function(){
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::get('product_line_list/{id}', [AdminController::class, 'getProductLine']);
        Route::get('product_type_list/{id}/{id2}', [AdminController::class, 'getProductType']);
        Route::get('product_feature_list/{id}', [AdminController::class, 'getProductFeature']);
    });


    Route::group(['prefix' => 'san-pham', 'middleware' => 'auth'], function () {
        Route::get('danh-sach', [AdminController::class, 'productList'])->name('admin.product.list');
        Route::get('update-status-prod', [AdminController::class, 'updateStatusProd'])->name('updateStatus-prod');
        Route::get('loai-san-pham', [AdminController::class, 'productType'])->name('admin.product.type');
        Route::get('loai-san-pham/them-moi', [AdminController::class, 'addProductType'])->name('admin.product.type.add');

        Route::get('them-moi', [AdminController::class, 'addProduct'])->name('admin.product.add');
        Route::post('them-moi', [AdminController::class, 'addProductPost'])->name('admin.product.add.post');

        Route::get('xoa/{id}', [AdminController::class, 'delProduct'])->name('admin.product.del');

        Route::get('sua/{id}', [AdminController::class, 'editProduct'])->name('admin.product.edit');
        Route::get('showhome', [AdminController::class, 'updateStatusHome']);

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
            Route::post('danh-muc-con/xoa', [\App\Http\Controllers\ProductFeatureController::class, 'delSubCategory'])->name('admin.sub.category.del');
        });
    });


    Route::group(['prefix' => 'khach-hang', 'middleware' => 'auth'], function () {
        Route::get('danh-sach', [AdminController::class, 'customerList']);
        Route::get('don-hang', [AdminController::class, 'orderList'])->name('admin.order.list');
        Route::get('chi-tiet-don-hang/{id}', [AdminController::class, 'orderDetail'])->name('admin.order.edit');
        Route::get('cap-nhat-don-hang', [AdminController::class, 'updateOrder'])->name('admin.order.update');
        Route::get('danh-sach-lien-he', [AdminController::class, 'contactList'])->name('admin.contact.list');
        Route::get('chi-tiet-lien-he/{id}', [AdminController::class, 'getDetailContact'])->name('admin.contact.detail');
    });

    Route::group(['prefix' => 'hang-san-xuat', 'middleware' => 'auth'], function(){
        Route::get('/', [CompanyController::class, 'listCompany'])->name('admin.company.list');
        Route::get('them-moi', [CompanyController::class, 'addCompany'])->name('admin.company.add');
        Route::post('them-moi', [CompanyController::class, 'addCompanyPost'])->name('admin.company.add.post');
        Route::get('sua/{id}', [CompanyController::class, 'editCompany'])->name('admin.company.edit');
        Route::get('xoa/{id}', [CompanyController::class, 'delCompany'])->name('admin.company.del');
    });

    Route::group(['prefix' => 'dong-san-pham', 'middleware' => 'auth'], function(){
        Route::get('/', [ProductLineController::class, 'listLine'])->name('admin.line.list');
        Route::get('them-moi', [ProductLineController::class, 'addLine'])->name('admin.line.add');
        Route::post('them-moi', [ProductLineController::class, 'addLinePost'])->name('admin.line.add.post');
        Route::get('sua/{id}', [ProductLineController::class, 'editLine'])->name('admin.line.edit');
        Route::get('xoa/{id}', [ProductLineController::class, 'delLine'])->name('admin.line.del');
        Route::get('update-status', [ProductLineController::class, 'updateStatus']);
    });

    Route::group(['prefix' => 'loai-san-pham', 'middleware' => 'auth'], function(){
        Route::get('/', [ProductTypeController::class, 'listType'])->name('admin.type.list');
        Route::get('them-moi', [ProductTypeController::class, 'addType'])->name('admin.type.add');
        Route::post('them-moi', [ProductTypeController::class, 'addTypePost'])->name('admin.type.add.post');
        Route::get('sua/{id}', [ProductTypeController::class, 'editType'])->name('admin.type.edit');
        Route::get('xoa/{id}', [ProductTypeController::class, 'delType'])->name('admin.type.del');
    });

    Route::group(['prefix' => 'khoang-gia', 'middleware' => 'auth'], function() {
        Route::get('/', [PriceController::class, 'listPrice'])->name('admin.price.list');
        Route::get('them-moi', [PriceController::class, 'addPrice'])->name('admin.price.add');
        Route::post('them-moi', [PriceController::class, 'addPricePost'])->name('admin.price.add.post');
        Route::get('sua/{id}', [PriceController::class, 'editPrice'])->name('admin.price.edit');
        Route::get('xoa/{id}', [PriceController::class, 'delPrice'])->name('admin.price.del');
    });

    Route::group(['prefix' => 'quan-ly-trang', 'middleware' => 'auth'], function() {
        Route::get('danh-sach', [PageController::class, 'list'])->name('admin.page.list');
        Route::get('them-moi', [PageController::class, 'add'])->name('admin.page.add');
        Route::post('them-moi', [PageController::class, 'addPage'])->name('admin.page.add.post');
        Route::get('sua/{id}', [PageController::class, 'editPage'])->name('admin.page.edit');
    });

    Route::group(['prefix' => 'bai-viet', 'middleware' => 'auth'], function() {
        Route::get('/', [PostController::class, 'listPost'])->name('admin.post.list');
        Route::get('them-moi', [PostController::class, 'addPost'])->name('admin.post.add');
        Route::post('them-moi', [PostController::class, 'addPost'])->name('admin.post.add.post');
        Route::get('sua/{id}', [PostController::class, 'editPost'])->name('admin.post.edit');
        Route::get('xoa/{id}', [PostController::class, 'delPost'])->name('admin.post.del');
        Route::get('update-status', [PostController::class, 'updateStatus'])->name('admin.post.updateStatus');
        Route::group(['prefix' => 'tag'], function (){
            Route::get('/', [\App\Http\Controllers\TagController::class, 'listTag'])->name('admin.tag.list');
            Route::get('them-moi', [\App\Http\Controllers\TagController::class, 'addTag'])->name('admin.tag.add');
            Route::post('them-moi', [\App\Http\Controllers\TagController::class, 'addTagPost'])->name('admin.tag.add.post');
            Route::get('sua/{id}', [\App\Http\Controllers\TagController::class, 'editTag'])->name('admin.tag.edit');
            Route::get('xoa/{id}', [\App\Http\Controllers\TagController::class, 'delTag'])->name('admin.tag.del');
            Route::get('update-status', [\App\Http\Controllers\TagController::class, 'updateStatus'])->name('admin.tag.updateStatus');
        });
        Route::group(['prefix' => 'chuyen-muc'], function (){
            Route::get('/', [\App\Http\Controllers\PostCategoryController::class, 'listPostCategory'])->name('admin.post.category.list');
            Route::get('them-moi', [\App\Http\Controllers\PostCategoryController::class, 'addPostCategory'])->name('admin.post.category.add');
            Route::post('them-moi', [\App\Http\Controllers\PostCategoryController::class, 'addPostCategoryPost'])->name('admin.post.category.add.post');
            Route::get('sua/{id}', [\App\Http\Controllers\PostCategoryController::class, 'editPostCategory'])->name('admin.post.category.edit');
            Route::get('xoa/{id}', [\App\Http\Controllers\PostCategoryController::class, 'delPostCategory'])->name('admin.post.category.del');
            Route::get('update-status', [\App\Http\Controllers\PostCategoryController::class, 'updateStatus'])->name('admin.post.category.updateStatus');
        });
    });

    Route::group(['prefix' => 'binh-luan', 'middleware' => 'auth'], function() {
        Route::get('/', [AdminController::class, 'listComment'])->name('admin.comment.list');
        Route::get('chi-tiet/{id}', [AdminController::class, 'detailComment'])->name('admin.comment.edit');
        Route::get('update-status', [AdminController::class, 'updateStatus'])->name('admin.comment.update.status');
    });


});
Route::get('menu', [AdminController::class, 'menu'])->name('admin.menu.add')->middleware(['CheckAdmin' , 'auth']);
Route::post('menu', [AdminController::class, 'menu']);
Route::get('danh-sach-menu', [AdminController::class, 'menuList'])->name('admin.menu.list');



//Trang custom
Route::get('/trang/{slug}', [PageController::class, 'showPage'])->name('page.show.custom');
Route::get('/bai-viet/{slug}', [PostController::class, 'showPost'])->name('page.show.post');

Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');
