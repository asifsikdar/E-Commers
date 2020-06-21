<?php

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
Auth::routes();
Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth']], function () {

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/customer', 'CustomerController@customer')->name('customer');
Route::get('/admin', 'AdminController@admin')->name('admin');
Route::get('/website/info', 'WebInfoController@webinfo')->name('webinfo');
Route::post('/website/info/post', 'WebInfoController@webinfopost')->name('webinfopost');

//category
route::get('/add-category','AsifcategoryController@category');
route::post('/category-post','AsifcategoryController@categorypost');
route::get('/view-category-list','AsifcategoryController@viewpost');
route::get('/category-delete/{cat_id}','AsifcategoryController@deletecat');
route::get('/category-update/{cat_id}','AsifcategoryController@updatecat');
route::put('/category-update-post/{id}','AsifcategoryController@upcategorypost');

//subcategory
route::get('/add-subcategory','subcontroller@subcategory');
route::post('/subcategory-post','subcontroller@subcategorypost');
route::get('/view-subcategory-list','subcontroller@subviewpost');
route::get('/subcategory-delete/{cat_id}','subcontroller@subdeletecat');
route::get('/subcategory-update/{cat_id}','subcontroller@subupdatecat');
//route::put('/subcategory-update-post/{id}','subasifcontroller@subupcategorypost');
//Trashed
route::get('/subcategory-deleted-data','subcontroller@subdeleted');
route::get('/subcategory-restore-data/{id}','subcontroller@subrestore');
route::get('/subcategory-permanent-delete-data/{id}','subcontroller@subpdelete');

//Product
route::get('/add-product','ProductController@product');
route::post('/product-post','ProductController@productpost');
route::get('/viewproduct','ProductController@Productview')->name('productpostview');
route::get('/product-delete/{cat_id}','ProductController@productdelete');
route::get('/product-edit/{pro_id}','ProductController@productedit')->name('productedit');
route::post('proup','ProductController@productupdate')->name('productupdate');


//Cheakout
Route::get('/cheakout/', 'CheakoutController@cheakout')->name('cheakout');
Route::get('/api/get-state-list/{country_id}', 'CheakoutController@GetStateList')->name('GetStateList');
Route::get('/api/get-city-list/{state_id}', 'CheakoutController@GetCityList')->name('GetCityList');
Route::post('/cheakout-payment', 'PaymentController@Payment')->name('Payment');


//...................................Frature Controller ........................
    Route::get('/feature/','FeatureController@feature_Add')->name('feature_Add');
    Route::post('/featurepost/','FeatureController@feature_post')->name('feature_post');
    route::get('view','FeatureController@feature_view')->name('feature_view');
    route::get('view-delete/{id}','FeatureController@feature_delete')->name('feature_delete');
    route::get('view-update/{id}','FeatureController@feature_update')->name('feature_update');
    route::post('/view-update/{id}','FeatureController@feature_update_post')->name('feature_update_post');

});
//Wishlist
Route::get('/wishlist', 'WishlistController@wishlist')->name('wishlist');
Route::get('/single-wishlist/{slug}', 'WishlistController@singlewishlist')->name('singlewishlist');
Route::get('/single-wishlist-delete/{id}', 'WishlistController@singlewishlistdelete')->name('singlewishlistdelete');

//EndWishlist

Route::get('/', 'FrontendController@FrontPage')->name('FrontPage');
Route::get('/item/{slug}', 'FrontendController@SingleProduct')->name('SingleProduct');
Route::get('/shop', 'FrontendController@shop')->name('shop');
Route::get('/single-cart/{slug}', 'FrontendController@SingleCart')->name('SingleCart');
Route::get('/cart', 'CartController@Cart')->name('Cart');
Route::get('/cart/{coupon}', 'CartController@Cart')->name('CouponCart');
Route::get('/single/cart-delete/{id}', 'CartController@SingleCartDelete')->name('SingleCartDelete');
Route::post('/cart-update/', 'CartController@CartUpdate')->name('CartUpdate');
Route::get('login/github', 'SocialController@redirectToProvider')->name('redirectToProvider');
Route::get('login/github/callback', 'SocialController@handleProviderCallback')->name('handleProviderCallback');


Route::post('/review-add', 'ReviewController@review')->name('review');

//Contact
Route::get('/contact/','ContactController@contact')->name('contact');
Route::post('/contact-post/','ContactController@contactpost')->name('contactpost');
Route::get('/about/','ContactController@about')->name('about');
