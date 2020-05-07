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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['/verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/index-slider', 'CategoriesController@indexSlider');
Route::get('/get-cats','CategoriesController@getCategories');
///////////////////////////////////user/////////////////
//gets
Route::get('ajax',function() {
    return view('message');
 });
 Route::post('/getmsg','ProductsController@index');

 
Route::get('/home-page', 'UserController@home');
Route::get('/get-main-cats-for-users','CategoriesController@getMainCatsForUsersLayout');
Route::get('/get-main-cats-for-users','CategoriesController@getMainCatsForUsers');
Route::get('/get-sub-cats-for-users/{id}','CategoriesController@getSubCatsForUsersLayout');
Route::get('/get-sub-cats-for-users/{id}','CategoriesController@getSubCatsForUsers');
Route::match(['get','post'],'/get-products-for-users/{id}/{catUrl}','ProductsController@getProductsThisSubCatForUser');
Route::get('/view-details-product/{id}/{catId}','ProductsController@viewDetailsProduct');
Route::get('/get-my-carts/{user_email}','CartsController@getMyCarts');
Route::get('/view-profile/{user_email}','UserController@viewProfile');
Route::get('/view-all-my-orders-review','UserController@viewAllMyOrdersReview');
Route::get('/view-details-this-order/{order_id}','UserController@orderReviewDetails');
Route::match(['get','post'],'/add-to-my-orders/{product_id}','UserController@AddToMyOrders');
Route::match(['get','post'],'/edit-my-order/{id}','UserController@EditMyOrder');
Route::get('/delete-order/{order_id}','UserController@DeleteOrder');
Route::match(['get','post'], '/add-coupon','CouponController@addCoupon');
Route::match(['get','post'], '/admin/add-coupon','CouponController@addCouponFromAdmin');
// show pages for home page//
Route::get('/view-all-high-tshirt','ProductsController@viewTShirts');
Route::get('/view-all-high-heel-shoes','ProductsController@viewHeelShoes');
Route::get('//view-all-high-makeups','ProductsController@viewHeelMakeups');
Route::get('/view-all-high-normal-shoes','ProductsController@viewNormalShoes');
Route::get('/view-all-high-dress','ProductsController@viewDress');
Route::get('/view-all-high-bags','ProductsController@viewBags');
Route::get('/view-all-most-wanted','ProductsController@viewMostWanted');
Route::get('/view-all-high-feature','ProductsController@viewHighFeature');
Route::get('/view-all-high-price','ProductsController@viewHighPrice');
Route::get('/view-all-high-modern','ProductsController@viewHighModern');
Route::match(['get','post'], '/add-my-review/{product_Attr_id}','ProductsController@addMyReview');
Route::match(['get','post'], '/edit-my-review/{rev_id}/{product_att_id}','ProductsController@editMyReview');
Route::match(['get','post'], '/show-reviewers/delete-my-review/{rev_id}','ProductsController@deleteMyReview');
Route::get('/show-reviewers/{product_id}','ProductsController@ShowReviewers');
//login-reg-logout
Route::match(['get','post'],'/login-user','UserController@loginUser');
Route::match(['get','post'],'/reg-user','UserController@regUser');
Route::get('/confirm/{code}','UserController@confirmAccount');
Route::get('/logout-user','UserController@logoutUser');
//funs
Route::match(['get','post'],'/forget-password','UserController@forgetPassword');
Route::match(['get','post'],'/edit-profile/{id}','UserController@editProfile');
Route::match(['get','post'],'/change-image/{id}','UserController@changeImage');
Route::match(['get','post'],'/update-password/{id}','UserController@updatePassword');
Route::match(['get','post'],'/checkout-shipping/{user_id}','UserController@checkoutShipping');
Route::match(['get','post'],'/checkout-billing/{id}','UserController@checkoutBilling');
Route::get('/add-to-cart/{product_attribute_id}','CartsController@addToCart');
Route::match(['get','post'],'/admin/add-cart','CartsController@addCartFromAdmin');
Route::post('/check-subscriber-email','NewsletterSubscriberController@checkSubscriberEmail');
Route::match(['get','post'], '/search-products','ProductsController@searchProducts');
Route::match(['get','post'], '/search-product','ProductsController@searchProduct');
Route::get('/add-to-my-fav/{product_id}/{product_name}/{size}/{price}','ProductsController@addProductToMyFavourite');
Route::get('/view-my-favs','ProductsController@viewMyFavourites');
Route::get('/delete-from-my-fav/{id}','ProductsController@deleteFromMyFavourites');
Route::match(['get','post'],'/products-filter','ProductsController@productsFilter');//لياخد الريكسوت ويعمل شغلات عاساسه بعد هيك بناء ع هادي الشغلات بدو يوديه ع رابط  اللي هو حنخليه نفس الرابط عرض الفحاة افضل 
Route::match(['get','post'],'/products-filter-size','ProductsController@productsFilterSize');//لياخد الريكسوت ويعمل شغلات عاساسه بعد هيك بناء ع هادي الشغلات بدو يوديه ع رابط  اللي هو حنخليه نفس الرابط عرض الفحاة افضل 
Route::match(['get','post'],'/products-filter-price','ProductsController@productsFilterPrice');//لياخد الريكسوت ويعمل شغلات عاساسه بعد هيك بناء ع هادي الشغلات بدو يوديه ع رابط  اللي هو حنخليه نفس الرابط عرض الفحاة افضل 
Route::match(['get','post'],'/get-products-for-users{id}/{catUrl}','ProductsController@getProductsThisSubCatForUser');//لعرض صفحة فيها الانبوت اللي فيه الرابط وفيها انبوتس الفلتر
Route::match(['get','post'],'/products-filter-view-details','ProductsController@productsFilterForViewDetails');//لياخد الريكسوت ويعمل شغلات عاساسه بعد هيك بناء ع هادي الشغلات بدو يوديه ع رابط  اللي هو حنخليه نفس الرابط عرض الفحاة افضل 
Route::match(['get','post'],'/products-filter-size-view-details','ProductsController@productsFilterSizeForViewDetails');//لياخد الريكسوت ويعمل شغلات عاساسه بعد هيك بناء ع هادي الشغلات بدو يوديه ع رابط  اللي هو حنخليه نفس الرابط عرض الفحاة افضل 
Route::match(['get','post'],'/products-filter-price-view-details','ProductsController@productsPriceFilterForViewDetails');//لياخد الريكسوت ويعمل شغلات عاساسه بعد هيك بناء ع هادي الشغلات بدو يوديه ع رابط  اللي هو حنخليه نفس الرابط عرض الفحاة افضل 
Route::match(['get','post'],'/view-details-product/{id}/{url}','ProductsController@viewDetailsProduct');//لعرض صفحة فيها الانبوت اللي فيه الرابط وفيها انبوتس الفلتر
Route::match(['get','post'],'/view-details-product-attr/{id}','ProductsController@viewDetailsProductAttr');//لعرض صفحة فيها الانبوت اللي فيه الرابط وفيها انبوتس الفلتر
Route::post( '/check-pincode','ProductsController@checkPincodeProduct');
Route::get('/get-my-carts/delete-product-from-cart/{product_id}','CartsController@DeleteProductFromCart');
Route::post('/apply-coupon','CouponController@applyCoupon');
Route::match(['get','post'], '/page-contact','CmsController@contact');
Route::match(['get','post'], '/page/post','CmsController@addPost');

/////////////////////////////////admins//////////////////////////
//gets
Route::match(['get','post'], '/view-coupons','CouponController@viewCoupons');
Route::match(['get','post'], '/user/edit-coupon/{id}','CouponController@UsereditCoupon');
Route::match(['get','post'], '/edit-coupon/{id}','CouponController@AdmineditCoupon');
Route::match(['get','post'], '/delete-coupon/{id}','CouponController@deleteCoupon');
Route::get('/get-main-cats-for-admins','CategoriesController@getMainCatsForAdmins');
Route::get('/get-sub-cats-for-admins/{id}','CategoriesController@getSubCatsForAdmins');
Route::get('/get-products-for-admins/{id}','ProductsController@getProductsThisSubCatForAdmins');
Route::get('/view-details-product-for-admins/{id}','ProductsController@viewDetailsProductAdmin');
Route::get('/view-similar-products-admins/{product_url}','ProductsController@viewSimilarProductsAdmins');
Route::match(['get','post'],'/get-all-carts','CartsController@getAllCarts');
Route::match(['get','post'],'/get-cart/{cart_id}','CartsController@getCart');
Route::match(['get','post'],'/edit-cart/{cart_id}','CartsController@editCart');
Route::match(['get','post'],'/delete-cart/{cart_id}','CartsController@deleteCart');
Route::get('/admin/view-admins','AdminController@viewAdmins');
Route::get('/admin/view-users','AdminController@viewUsers');
Route::get('/view-cms','CmsController@getCms');
Route::get('/admin/view-users-countires-charts','UserController@viewUsersCountriesCharts');
Route::get('/admin/view-users-charts','UserController@viewUsersCharts');
Route::match(['get','post'],'/admin/add-user','AdminController@addUser');
Route::match(['get','post'],'/add-category','CategoriesController@addCategory');
Route::match(['get','post'],'/add-sub-category/{category_id}','CategoriesController@addSubCategory');
Route::match(['get','post'],'/edit-parent-category/{id}','CategoriesController@editParentCategory');
Route::match(['get','post'],'/edit-sub-category/{id}','CategoriesController@editSubCategory');
Route::get('/delete-category/{id}','CategoriesController@deleteCategory');
Route::match(['get','post'],'/add-product','ProductsController@addProduct');
Route::match(['get','post'],'/add-details-product/{id}','ProductsController@addDetailsProduct');
Route::match(['get','post'],'/edit-details-product/{id}','ProductsController@editDetailsProduct');
Route::match(['get','post'],'/delete-details-product/{id}','ProductsController@deleteDetailsProduct');
Route::match(['get','post'],'/view-details-product-for-admins/{id}','ProductsController@viewDetailsProductForAdmin');
Route::match(['get','post'],'/edit-product/{id}','ProductsController@editProduct');
Route::match(['get','post'],'/delete-product/{id}','ProductsController@deleteProduct');
Route::match(['get','post'],'/view-products-attributes','ProductsAttributesController@viewProductAttribute');
Route::match(['get','post'],'/add-product-attribute','ProductsAttributesController@addProductAttribute');
Route::match(['get','post'],'/edit-product-attribute/{id}','ProductsAttributesController@editProductAttribute');
Route::match(['get','post'],'/delete-product-attribute/{id}','ProductsAttributesController@deleteProductAttribute');
Route::match(['get','post'],'/add-cms','CmsController@addCms');
Route::match(['get','post'],'/edit-cms/{id}','CmsController@editCms');
Route::get('/delete-cms/{id}','CmsController@deleteCms');
Route::match(['get','post'],'/view-banners','BannerController@viewBanners');
Route::match(['get','post'],'/add-banner','BannerController@addBanner');
Route::match(['get','post'],'/edit-banner/{id}','BannerController@editBanner');
Route::match(['get','post'],'/delete-banner/{id}','BannerController@deleteBanner');
Route::match(['get','post'],'/admin/add-admin','AdminController@addAdmin');
Route::match(['get','post'],'/admin/edit-admin/{id}','AdminController@editAdmin');
Route::match(['get','post'],'/admin/delete-admin/{id}','AdminController@deleteAdmin');
Route::match(['get','post'],'/admin/edit-user/{id}','AdminController@editUser');
Route::match(['get','post'],'/admin/delete-user/{id}','AdminController@deleteUser');
//login-logout
Route::match(['get','post'],'/login-admin','AdminController@loginAdmin');
Route::get('/logout-admin','AdminController@logoutAdmin');
//placeorder, payment method
Route::get('/paypal','ProductsController@paypal');
Route::get('/paypal/thanks','ProductsController@paypalThanks');
Route::get('/paypal/cancel','ProductsController@paypalCancel');
Route::get('/cdo/thanks','ProductsController@cdoThanks');
Route::get('/cdo/cancel','ProductsController@cdoCancel');

Route::match(['get','post'],'/place-order','ProductsController@placeOrder');
Route::get('/payumoney','PayumoneyController@payumoneyPayment');
 Route::post('/payumoney/response','PayumoneyController@payumoneyResponse');
Route::get('/payumoney/thanks','PayumoneyController@payumoneyThanks');
Route::get('/payumoney/fail','PayumoneyController@payumoneyFail');
Route::get('/payumoney/verification/{order_id}','PayumoneyController@payumoneyVerification');
Route::get('/payumoney/verify','PayumoneyController@payumoneyVerify');
Route::post('/paypal/ipn','ProductsController@ipnPaypal');


 



  








