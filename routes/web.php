<?php


use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SlidshowController;

use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\SubCatController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Backend\UnderSubController;
use App\Models\UnderSubCategory;

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

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

//Route::middleware(['auth: admin'])->group(function () {


Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard')->middleware('auth:admin');
//Admin All Routes
Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');

Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');

Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');

Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');

Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');
//});    // end middleware admin




//User All Routes
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard', compact('user'));
})->name('dashboard');


Route::get('/', [IndexController::class, 'index']);
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');
Route::post('user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');
Route::get('/user/change/password', [IndexController::class, 'UserChangePassword'])->name('change.password');
Route::post('/user/password/update', [IndexController::class, 'UserPasswordUpdate'])->name('user.password.update');



//Admin Brand All Routes
Route::prefix('brand')->group(function () {

    Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brand');

    Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');

    Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');

    Route::post('/update', [BrandController::class, 'BrandUpdate'])->name('brand.update');

    Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
});

// Admin Category All Routes

Route::group(['category' => 'admin'], function () {
    Route::get('/category/view', [CategoryController::class, 'CategoryView'])->name('all.category');

    Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');

    Route::get('/edit/{id}', [CategoryController::class, 'CategorydEdit'])->name('category.edit');

    Route::post('/update/{id}', [CategoryController::class, 'CategorydUpdate'])->name('category.update');

    Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');
    Route::resource('sub_cat', SubCatController::class);

    // Admin SubCategory All Routes

    Route::get('/sub/view', [SubCategoryController::class, 'SubCategoryView'])->name('all.subcategory');

    Route::post('/sub/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');

    Route::get('/sub/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');

    Route::post('/sub/update', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');

    Route::get('/sub/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');

    Route::get('/under_sub', [UnderSubController::class, 'UnderSubCategoryView'])->name('under_sub.all');

    Route::post('/under_sub', [UnderSubController::class, 'SubCategoryStore'])->name('under_sub.store');

    Route::get('/under_sub{id}', [SubCategoryController::class, 'UnderSubCategoryEdit'])->name('subcategory.edit');
    // Admin Sub->SubCategory All Routes

    Route::get('/sub/sub/view', [SubCategoryController::class, 'SubSubCategoryView'])->name('all.subsubcategory');

    Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);

    Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubSubCategory']);
});
// Route::prefix('category')->group(function () {

//     Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');

//     Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');

//     Route::get('/edit/{id}', [CategoryController::class, 'CategorydEdit'])->name('category.edit');

//     Route::post('/update/{id}', [CategoryController::class, 'CategorydUpdate'])->name('category.update');

//     Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');
//     Route::resource('sub_cat', SubCatController::class);

//     // Admin SubCategory All Routes

//     Route::get('/sub/view', [SubCategoryController::class, 'SubCategoryView'])->name('all.subcategory');

//     Route::post('/sub/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');

//     Route::get('/sub/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');

//     Route::post('/sub/update', [SubCategoryController::class, 'SubCategorydUpdate'])->name('subcategory.update');

//     Route::get('/sub/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');

//     // Admin Sub->SubCategory All Routes

//     Route::get('/sub/sub/view', [SubCategoryController::class, 'SubSubCategoryView'])->name('all.subsubcategory');

//     Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);

//     Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubSubCategory']);
// });





// Admin Products All Routes

Route::prefix('product')->group(function () {

    Route::get('/add', [ProductController::class, 'AddProduct'])->name('add-product');

    Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product-store');

    Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');

    Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit');

    Route::post('/data/update', [ProductController::class, 'ProductDataUpdate'])->name('product-update');

    Route::post('/image/update/', [ProductController::class, 'MultiImageUpdate'])->name('update-product-image');

    Route::post('/thambnail/update', [ProductController::class, 'ThambnailImageUpdate'])->name('update-product-thambnail');

    Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');

    Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');

    Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');

    Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');
});



// Admin Slidshow All Routes

Route::prefix('slidshow')->group(function () {

    Route::get('/view', [SlidshowController::class, 'SlidshowView'])->name('manage-slidshow');

    Route::post('/store', [SlidshowController::class, 'SlidshowStore'])->name('slidshow.store');

    Route::get('/edit/{id}', [SlidshowController::class, 'SlidshowEdit'])->name('slidshow.edit');

    Route::post('/update', [SlidshowController::class, 'SlidshowUpdate'])->name('slidshow.update');

    Route::get('/delete/{id}', [SlidshowController::class, 'SlidshowDelete'])->name('slidshow.delete');

    Route::get('/inactive/{id}', [SlidshowController::class, 'SlidshowInactive'])->name('slidshow.inactive');

    Route::get('/active/{id}', [SlidshowController::class, 'SlidshowActive'])->name('slidshow.active');
});

/////// Frontend All Routes //////////
// Frontend Product Details Page url

Route::get('product/details/{id}', [IndexController::class, 'ProductDetails']);
