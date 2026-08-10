<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Mastercontroller;
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ChildcategoryController; 
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TrackorderController;
use App\Http\Controllers\SubscriberController; 
use App\Http\Controllers\Admin\UserDashboardController;
use App\Http\Controllers\SocialShareButtonsController;
use Illuminate\Support\Facades\Artisan;
      
//        
           
/*       
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/posts', [SocialShareButtonsController::class,'ShareWidget']);

Route::get('profile', [FrontendController::class, 'profileindex']);
Route::get('profile/{number}', [FrontendController::class, 'profilenumberindex']);
Route::get('notexist', [FrontendController::class, 'notexist']);

Route::get('/load-more-portfolios', [FrontendController::class, 'loadMorePortfolios'])->name('load.more.portfolios');

Route::post('/uploaddoc',[FrontendController::class,'uploaddoc'])->name('uploaddoc');
Route::get(url('/{number}'), [FrontendController::class, 'profilenumberdata']);
Route::post('profile-location-track', [FrontendController::class, 'trackProfileLocation'])->name('profile.location.track');
Route::post('profile-engagement', [FrontendController::class, 'trackProfileEngagement'])->name('profile.engagement.track');
Route::get('blog-page', [FrontendController::class, 'blogpage']);
Route::get('portfolio-details', [FrontendController::class, 'portfoliodetails']);
Route::get('Corporate', [FrontendController::class, 'corporate'])->name('corporate');
Route::get('jointeam', [FrontendController::class, 'jointeam'])->name('jointeam');
Route::get('raf_create_vcard/{customer}',[FrontendController::class,'raf_create_vcard'])->name('raf_create_vcard');
Route::post('product_enquery',[FrontendController::class,'product_enquery']);

Route::view('trackyourorder', 'userdashboard/order/trackyourorder');
Route::view('landing_profilemeet', 'frontend/profilemeetlanding/index');
Route::get('faq',[FrontendController::class,'faq']);

// Theme Preview Routes
Route::get('theme-preview-test', function() {
    return response()->json([
        'status' => 'OK',
        'message' => 'Theme preview routes are working',
        'profession_themes_exist' => class_exists('App\\Models\\ProfessionTheme'),
        'config_exists' => config('theme-samples.medical') !== null,
        'views_exist' => view()->exists('frontend.profile-themes.medical'),
    ]);
});

// Debug route to test all theme functionality
Route::get('theme-debug', function() {
    $debug = [];

    // Test ProfessionTheme model
    $debug['model_exists'] = class_exists('App\\Models\\ProfessionTheme');
    $debug['themes_count'] = 0;
    try {
        $debug['themes_count'] = \App\Models\ProfessionTheme::count();
        $debug['sample_theme'] = \App\Models\ProfessionTheme::first();
    } catch (\Exception $e) {
        $debug['model_error'] = $e->getMessage();
    }

    // Test config file
    $debug['config_loaded'] = config('theme-samples.medical') !== null;
    $debug['config_keys'] = config('theme-samples') ? array_keys(config('theme-samples')) : [];

    // Test views
    $debug['preview_wrapper_exists'] = view()->exists('frontend.profile-themes.preview-wrapper');
    $debug['medical_template_exists'] = view()->exists('frontend.profile-themes.medical');

    // Test FrontendController method
    $debug['frontend_controller_exists'] = class_exists('App\\Http\\Controllers\\FrontendController');
    $debug['frontend_method_exists'] = method_exists('App\\Http\\Controllers\\FrontendController', 'themePreview');

    // Test AdminController method
    $debug['admin_controller_exists'] = class_exists('App\\Http\\Controllers\\Admin\\AdminController');
    $debug['admin_method_exists'] = method_exists('App\\Http\\Controllers\\Admin\\AdminController', 'themeLivePreview');

    // Test routes
    $routes = \Route::getRoutes();
    $debug['theme_preview_route'] = $routes->getByName('theme.preview') ? 'exists' : 'missing';
    $debug['theme_live_preview_route'] = $routes->getByName('theme.live.preview') ? 'exists' : 'missing';

    // Test RestaurantInfo model
    $debug['restaurant_info_model'] = class_exists('App\\Models\\RestaurantInfo');

    return response()->json($debug, 200, [], JSON_PRETTY_PRINT);
});

Route::get('theme-preview/{slug}', [FrontendController::class, 'themePreview'])->name('theme.preview');

Route::get('blog-list',[FrontendController::class,'blog_list']);
Route::get('blog-details',[FrontendController::class,'blog_details']);

// Pre order frontend
Route::get('preorder',[FrontendController::class,'preorder']);

Route::POST('savepreorder',[FrontendController::class,'savepreorder']);

Route::view('loginn', 'frontend/loginn');
Route::view('/term_condition','frontend/term_condition')->name('term_condition');

// Route::view('/privecy_policy','frontend/privecy_policy')->name('privecy_policy');

/* anand start code */
Route::view('/privacy_policy','frontend/privacy_policy')->name('privacy_policy');

Route::view('/terms_&_condition','frontend/terms_&_condition')->name('terms_&_condition');
Route::view('/return_&_refund_policy','frontend/return_&_refund_policy')->name('return_&_refund_policy');
Route::view('/shipping_&_delivery_policy','frontend/shipping_&_delivery_policy')->name('shipping_&_delivery_policy');


/*anand end code */


Route::view('/header','frontend/header')->name('header');

Route::view('/profile_view','userdashboard/profile/proflle_view');

Route::get('/order.status', [AdminController::class, 'changeorderstatus']);

 
// Route::view('/uploadfile', 'userdashboard.uploadfile.add_upload');
Route::get('/uploadfile',[FrontendController::class,'mydocument']);
Route::get('/deletefile/{id}/{file}',[FrontendController::class,'deletefile']);
Route::get('/leads',[FrontendController::class,'leads']);
Route::post('/message',[FrontendController::class,'message'])->name('message');
// profile_view
//userdashboard

Route::get('userdashboard', [AdminController::class, 'userdashboard']);

Route::get('myorder', [AdminController::class, 'myorder']);
Route::get('goldenuser', [AdminController::class, 'goldenuser']);


Route::get('qrcode', [AdminController::class, 'qrcode']);
Route::get('userorderview{id}', [AdminController::class, 'userorderview']);
Route::get('updateuserprofile', [AdminController::class, 'showuserprofile']);
Route::post('updateuserprofile_store', [AdminController::class, 'updateuserprofile']);

// Profile Theme Selection
Route::get('profile-theme', [AdminController::class, 'profileTheme']);
Route::post('profile-theme/select', [AdminController::class, 'selectProfileTheme']);
Route::post('profile-theme/customize', [AdminController::class, 'saveThemeCustomization']);
Route::get('profile-pdf/request/{slug}', [FrontendController::class, 'profilePdfRequest'])->where('slug', '[a-z0-9\\-]+')->name('profile.pdf.request');
Route::get('profile-pdf/status/{id}', [FrontendController::class, 'profilePdfStatus'])->where('id', '[0-9]+')->name('profile.pdf.status');
Route::get('profile-pdf/download/{id}', [FrontendController::class, 'profilePdfDownload'])->where('id', '[0-9]+')->name('profile.pdf.download');
Route::get('{slug}/pdf', [FrontendController::class, 'profilePdf'])->where('slug', '[a-z0-9\\-]+')->name('profile.pdf');
Route::get('theme-live-preview/{themeId}', [AdminController::class, 'themeLivePreview'])->name('theme.live.preview');

// Profile Visibility Settings
Route::get('profile-settings/visibility', [AdminController::class, 'visibilitySettings'])->name('profile.visibility');
Route::post('profile-settings/visibility/update', [AdminController::class, 'updateVisibilitySettings'])->name('profile.visibility.update');
Route::post('profile-settings/visibility/reset', [AdminController::class, 'resetVisibilitySettings'])->name('profile.visibility.reset');

// Menu Management (for Restaurant Theme)
Route::get('mymenu', [AdminController::class, 'myMenu']);
Route::get('mymenu/category/create', [AdminController::class, 'createMenuCategory']);
Route::post('mymenu/category/store', [AdminController::class, 'storeMenuCategory']);
Route::get('mymenu/category/{id}/edit', [AdminController::class, 'editMenuCategory']);
Route::post('mymenu/category/{id}/update', [AdminController::class, 'updateMenuCategory']);
Route::post('mymenu/category/{id}/toggle', [AdminController::class, 'toggleMenuCategory']);
Route::delete('mymenu/category/{id}/delete', [AdminController::class, 'deleteMenuCategory']);
Route::post('mymenu/category/reorder', [AdminController::class, 'reorderMenuCategories']);
Route::get('mymenu/category/{id}/items', [AdminController::class, 'categoryItems']);
Route::get('mymenu/item/create', [AdminController::class, 'createMenuItem']);
Route::post('mymenu/item/store', [AdminController::class, 'storeMenuItem']);
Route::get('mymenu/item/{id}/edit', [AdminController::class, 'editMenuItem']);
Route::post('mymenu/item/{id}/update', [AdminController::class, 'updateMenuItem']);
Route::post('mymenu/item/{id}/toggle', [AdminController::class, 'toggleMenuItem']);
Route::post('mymenu/item/{id}/bestseller', [AdminController::class, 'toggleMenuItemBestseller']);
Route::delete('mymenu/item/{id}/delete', [AdminController::class, 'deleteMenuItem']);

Route::get('changepassword', [AdminController::class, 'changepassword']);
Route::post('updatepassword', [AdminController::class, 'updatepassword']);

Route::get('myqualification', [AdminController::class, 'myqualification']);
Route::get('addqualification', [AdminController::class, 'addqualification']);
Route::post('savequalifiaction', [AdminController::class, 'savequalifiaction']);
Route::get('editqualification{id}',[AdminController::class,'editqualification']);
Route::POST('updatequalifiaction',[AdminController::class,'updatequalification']);
Route::get('deletequalification{id}',[AdminController::class,'deletequalification']);


Route::get('myprofessions', [AdminController::class, 'myprofessions']);
Route::get('addprofessions', [AdminController::class, 'addprofessions']);
Route::post('saveprofessions', [AdminController::class, 'saveprofessions']);
Route::get('editprofessions{id}',[AdminController::class,'editprofessions']);
Route::POST('updateprofessions',[AdminController::class,'updateprofessions']);
Route::get('deleteprofessions{id}',[AdminController::class,'deleteprofessions']);
Route::get('viewprofessions{id}',[AdminController::class,'viewprofessions']);



Route::get('mythought', [AdminController::class, 'mythought']);
Route::get('addthought', [AdminController::class, 'addthought']);
Route::post('savethought', [AdminController::class, 'savethought']);
Route::get('editthought{id}',[AdminController::class,'editthought']);
Route::POST('updatethought',[AdminController::class,'updatethought']);
Route::get('deletethought{id}',[AdminController::class,'deletethought']);

// personal photos
Route::get('myportfolio', [AdminController::class, 'myportfolio']);
Route::get('addportfolio', [AdminController::class, 'addportfolio']);
Route::post('saveportfolio', [AdminController::class, 'saveportfolio']);
Route::get('editportfolio{id}',[AdminController::class,'editportfolio']);
Route::POST('updateportfolio',[AdminController::class,'updateportfolio']);
Route::get('deleteportfolio{id}',[AdminController::class,'deleteportfolio']);

// professonal photos

Route::get('professional_photos', [AdminController::class, 'professional_photos']);
Route::get('addprofessional_photo', [AdminController::class, 'addprofessional_photo']);
Route::post('saveprofessional_photo', [AdminController::class, 'saveprofessional_photo']);
Route::get('editprofessional_photo{id}',[AdminController::class,'editprofessional_photo']);
Route::POST('updateprofessional_photo',[AdminController::class,'updateprofessional_photo']);
Route::get('deleteprofessional_photo{id}',[AdminController::class,'deleteprofessional_photo']);
//


Route::get('myvideos', [AdminController::class, 'myvideos']);
Route::get('addmyvideo', [AdminController::class, 'addmyvideo']);
Route::post('savemyvideo', [AdminController::class, 'savemyvideo']);
Route::get('editmyvideo{id}',[AdminController::class,'editmyvideo']);
Route::POST('updatemyvideo',[AdminController::class,'updatemyvideo']);
Route::get('deletemyvideo{id}',[AdminController::class,'deletemyvideo']);


// my products

Route::get('myproducts', [AdminController::class, 'myproducts']);
Route::get('addmyproduct', [AdminController::class, 'addmyproduct']);
Route::post('savemyproduct', [AdminController::class, 'savemyproduct']);
Route::get('editmyproduct{id}',[AdminController::class,'editmyproduct']);
Route::put('updatemyproduct',[AdminController::class,'updatemyproduct']);
Route::get('deletemyproduct{id}',[AdminController::class,'deletemyproduct']);
//

Route::get('mysocial', [AdminController::class, 'mysocial']);
Route::get('addsocial', [AdminController::class, 'addsocial']);
Route::post('savesocial', [AdminController::class, 'savesocial']);
Route::get('editsocial{id}',[AdminController::class,'editsocial']);
Route::POST('updatesocial',[AdminController::class,'updatesocial']);
Route::get('deletesocial{id}',[AdminController::class,'deletesocial']);

Route::get('mysocialprofile', [AdminController::class, 'mysocialprofile']);
Route::post('/update_menu',[AdminController::class, 'update_profile_menu']);
Route::get('/add_logo',[AdminController::class, 'add_logo']);
Route::post('/save_logo',[AdminController::class, 'save_logo']);
Route::get('/add_block',[AdminController::class, 'add_block']);
Route::post('/saveBlock',[AdminController::class, 'saveBlock']);
Route::get('edit_blogs/{id}',[AdminController::class, 'edit_blogs']);
Route::get('/add_google_map',[AdminController::class, 'add_google_map']);
Route::post('/saveMap',[AdminController::class, 'save_map']);
Route::get('/add_download',[AdminController::class, 'add_download']);
Route::post('/savePdf',[AdminController::class, 'save_pdf']);
Route::delete('deletePdf/{id}', [AdminController::class, 'delete_pdf'])->name('delete_pdf');
Route::get('/add_achievment',[AdminController::class, 'add_achievment']);
Route::post('/saveAchiev',[AdminController::class, 'save_achievment']);
Route::delete('deleteAchiev/{id}', [AdminController::class, 'delete_achievment'])->name('deleteAchiev');
Route::post('/update_Block',[AdminController::class, 'update_Block']);
Route::get('/delete_blogs/{id}',[AdminController::class, 'delete_blogs']);
Route::get('/add_client',[AdminController::class, 'add_client']);
Route::post('/saveClient',[AdminController::class, 'saveClient']);
Route::get('/edit_client/{id}',[AdminController::class, 'edit_client']);
Route::post('/update_client',[AdminController::class, 'update_client']);
Route::get('/delete_client/{id}',[AdminController::class, 'delete_client']);

Route::view('socialadd', 'admin/userdashboard/social/add');
Route::view('sociallist', 'admin/userdashboard/social/index');
Route::view('socialedit', 'admin/userdashboard/social/edit');





//heading routes start

Route::post('/add_qual_hed', [AdminController::class, 'add_qual_hed']);
//heading routes end




//userdashboard end


// new social user dashboard

Route::view('newindex', 'userdashboard/index');
Route::view('newmyprofile', 'userdashboard/profile/myprofile');
//Route::get('newmyprofile', [UserDashboardController::class, 'userdashboard']);


Route::view('qualificationlist', 'userdashboard/myqualification/index');
Route::view('qualificationadd', 'userdashboard/myqualification/add');
Route::view('qualificationedit', 'userdashboard/myqualification/edit');

// profession
Route::view('professoinlist', 'userdashboard/profession/index');
Route::view('professoinadd', 'userdashboard/profession/add');
Route::view('professoinedit', 'userdashboard/profession/edit');
Route::view('professoinview', 'userdashboard/profession/view_profession');

//new social end
Route::view('thoughtlist', 'userdashboard/thought/index');
Route::view('thoughtadd', 'userdashboard/thought/add');
Route::view('thoughtedit', 'userdashboard/thought/edit');

//new photos end
Route::view('photoslist', 'userdashboard/photos/index');
Route::view('photosadd', 'userdashboard/photos/add');
Route::view('photosedit', 'userdashboard/photos/edit');

//new photos end
Route::view('sociallist', 'userdashboard/social/index');
Route::view('socialadd', 'userdashboard/social/add');
Route::view('socialedit', 'userdashboard/social/edit');

Route::view('newchangepassword', 'userdashboard/change_password');
Route::view('neworder', 'userdashboard/order/neworderlist');
Route::view('neworderview', 'userdashboard/order/neworderview');

Route::get('new-cart', [FrontendController::class, 'cartlist'])->name('new-cart');
Route::POST('setcoupon', [FrontendController::class, 'setcoupon'])->name('setcoupon');

/* anand start code */
Route::POST('setagentcode', [FrontendController::class, 'setagentcode'])->name('setagentcode');

Route::get('remove-agent-code', [FrontendController::class, 'removeAgentCode'])->name('removeAgentCode');

// Get Titles from profile show types in main.js
Route::get('/get-titles', [FrontendController::class,'getTitles']);
//

/* anand end code */ 

Route::get('remove-coupon-code', [FrontendController::class, 'removeCouponCode'])->name('removeCouponCode');
// Route::view('new-cart', 'frontend/shoping_cart');
Route::get('new-checkout', [FrontendController::class, 'checkout'])->name('checkout');
// Route::view('new-checkout', 'frontend/checkout');
Route::get('Product-details-new/{id}', [FrontendController::class, 'Product_details'])->name('Product-details-new');
// Route::view('', 'frontend/product-details');

// for sabpaisa payment gatway anand start code 

    // // for send and get request to new-checkout page start
    // Route::post('/new-checkout', [FrontendController::class, 'processForm'])->name('process.form');
    
    // Route::view('/shipping', 'shipping')->name('shipping');
    
    // // for send and get request to new-checkout page end
    
    // //    
    // Route::view("Authentication","frontend.Authentication");
    // //
    
    // Route::post('/SabPaisaPostPgResponse', function () {
    //     // Disable CSRF protection for debugging
    //     return view('frontend.SabPaisaPostPgResponse');
    // })->withoutMiddleware(['web', 'csrf']);
    // //
     
     
// for sabpaisa payment gatway anand end code 

 
// for phone pay payment gatway anand start code 


    Route::get('/phonePe', [FrontendController::class, 'phonePe'])->name('phonePe');
    // Route::any('phonepe-response',[FrontendController::class,'response'])->name('response');

    Route::any('phonepe-response',[FrontendController::class,'response'])->name('response');


Route::view('/thankyou','frontend.thankyou');

// for phone pay payment gatway anand end code 

// for if not have order in order table so redirect error page
Route::view('/purchase_error','frontend.purchase_error');
//

Route::view('/','frontend.index');
Route::get('Login', [FrontendController::class, 'login'])->name('login');

// gold login
Route::get('Logingold', [FrontendController::class, 'logingold'])->name('logingold');
//

Route::get('signin', [FrontendController::class, 'signin'])->name('signin');
// form register
Route::post('registeruser/register_store',[FrontendController::class, 'register_store'])->name('registeruser.register_store');
//   

// login user
Route::post('loginuser/login_store',[FrontendController::class, 'login_store'])->name('loginuser.login_store');

//


// login user
Route::get('loginuser/theme_change',[FrontendController::class, 'theme_change'])->name('theme_change');
Route::get('loginuser/theme_change_profile',[FrontendController::class, 'theme_change_profile'])->name('theme_change_profile');


//


// login gold user
Route::post('logingolduser/login_gold_store',[FrontendController::class, 'login_gold_store'])->name('loginuser.login_gold_store');

//


// Forgot Password
Route::get('forgot_password', [FrontendController::class, 'forgot_password'])->name('forgot_password');

Route::get('/set_forgot_password',[FrontendController::class,'set_forgot_password']);

Route::post('update_forget_password', [FrontendController::class, 'update_forget_password']);

//  

// anand start code for forgot password 
 
Route::post('forgot_password_email',[FrontendController::class, 'forgot_password_email'])->name('forgot_password_email');

// Route::get('passwordreset/{secret}',[FrontendController::class, 'passwordReset']);
// Route::get('passwordreset', [FrontendController::class, 'passwordReset'])->name('password.reset');
Route::get('passwordreset/{email}', [FrontendController::class, 'passwordReset'])->name('password.reset');

//Reset Password form
Route::post('forgot_reset_password',[FrontendController::class, 'forgot_reset_password'])->name('forgot_reset_password');
//

// anand end code for forgot password
  
Route::get('registration',[FrontendController::class,'registration'])->name('registration');
Route::post('registration_process',[FrontendController::class,'registration_process'])->name('registration.registration_process');
Route::post('login_process',[FrontendController::class,'login_process'])->name('login.login_process');
Route::get('logout', function () {  
    session()->forget('FRONT_USER_LOGIN');
    session()->forget('FRONT_USER_ID');  
    session()->forget('FRONT_USER_NAME'); 
    session()->forget('product_id'); 
    return redirect('/'); 
}); 
     
   
Route::get('About-Us', [FrontendController::class, 'about'])->name('about');
Route::get('Contact-Us', [FrontendController::class, 'contact'])->name('contact');
Route::post('shopingcart/{id}', [FrontendController::class, 'shoping_cart'])->name('shopingcart.post');

Route::post('/applycoupon', [FrontendController::class, 'applycoupon'])->name('applycoupon');
Route::get('/cart', [FrontendController::class, 'cartlist']);
Route::get('/cartprodelete/{id}', [FrontendController::class, 'cartdelete']);
Route::post('/cartupdate', [FrontendController::class, 'cartupdate'])->name('cartupdate');
Route::match(["post",'get'],'/confirmorder', [FrontendController::class, 'confirmorder'])->name('confirmorder');

Route::match(["post",'get'],'/confirmorderr', [FrontendController::class, 'confirmorderr'])->name('confirmorderr');


Route::get('Checkout', [FrontendController::class, 'checkout'])->name('Checkout');
Route::get('Product/{type?}', [FrontendController::class, 'products'])->name('products');
Route::get('Team', [FrontendController::class, 'teams'])->name('teams');
Route::get('Product/{id}', [FrontendController::class, 'allproductshow'])->name('produ');
Route::get('/header', [FrontendController::class, 'viewcategroy_list'])->name('header');

Route::get('allproducts', [FrontendController::class, 'showproduct'])->name('allproducts');

//Route::get('product-details/{id}', [FrontendController::class, 'product_details']);
Route::get('digital-business-card-in-jaipur/{id}', [FrontendController::class, 'product_details']);
Route::POST('savecontact',[FrontendController::class,'contectus']);
Route::POST('savecorporate',[FrontendController::class,'corporates']);
Route::get('/', [FrontendController::class, 'testimonialview'])->name('home');
Route::get('/About-Us', [FrontendController::class, 'ABoutview'])->name('about');


Route::POST('/',[FrontendController::class,'subscribe'])->name('subscribe');


Route::get('subscribers_view',[SubscriberController::class,'subscribers_view'])->name('subscribers_view');

Route::POST('add_subscribers',[SubscriberController::class,'add_subscribers'])->name('add_subscribers');

/************************************************************************************************************** */
 
 
Route::prefix('admin')->name('admin.')->group(function(){

Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
    Route::view('/login','admin-new.login')->name('login');
    Route::post('/check',[AdminController::class,'check'])->name('check');
    Route::post('/GoogelMaster',[AdminController::class,'admin.Authenticator']);
});


//    Route::view('GoogelMaster','GoogelMaster');

//    Route::POST('GoogelMaster',[AdminController::class,'GoogelMaster']);



Route::middleware(['auth:admin','PreventBackHistory'])->group(function(){
Route::view('/index','admin-new.index')->name('index');
Route::get('/logout',[AdminController::class,'logout'])->name('logout');



Route::view('/websetting','admin/websetting')->name('websetting');
Route::POST('admin/websetting',[AdminController::class,'websetting']);
Route::get('viewwebsetting',[AdminController::class,'viewwebsetting']);
Route::get('update{id}',[AdminController::class,'updatedata']);
Route::POST('admin/updatewebsetting',[AdminController::class,'updatewebsetting']);


Route::view('/add-category','admin-new.category.add')->name('add-category');
Route::POST('/addcategroy',[AdminController::class,'addcategroy']);
Route::get('/viewcategroy',[AdminController::class,'viewcategroy']);
Route::get('catupdate{id}',[AdminController::class,'updatecatagroydata']);
Route::POST('admin/updatecategroy',[AdminController::class,'updatecategroy']);
Route::get('/categories.update.status', [AdminController::class,'updateStatus']);


Route::get('delete{id}',[AdminController::class,'deletecategroy']);




Route::get('/addtestimonial',[AdminController::class,'addtestimonial']);
Route::POST('/savetestimonial',[AdminController::class,'savetestimonial']);
Route::get('/testimonial',[AdminController::class,'testimoniallist']);
Route::get('edittestimonial{id}',[AdminController::class,'edittestimonial']);
Route::POST('updatetestimonial',[AdminController::class,'updatetestimonial']);
Route::get('testimonialdelete{id}',[AdminController::class,'testimonialdelete']);










Route::get('/view_price_plan',[AdminController::class,'view_price_plan']);
Route::get('editprice{id}',[AdminController::class,'editprice']);
Route::POST('updatetesprice',[AdminController::class,'updatetesprice']);
Route::get('pricedelete{id}',[AdminController::class,'pricedelete']);

/************************************************************************************************************** */


Route::view('/add-subcategory','admin/add-subcategory')->name('add-subcategory');
Route::POST('/add-subcategroy',[AdminController::class,'add_subcategroy']);
Route::get('/view-subcategory',[Admincontroller::class,'view_subcategroy']);
Route::get('/add-subcategory',[AdminController::class,'selectcategory']);

Route::get('subcatupdate{id}',[AdminController::class,'update_subcatagroydata']);
Route::POST('admin/update_subcatagroydata',[AdminController::class,'update_subcategroy']);

Route::get('subcatdelete{id}',[AdminController::class,'deletesubcategroy']);


Route::get('/subcategories.update.status', [AdminController::class,'updatecatStatus']);

Route::get('/orders', [AdminController::class,'orders']);
Route::get('/orderview{id}', [AdminController::class,'orderview']);
Route::get('order-delete/{id}', [AdminController::class,'order_delete']);


/*anand start code */

Route::get('/manageagent', [AdminController::class,'manageagent']);

Route::get('/preorder', [AdminController::class,'preorder']);
 
Route::get('/addagent', [AdminController::class,'addagent']);

Route::post('addagent/addagentstore',[AdminController::class, 'addagentstore'])->name('addagent.addagentstore');

Route::get('/agentdelete/{id}',[AdminController::class,'agentdelete']);

Route::get('editagent/{id}/editagent',[AdminController::class, 'editagent']);
Route::put('editagent/{id}/agentupdate',[AdminController::class, 'agentupdate']);

Route::get('viewagent/{id}/viewagent',[AdminController::class, 'viewagent']);

Route::post('manageagent/storenotification',[AdminController::class, 'storenotification'])->name('manageuser.storenotification');

Route::get('/deletenotification/{id}/delete',[AdminController::class, 'destroynotification']);

Route::get('editnotification/{id}/edit/{agent_id}',[AdminController::class, 'editnotification']);

Route::put('editnotification/{id}/update',[AdminController::class, 'updatenotification']);

Route::get('/agent.update.status', [AdminController::class,'updateagentStatus']);
  

// for user block and unbolck permission from usrpanel and profile 
Route::get('/user.update.permission', [AdminController::class,'updateuserPermission']);
// 
// for user gold and normal userpanel
Route::get('/user.update.panel_status', [AdminController::class,'updatePanel_status']);
//  
 
/*anand end code */


Route::get('user-list',[AdminController::class,'user_list']);
Route::get('user-delete/{id}',[AdminController::class,'user_delete']);



/************************************************************************************************************** */



Route::view('/add-childcategory','admin/add-childcategory');

Route::get('/add-childcategory',[ChildcategoryController::class,'categoryslist']);
Route::post('/getSubcat', [ChildcategoryController::class,'getSubcat']);
Route::POST('/add-childcategory', [ChildcategoryController::class,'add_childcategory']);
Route::view('/view-Childcategory','admin/view-Childcategory');
Route::get('/view-Childcategory',[ChildcategoryController::class,'show']);
Route::get('childcatupdate{id}',[ChildcategoryController::class,'select']);
Route::POST('admin/update-childcategroy',[ChildcategoryController::class,'edit']);
Route::get('/childcategories.update.status', [ChildcategoryController::class,'updatecatStatus']);
Route::get('childcatdelete{id}',[ChildcategoryController::class,'deletechildcategroy']);

/************************************************************************************************************** */



Route::view('/add-product','admin/add-product');
Route::get('/add-product',[ProductController::class,'categoryslist']);

Route::post('/getsubcat', [ProductController::class,'getsubcat']);
Route::post('/add-product', [ProductController::class,'add_product']);

Route::view('/view-product','admin/view-product');
Route::get('/view-product',[ProductController::class,'proselect']);
Route::get('/product.update.status', [ProductController::class,'updateStatus']);
Route::get('/prodelete{id}',[ProductController::class,'deleteproduct']);
Route::get('/proview{id}',[ProductController::class,'singalproduct']);
Route::get('/proupdate{id}',[ProductController::class,'updateselectproduct']);
Route::POST('admin/update-product',[ProductController::class,'edit']);

Route::view('/add-logo','admin-new.brand.add');
Route::get('/view-brand_logo',[ProductController::class,'view_brand_logo_view']);
Route::get('/brand_logo.update.status', [ProductController::class,'brand_logo_status']);
Route::get('/brand_logo_delete{id}',[ProductController::class,'brand_logo_delete']);
Route::post('/add-logo1', [ProductController::class,'add_logo']);
Route::get('/brand_logo_update{id}',[ProductController::class,'brand_logo_update']);
Route::POST('admin/update-view-brand_logo',[ProductController::class,'brand_logo_edit']);

Route::get('/view-faq',[ProductController::class,'view_faq']);
Route::get('/add-faq',[ProductController::class,'add_faq']);
Route::post('/faq-data',[ProductController::class,'faq_data']);
Route::get('/delete-faq/{id}',[ProductController::class,'faq_delete']);
Route::get('/edit-faq/{id}',[ProductController::class,'edit_faq']);
Route::post('/faq-update/{id}',[ProductController::class,'faq_update']);
/****************************************************View Admin********************************************************** */




Route::get('addcart', [FrontendController::class, 'addToCart'])->name('addcart');
Route::patch('update-cart', [FrontendController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [FrontendController::class, 'remove'])->name('remove.from.cart');



Route::get('contactus', [AdminController::class,'viewcontact']);
Route::get('corporate', [AdminController::class,'view_corporate']);
Route::get('subscribe_channel', [AdminController::class, 'subscribeview']);
Route::get('Pricing_Plans', [AdminController::class, 'Pricing_Plans']);
Route::get('subdelete{id}', [AdminController::class, 'subdelete']);



Route::view('/add_offer','admin-new.offer.add');
Route::POST('/add_offer',[AdminController::class,'add_offer']);
Route::get('/view_offer', [AdminController::class,'viewoffer']);
Route::get('/offerdelete{id}',[AdminController::class,'offerdelete']);
Route::get('/offer.status', [AdminController::class,'offerStatus']);
Route::get('/offerupdate{id}',[AdminController::class,'offerdata']);
Route::POST('admin/update_offer',[AdminController::class,'update_offer']);


Route::view('/coupon','admin-new.coupon.add');
Route::POST('/add_coupon',[AdminController::class,'add_coupon']);
Route::get('/view_coupon', [AdminController::class,'view_coupon']);
Route::get('/delete_coupon/{id}',[AdminController::class,'delete_coupon']);
Route::get('/coupon.status', [AdminController::class,'couponStatus']);
Route::get('/edit_coupon{id}',[AdminController::class,'edit_coupon']);
Route::POST('update_coupon',[AdminController::class,'update_coupon']);


Route::POST('add_Pricing_Plans',[AdminController::class,'add_Pricing_Plans']);


// =============================================
// COMPANY MANAGEMENT ROUTES
// =============================================
Route::get('/companies', [AdminController::class, 'adminCompanies']);
Route::get('/companies/export', [AdminController::class, 'adminExportCompanies'])->name('admin.companies.export');
Route::get('/companies/{id}', [AdminController::class, 'adminViewCompany']);
Route::get('/companies/{id}/edit', [AdminController::class, 'adminEditCompany']);
Route::post('/companies/{id}/update', [AdminController::class, 'adminUpdateCompany']);
Route::post('/companies/{id}/toggle-status', [AdminController::class, 'adminToggleCompanyStatus']);
Route::post('/companies/{id}/update-limit', [AdminController::class, 'adminUpdateCompanyLimit']);
Route::get('/companies/{id}/delete', [AdminController::class, 'adminDeleteCompany']);
Route::get('/companies/{id}/staff', [AdminController::class, 'adminCompanyStaff']);
Route::get('/companies/{id}/subscription', [AdminController::class, 'adminCompanySubscription']);

// =============================================
// PROFESSION THEMES ROUTES
// =============================================
Route::get('/profession-themes', [AdminController::class, 'adminProfessionThemes']);
Route::post('/profession-themes/{id}/toggle', [AdminController::class, 'adminToggleTheme']);

// =============================================
// ANALYTICS DASHBOARD
// =============================================
Route::get('/analytics', [AdminController::class, 'adminAnalytics'])->name('admin.analytics');


//------------------------------------------- tracking orders start--------------------------------------//



Route::get('/', function () {
    return Orders::all();
});
Route::post('order',[TrackorderController::class,'getOrder']);

//------------------------------------------- tracking orders end--------------------------------------//





});


});


/*anand start code */

// For Agent Panel
// Route::get('/admin',[DashboardController::class,'index']);

// agent admin
Route::redirect('/franchise/login', '/agent/login');

Route::prefix('agent')->group(function(){
    Route::get('/login',[App\Http\Controllers\Agent\LoginController::class, 'index']);
    Route::post('login/auth',[App\Http\Controllers\Agent\LoginController::class, 'auth'])->name('login.auth');

    Route::get('logout',[App\Http\Controllers\Agent\LoginController::class, 'logout']);

});
//
Route::prefix('agent')->group(function(){

    Route::get('/register',[App\Http\Controllers\Agent\RegisterController::class, 'index']);
});
///

Route::group(['middleware'=>'agent_auth'], function(){


Route::prefix('agent')->group(function(){

    Route::get('/dashboard',[App\Http\Controllers\Agent\DashboardController::class, 'index']);
});

Route::prefix('agent')->group(function(){

    Route::get('/homebanner',[App\Http\Controllers\Agent\HomebannerController::class, 'index']);
});

Route::prefix('agent')->group(function(){

    Route::get('/homeabout',[App\Http\Controllers\Agent\HomeaboutController::class, 'index']);

    Route::get('edithomeabout/{id}/edit',[App\Http\Controllers\Agent\HomeaboutController::class, 'edit']);
    Route::put('edithomeabout/{id}/update',[App\Http\Controllers\Agent\HomeaboutController::class, 'update']);


});
Route::prefix('agent')->group(function(){

    Route::get('/homewhy',[App\Http\Controllers\Agent\HomewhyController::class, 'index']);

    Route::get('edithomewhy/{id}/edit',[App\Http\Controllers\Agent\HomewhyController::class, 'edit']);
    Route::put('edithomewhy/{id}/update',[App\Http\Controllers\Agent\HomewhyController::class, 'update']);
});

Route::prefix('agent')->group(function(){

    Route::get('/articles',[App\Http\Controllers\Agent\ArticlesController::class, 'index']);

    Route::get('/addarticle',[App\Http\Controllers\Agent\ArticlesController::class, 'addarticle']);
    Route::post('addarticle/store',[App\Http\Controllers\Agent\ArticlesController::class, 'store'])->name('addarticle.store');

    Route::get('/article/{id}/delete',[App\Http\Controllers\Agent\ArticlesController::class, 'destroy']);

    Route::get('editarticle/{id}/edit',[App\Http\Controllers\Agent\ArticlesController::class, 'editarticle']);
    Route::put('editarticle/{id}/update',[App\Http\Controllers\Agent\ArticlesController::class, 'update']);

});
Route::prefix('agent')->group(function(){

    Route::get('/faq',[App\Http\Controllers\Agent\FaqController::class, 'index']);

    Route::get('/addfaq',[App\Http\Controllers\Agent\FaqController::class, 'addfaq']);
    Route::post('addfaq/store',[App\Http\Controllers\Agent\FaqController::class, 'store'])->name('addfaq.store');

    Route::get('/faq/{id}/delete',[App\Http\Controllers\Agent\FaqController::class, 'destroy']);

    Route::get('editfaq/{id}/edit',[App\Http\Controllers\Agent\FaqController::class, 'editfaq']);
    Route::put('editfaq/{id}/update',[App\Http\Controllers\Agent\FaqController::class, 'update']);

});
Route::prefix('agent')->group(function(){

    Route::get('/contact',[App\Http\Controllers\Agent\ContactController::class, 'index']);

    // Route::get('contact{id}/view',[App\Http\Controllers\Agent\ContactController::class, 'view']);

});

Route::prefix('agent')->group(function(){

    Route::get('contact/{id}/contactview',[App\Http\Controllers\Agent\ContactController::class, 'contactview']);
});

Route::prefix('agent')->group(function(){

    Route::get('/allcategory',[App\Http\Controllers\Agent\AllcategoryController::class, 'index']);

    Route::post('addcategory/store',[App\Http\Controllers\Agent\AllcategoryController::class, 'store'])->name('addcategory.store');

    Route::get('/allcategory/{id}/delete',[App\Http\Controllers\Agent\AllcategoryController::class, 'destroy']);

    Route::get('editcategory/{id}/edit',[App\Http\Controllers\Agent\AllcategoryController::class, 'editcategory']);

    Route::put('editcategory/{id}/update',[App\Http\Controllers\Agent\AllcategoryController::class, 'update']);

});
Route::prefix('agent')->group(function(){

    Route::get('/addnewcategory',[App\Http\Controllers\Agent\AddnewcategoryController::class, 'index']);
});

Route::prefix('agent')->group(function(){

    Route::get('/allsubcategory',[App\Http\Controllers\Agent\AllsubcategoryController::class, 'index']);

    Route::post('/addsubcategory/store',[App\Http\Controllers\Agent\AllsubcategoryController::class, 'store'])->name('addsubcategory.store');

    Route::get('/allsubcategory/{id}/delete',[App\Http\Controllers\Agent\AllsubcategoryController::class, 'destroy']);

    Route::get('editsubcategory/{id}/edit',[App\Http\Controllers\Agent\AllsubcategoryController::class, 'editsubcategory']);

    Route::put('editsubcategory/{id}/update',[App\Http\Controllers\Agent\AllsubcategoryController::class, 'update']);

});

Route::prefix('agent')->group(function(){

    Route::get('/addnewsubcategory',[App\Http\Controllers\Agent\AddnewsubcategoryController::class, 'index']);
});

Route::prefix('agent')->group(function(){

    Route::get('/allservices',[App\Http\Controllers\Agent\AllservicesController::class, 'index']);

    Route::post('addnewservice/store',[App\Http\Controllers\Agent\AllservicesController::class, 'store'])->name('addnewservice.store');

    Route::get('/allservices/{id}/delete',[App\Http\Controllers\Agent\AllservicesController::class, 'destroy']);

    Route::get('editservice/{id}/edit',[App\Http\Controllers\Agent\AllservicesController::class, 'editservice']);
    Route::put('ediservice/{id}/update',[App\Http\Controllers\Agent\AllservicesController::class, 'update']);

});

Route::prefix('agent')->group(function(){

    Route::get('/addnewservice',[App\Http\Controllers\Agent\AddnewserviceController::class, 'index']);

    // for show subcategory in add new service page when click category
    Route::post('/getSubcat',[App\Http\Controllers\Agent\AddnewserviceController::class, 'getSubcat']);
    //
});

Route::prefix('agent')->group(function(){

    Route::get('/allusers',[App\Http\Controllers\Agent\AllusersController::class, 'index']);

    Route::post('addnewuser/store',[App\Http\Controllers\Agent\AllusersController::class, 'store'])->name('addnewuser.store');

    Route::get('edituser/{id}/edit',[App\Http\Controllers\Agent\AllusersController::class, 'edituser']);

    Route::put('edituser/{id}/update',[App\Http\Controllers\Agent\AllusersController::class, 'update']);

    Route::get('viewuser/{id}/view',[App\Http\Controllers\Agent\AllusersController::class, 'viewuser']);

    //
    Route::get('manageuser/{id}/manage',[App\Http\Controllers\Agent\AllusersController::class, 'manageuser']);

    Route::post('manageuser/storenotification',[App\Http\Controllers\Agent\AllusersController::class, 'storenotification'])->name('manageuser.storenotification');

    Route::get('/deletenotification/{id}/delete',[App\Http\Controllers\Agent\AllusersController::class, 'destroynotification']);

    Route::get('editnotification/{id}/edit/{user_id}',[App\Http\Controllers\Agent\AllusersController::class, 'editnotification']);

    Route::put('editnotification/{id}/update',[App\Http\Controllers\Agent\AllusersController::class, 'updatenotification']);

    Route::put('workprgress/{id}/update',[App\Http\Controllers\Agent\AllusersController::class, 'workprgress']);

    Route::put('validity_date/{id}/update',[App\Http\Controllers\Agent\AllusersController::class, 'validity_date']);

    // Route::post('/clear_dues',[App\Http\Controllers\Agent\AllusersController::class, 'clear_dues']);

    // upload bulk users
    Route::post('/users/bulk-upload', [App\Http\Controllers\Agent\AllusersController::class, 'bulkUpload'])->name('users.bulk-upload');

    //
});
Route::prefix('agent')->group(function(){

    Route::get('/addnewuser',[App\Http\Controllers\Agent\AddnewuserController::class, 'index']);
});

Route::prefix('agent')->group(function(){

    Route::get('/usertickets',[App\Http\Controllers\Agent\UserticketsController::class, 'index']);
});
Route::prefix('agent')->group(function(){

    Route::get('/managertickets',[App\Http\Controllers\Agent\ManagerticketsController::class, 'index']);
});

Route::prefix('agent')->group(function(){

    Route::get('/allorders',[App\Http\Controllers\Agent\AllordersController::class, 'index']);

    Route::get('vieworder/{id}/view',[App\Http\Controllers\Agent\AllordersController::class, 'vieworder']);


});


Route::prefix('agent')->group(function(){

    Route::get('/myprofile',[App\Http\Controllers\Agent\MyprofileController::class, 'index']);

});

Route::prefix('agent')->group(function(){

    Route::get('/support',[App\Http\Controllers\Agent\SupportController::class, 'index']);

});

});

/*anand end code */


Route::get('/cache', function () {
Artisan::call('cache:clear');
});


Route::get('/storage', function () {
Artisan::call('storage:link');
});



Route::get('/optimize', function () {
Artisan::call('optimize:clear');
});

Route::get('user/document/download/{id}',[FrontendController::class,'document_download']);

Route::get('auth/google',[FrontendController::class,'redirect'])->name('google-auth');
Route::get('auth/google/call-back',[FrontendController::class,'callbackGoogle']);

// New Redesign Test Route
Route::view('/redesign-test', 'frontend.index-new-test');

// =====================================================
// COMPANY PANEL ROUTES
// =====================================================

// Company Public Routes (No Auth Required)
Route::prefix('company')->group(function () {
    Route::get('/login', [App\Http\Controllers\Company\AuthController::class, 'showLogin']);
    Route::post('/login', [App\Http\Controllers\Company\AuthController::class, 'login'])->name('company.login');
    Route::get('/register', [App\Http\Controllers\Company\AuthController::class, 'showRegister']);
    Route::post('/register', [App\Http\Controllers\Company\AuthController::class, 'register'])->name('company.register');
    Route::get('/logout', [App\Http\Controllers\Company\AuthController::class, 'logout']);
});

// Company Protected Routes (Auth Required)
Route::group(['middleware' => 'company_auth'], function () {
    Route::prefix('company')->group(function () {
        // Dashboard
        Route::get('/dashboard', [App\Http\Controllers\Company\DashboardController::class, 'index']);

        // Staff Management
        Route::get('/staff', [App\Http\Controllers\Company\StaffController::class, 'index']);
        Route::get('/staff/create', [App\Http\Controllers\Company\StaffController::class, 'create']);
        Route::post('/staff/store', [App\Http\Controllers\Company\StaffController::class, 'store'])->name('company.staff.store');
        Route::get('/staff/import', [App\Http\Controllers\Company\StaffController::class, 'import']);
        Route::post('/staff/import', [App\Http\Controllers\Company\StaffController::class, 'import'])->name('company.staff.import');
        Route::get('/staff/{id}', [App\Http\Controllers\Company\StaffController::class, 'show']);
        Route::get('/staff/{id}/edit', [App\Http\Controllers\Company\StaffController::class, 'edit']);
        Route::put('/staff/{id}/update', [App\Http\Controllers\Company\StaffController::class, 'update'])->name('company.staff.update');
        Route::delete('/staff/{id}/delete', [App\Http\Controllers\Company\StaffController::class, 'destroy'])->name('company.staff.delete');
        Route::post('/staff/{id}/toggle-card', [App\Http\Controllers\Company\StaffController::class, 'toggleCard'])->name('company.staff.toggle');
        Route::get('/staff/{id}/visibility', [App\Http\Controllers\Company\StaffController::class, 'visibility']);
        Route::post('/staff/{id}/visibility', [App\Http\Controllers\Company\StaffController::class, 'updateVisibility'])->name('company.staff.visibility');

        // Company Profile
        Route::get('/profile', [App\Http\Controllers\Company\ProfileController::class, 'index']);
        Route::post('/profile/update', [App\Http\Controllers\Company\ProfileController::class, 'update'])->name('company.profile.update');
        Route::post('/profile/social', [App\Http\Controllers\Company\ProfileController::class, 'updateSocial'])->name('company.profile.social');

        // Branding
        Route::get('/branding', [App\Http\Controllers\Company\ProfileController::class, 'branding']);
        Route::post('/branding/colors', [App\Http\Controllers\Company\ProfileController::class, 'updateColors'])->name('company.branding.colors');
        Route::post('/branding/typography', [App\Http\Controllers\Company\ProfileController::class, 'updateTypography'])->name('company.branding.typography');
        Route::post('/branding/layout', [App\Http\Controllers\Company\ProfileController::class, 'updateLayout'])->name('company.branding.layout');

        // Subscription
        Route::get('/subscription', [App\Http\Controllers\Company\ProfileController::class, 'subscription']);

        // Password
        Route::get('/change-password', [App\Http\Controllers\Company\ProfileController::class, 'changePassword']);
        Route::post('/change-password', [App\Http\Controllers\Company\ProfileController::class, 'updatePassword'])->name('company.password.update');

        // Menu Management (Restaurant Theme)
        Route::get('/menu', [App\Http\Controllers\Company\MenuController::class, 'index']);

        // Menu Categories
        Route::get('/menu/category/create', [App\Http\Controllers\Company\MenuController::class, 'createCategory']);
        Route::post('/menu/category/store', [App\Http\Controllers\Company\MenuController::class, 'storeCategory'])->name('company.menu.category.store');
        Route::get('/menu/category/{id}/edit', [App\Http\Controllers\Company\MenuController::class, 'editCategory']);
        Route::put('/menu/category/{id}/update', [App\Http\Controllers\Company\MenuController::class, 'updateCategory'])->name('company.menu.category.update');
        Route::delete('/menu/category/{id}/delete', [App\Http\Controllers\Company\MenuController::class, 'destroyCategory'])->name('company.menu.category.delete');
        Route::post('/menu/category/{id}/toggle', [App\Http\Controllers\Company\MenuController::class, 'toggleCategory'])->name('company.menu.category.toggle');
        Route::post('/menu/category/reorder', [App\Http\Controllers\Company\MenuController::class, 'reorderCategories'])->name('company.menu.category.reorder');
        Route::get('/menu/category/{id}/items', [App\Http\Controllers\Company\MenuController::class, 'categoryItems']);

        // Menu Items
        Route::get('/menu/item/create', [App\Http\Controllers\Company\MenuController::class, 'createItem']);
        Route::post('/menu/item/store', [App\Http\Controllers\Company\MenuController::class, 'storeItem'])->name('company.menu.item.store');
        Route::get('/menu/item/{id}/edit', [App\Http\Controllers\Company\MenuController::class, 'editItem']);
        Route::put('/menu/item/{id}/update', [App\Http\Controllers\Company\MenuController::class, 'updateItem'])->name('company.menu.item.update');
        Route::delete('/menu/item/{id}/delete', [App\Http\Controllers\Company\MenuController::class, 'destroyItem'])->name('company.menu.item.delete');
        Route::post('/menu/item/{id}/toggle', [App\Http\Controllers\Company\MenuController::class, 'toggleItem'])->name('company.menu.item.toggle');
        Route::post('/menu/item/{id}/bestseller', [App\Http\Controllers\Company\MenuController::class, 'toggleBestseller'])->name('company.menu.item.bestseller');
        Route::post('/menu/category/{id}/items/reorder', [App\Http\Controllers\Company\MenuController::class, 'reorderItems'])->name('company.menu.items.reorder');

        // Restaurant Settings
        Route::get('/restaurant', [App\Http\Controllers\Company\RestaurantController::class, 'index']);
        Route::post('/restaurant/basic', [App\Http\Controllers\Company\RestaurantController::class, 'updateBasic'])->name('company.restaurant.basic');
        Route::post('/restaurant/hours', [App\Http\Controllers\Company\RestaurantController::class, 'updateHours'])->name('company.restaurant.hours');
        Route::post('/restaurant/services', [App\Http\Controllers\Company\RestaurantController::class, 'updateServices'])->name('company.restaurant.services');
        Route::post('/restaurant/payments', [App\Http\Controllers\Company\RestaurantController::class, 'updatePayments'])->name('company.restaurant.payments');

        // Advanced Restaurant Management
        Route::get('/restaurant/profiles', [App\Http\Controllers\Company\HospitalityController::class, 'profiles']);
        Route::post('/restaurant/profiles', [App\Http\Controllers\Company\HospitalityController::class, 'storeProfile'])->name('company.restaurant.profiles.store');
        Route::put('/restaurant/profiles/{id}', [App\Http\Controllers\Company\HospitalityController::class, 'updateProfile'])->name('company.restaurant.profiles.update');
        Route::post('/restaurant/profiles/{id}/default', [App\Http\Controllers\Company\HospitalityController::class, 'setDefaultProfile'])->name('company.restaurant.profiles.default');
        Route::delete('/restaurant/profiles/{id}', [App\Http\Controllers\Company\HospitalityController::class, 'deleteProfile'])->name('company.restaurant.profiles.delete');

        Route::get('/restaurant/tables', [App\Http\Controllers\Company\HospitalityController::class, 'tables']);
        Route::post('/restaurant/tables', [App\Http\Controllers\Company\HospitalityController::class, 'storeTable'])->name('company.restaurant.tables.store');
        Route::put('/restaurant/tables/{id}', [App\Http\Controllers\Company\HospitalityController::class, 'updateTable'])->name('company.restaurant.tables.update');
        Route::post('/restaurant/tables/{id}/qr', [App\Http\Controllers\Company\HospitalityController::class, 'regenerateTableQr'])->name('company.restaurant.tables.qr');
        Route::delete('/restaurant/tables/{id}', [App\Http\Controllers\Company\HospitalityController::class, 'deleteTable'])->name('company.restaurant.tables.delete');

        Route::get('/restaurant/rooms', [App\Http\Controllers\Company\HospitalityController::class, 'rooms']);
        Route::post('/restaurant/rooms', [App\Http\Controllers\Company\HospitalityController::class, 'storeRoom'])->name('company.restaurant.rooms.store');
        Route::put('/restaurant/rooms/{id}', [App\Http\Controllers\Company\HospitalityController::class, 'updateRoom'])->name('company.restaurant.rooms.update');
        Route::post('/restaurant/rooms/{id}/qr', [App\Http\Controllers\Company\HospitalityController::class, 'regenerateRoomQr'])->name('company.restaurant.rooms.qr');
        Route::delete('/restaurant/rooms/{id}', [App\Http\Controllers\Company\HospitalityController::class, 'deleteRoom'])->name('company.restaurant.rooms.delete');

        Route::get('/restaurant/orders', [App\Http\Controllers\Company\HospitalityController::class, 'orders']);
        Route::post('/restaurant/orders/table/{id}/status', [App\Http\Controllers\Company\HospitalityController::class, 'updateTableOrderStatus'])->name('company.restaurant.orders.table.status');
        Route::post('/restaurant/orders/room/{id}/status', [App\Http\Controllers\Company\HospitalityController::class, 'updateRoomOrderStatus'])->name('company.restaurant.orders.room.status');

        Route::get('/restaurant/events', [App\Http\Controllers\Company\HospitalityController::class, 'events']);
        Route::post('/restaurant/events/{id}/status', [App\Http\Controllers\Company\HospitalityController::class, 'updateEventStatus'])->name('company.restaurant.events.status');

        Route::get('/restaurant/banquets', [App\Http\Controllers\Company\HospitalityController::class, 'banquets']);
        Route::get('/restaurant/banquets/create', [App\Http\Controllers\Company\HospitalityController::class, 'createBanquet']);
        Route::post('/restaurant/banquets', [App\Http\Controllers\Company\HospitalityController::class, 'storeBanquet'])->name('company.restaurant.banquets.store');
        Route::get('/restaurant/banquets/{id}/edit', [App\Http\Controllers\Company\HospitalityController::class, 'editBanquet']);
        Route::put('/restaurant/banquets/{id}', [App\Http\Controllers\Company\HospitalityController::class, 'updateBanquet'])->name('company.restaurant.banquets.update');
        Route::delete('/restaurant/banquets/{id}', [App\Http\Controllers\Company\HospitalityController::class, 'deleteBanquet'])->name('company.restaurant.banquets.delete');

        Route::get('/restaurant/payments', [App\Http\Controllers\Company\HospitalityController::class, 'payments']);
        Route::get('/restaurant/kitchen', [App\Http\Controllers\Company\HospitalityController::class, 'kitchen']);
        Route::get('/restaurant/analytics', [App\Http\Controllers\Company\HospitalityController::class, 'analytics']);

        // Production House Management
        Route::get('/production/services', [App\Http\Controllers\Company\ProductionController::class, 'services']);
        Route::post('/production/services', [App\Http\Controllers\Company\ProductionController::class, 'storeService'])->name('company.production.services.store');
        Route::put('/production/services/{id}', [App\Http\Controllers\Company\ProductionController::class, 'updateService'])->name('company.production.services.update');
        Route::delete('/production/services/{id}', [App\Http\Controllers\Company\ProductionController::class, 'deleteService'])->name('company.production.services.delete');

        Route::get('/production/projects', [App\Http\Controllers\Company\ProductionController::class, 'projects']);
        Route::post('/production/projects', [App\Http\Controllers\Company\ProductionController::class, 'storeProject'])->name('company.production.projects.store');
        Route::post('/production/projects/{id}/status', [App\Http\Controllers\Company\ProductionController::class, 'updateProjectStatus'])->name('company.production.projects.status');
        Route::delete('/production/projects/{id}', [App\Http\Controllers\Company\ProductionController::class, 'deleteProject'])->name('company.production.projects.delete');

        Route::get('/production/portfolios', [App\Http\Controllers\Company\ProductionController::class, 'portfolios']);
        Route::post('/production/portfolios', [App\Http\Controllers\Company\ProductionController::class, 'storePortfolio'])->name('company.production.portfolios.store');
        Route::delete('/production/portfolios/{id}', [App\Http\Controllers\Company\ProductionController::class, 'deletePortfolio'])->name('company.production.portfolios.delete');

        Route::get('/production/team', [App\Http\Controllers\Company\ProductionController::class, 'team']);
        Route::post('/production/team', [App\Http\Controllers\Company\ProductionController::class, 'storeTeam'])->name('company.production.team.store');
        Route::put('/production/team/{id}', [App\Http\Controllers\Company\ProductionController::class, 'updateTeam'])->name('company.production.team.update');
        Route::delete('/production/team/{id}', [App\Http\Controllers\Company\ProductionController::class, 'deleteTeam'])->name('company.production.team.delete');

        Route::get('/production/payments', [App\Http\Controllers\Company\ProductionController::class, 'payments']);
        Route::post('/production/payments', [App\Http\Controllers\Company\ProductionController::class, 'storePayment'])->name('company.production.payments.store');

        // Jewellery Management
        Route::get('/jewellery/products', [App\Http\Controllers\Company\JewelleryController::class, 'products']);
        Route::post('/jewellery/products', [App\Http\Controllers\Company\JewelleryController::class, 'storeProduct'])->name('company.jewellery.products.store');
        Route::put('/jewellery/products/{id}', [App\Http\Controllers\Company\JewelleryController::class, 'updateProduct'])->name('company.jewellery.products.update');
        Route::delete('/jewellery/products/{id}', [App\Http\Controllers\Company\JewelleryController::class, 'deleteProduct'])->name('company.jewellery.products.delete');

        Route::get('/jewellery/rates', [App\Http\Controllers\Company\JewelleryController::class, 'rates']);
        Route::post('/jewellery/rates', [App\Http\Controllers\Company\JewelleryController::class, 'storeRate'])->name('company.jewellery.rates.store');
        Route::put('/jewellery/rates/{id}', [App\Http\Controllers\Company\JewelleryController::class, 'updateRate'])->name('company.jewellery.rates.update');
        Route::delete('/jewellery/rates/{id}', [App\Http\Controllers\Company\JewelleryController::class, 'deleteRate'])->name('company.jewellery.rates.delete');

        Route::get('/jewellery/orders', [App\Http\Controllers\Company\JewelleryController::class, 'orders']);
        Route::post('/jewellery/orders', [App\Http\Controllers\Company\JewelleryController::class, 'storeOrder'])->name('company.jewellery.orders.store');
        Route::post('/jewellery/orders/{id}/status', [App\Http\Controllers\Company\JewelleryController::class, 'updateOrderStatus'])->name('company.jewellery.orders.status');
        Route::delete('/jewellery/orders/{id}', [App\Http\Controllers\Company\JewelleryController::class, 'deleteOrder'])->name('company.jewellery.orders.delete');

        // Technology Management
        Route::get('/tech/services', [App\Http\Controllers\Company\TechController::class, 'services']);
        Route::post('/tech/services', [App\Http\Controllers\Company\TechController::class, 'storeService'])->name('company.tech.services.store');
        Route::put('/tech/services/{id}', [App\Http\Controllers\Company\TechController::class, 'updateService'])->name('company.tech.services.update');
        Route::delete('/tech/services/{id}', [App\Http\Controllers\Company\TechController::class, 'deleteService'])->name('company.tech.services.delete');

        Route::get('/tech/projects', [App\Http\Controllers\Company\TechController::class, 'projects']);
        Route::post('/tech/projects', [App\Http\Controllers\Company\TechController::class, 'storeProject'])->name('company.tech.projects.store');
        Route::post('/tech/projects/{id}/status', [App\Http\Controllers\Company\TechController::class, 'updateProjectStatus'])->name('company.tech.projects.status');
        Route::delete('/tech/projects/{id}', [App\Http\Controllers\Company\TechController::class, 'deleteProject'])->name('company.tech.projects.delete');

        Route::get('/tech/case-studies', [App\Http\Controllers\Company\TechController::class, 'caseStudies']);
        Route::post('/tech/case-studies', [App\Http\Controllers\Company\TechController::class, 'storeCaseStudy'])->name('company.tech.case-studies.store');
        Route::delete('/tech/case-studies/{id}', [App\Http\Controllers\Company\TechController::class, 'deleteCaseStudy'])->name('company.tech.case-studies.delete');

        // Tour Management
        Route::get('/tour/packages', [App\Http\Controllers\Company\TourController::class, 'packages']);
        Route::post('/tour/packages', [App\Http\Controllers\Company\TourController::class, 'storePackage'])->name('company.tour.packages.store');
        Route::put('/tour/packages/{id}', [App\Http\Controllers\Company\TourController::class, 'updatePackage'])->name('company.tour.packages.update');
        Route::delete('/tour/packages/{id}', [App\Http\Controllers\Company\TourController::class, 'deletePackage'])->name('company.tour.packages.delete');

        Route::get('/tour/bookings', [App\Http\Controllers\Company\TourController::class, 'bookings']);
        Route::post('/tour/bookings', [App\Http\Controllers\Company\TourController::class, 'storeBooking'])->name('company.tour.bookings.store');
        Route::post('/tour/bookings/{id}/status', [App\Http\Controllers\Company\TourController::class, 'updateBookingStatus'])->name('company.tour.bookings.status');
        Route::delete('/tour/bookings/{id}', [App\Http\Controllers\Company\TourController::class, 'deleteBooking'])->name('company.tour.bookings.delete');

        // Fitness Management
        Route::get('/fitness/programs', [App\Http\Controllers\Company\FitnessController::class, 'programs']);
        Route::post('/fitness/programs', [App\Http\Controllers\Company\FitnessController::class, 'storeProgram'])->name('company.fitness.programs.store');
        Route::put('/fitness/programs/{id}', [App\Http\Controllers\Company\FitnessController::class, 'updateProgram'])->name('company.fitness.programs.update');
        Route::delete('/fitness/programs/{id}', [App\Http\Controllers\Company\FitnessController::class, 'deleteProgram'])->name('company.fitness.programs.delete');

        Route::get('/fitness/trainers', [App\Http\Controllers\Company\FitnessController::class, 'trainers']);
        Route::post('/fitness/trainers', [App\Http\Controllers\Company\FitnessController::class, 'storeTrainer'])->name('company.fitness.trainers.store');
        Route::put('/fitness/trainers/{id}', [App\Http\Controllers\Company\FitnessController::class, 'updateTrainer'])->name('company.fitness.trainers.update');
        Route::delete('/fitness/trainers/{id}', [App\Http\Controllers\Company\FitnessController::class, 'deleteTrainer'])->name('company.fitness.trainers.delete');

        Route::get('/fitness/memberships', [App\Http\Controllers\Company\FitnessController::class, 'memberships']);
        Route::post('/fitness/memberships', [App\Http\Controllers\Company\FitnessController::class, 'storeMembership'])->name('company.fitness.memberships.store');
        Route::put('/fitness/memberships/{id}', [App\Http\Controllers\Company\FitnessController::class, 'updateMembership'])->name('company.fitness.memberships.update');
        Route::delete('/fitness/memberships/{id}', [App\Http\Controllers\Company\FitnessController::class, 'deleteMembership'])->name('company.fitness.memberships.delete');

        Route::get('/fitness/subscriptions', [App\Http\Controllers\Company\FitnessController::class, 'subscriptions']);
        Route::post('/fitness/subscriptions', [App\Http\Controllers\Company\FitnessController::class, 'storeSubscription'])->name('company.fitness.subscriptions.store');
        Route::put('/fitness/subscriptions/{id}', [App\Http\Controllers\Company\FitnessController::class, 'updateSubscription'])->name('company.fitness.subscriptions.update');
        Route::delete('/fitness/subscriptions/{id}', [App\Http\Controllers\Company\FitnessController::class, 'deleteSubscription'])->name('company.fitness.subscriptions.delete');

        Route::get('/fitness/classes', [App\Http\Controllers\Company\FitnessController::class, 'classes']);
        Route::post('/fitness/classes', [App\Http\Controllers\Company\FitnessController::class, 'storeClass'])->name('company.fitness.classes.store');
        Route::put('/fitness/classes/{id}', [App\Http\Controllers\Company\FitnessController::class, 'updateClass'])->name('company.fitness.classes.update');
        Route::delete('/fitness/classes/{id}', [App\Http\Controllers\Company\FitnessController::class, 'deleteClass'])->name('company.fitness.classes.delete');

        Route::get('/fitness/bookings', [App\Http\Controllers\Company\FitnessController::class, 'bookings']);
        Route::post('/fitness/bookings', [App\Http\Controllers\Company\FitnessController::class, 'storeBooking'])->name('company.fitness.bookings.store');
        Route::post('/fitness/bookings/{id}/status', [App\Http\Controllers\Company\FitnessController::class, 'updateBookingStatus'])->name('company.fitness.bookings.status');
        Route::delete('/fitness/bookings/{id}', [App\Http\Controllers\Company\FitnessController::class, 'deleteBooking'])->name('company.fitness.bookings.delete');

        Route::get('/fitness/progress', [App\Http\Controllers\Company\FitnessController::class, 'progress']);
        Route::post('/fitness/progress', [App\Http\Controllers\Company\FitnessController::class, 'storeProgress'])->name('company.fitness.progress.store');
        Route::delete('/fitness/progress/{id}', [App\Http\Controllers\Company\FitnessController::class, 'deleteProgress'])->name('company.fitness.progress.delete');

        Route::get('/fitness/transformations', [App\Http\Controllers\Company\FitnessController::class, 'transformations']);
        Route::post('/fitness/transformations', [App\Http\Controllers\Company\FitnessController::class, 'storeTransformation'])->name('company.fitness.transformations.store');
        Route::put('/fitness/transformations/{id}', [App\Http\Controllers\Company\FitnessController::class, 'updateTransformation'])->name('company.fitness.transformations.update');
        Route::delete('/fitness/transformations/{id}', [App\Http\Controllers\Company\FitnessController::class, 'deleteTransformation'])->name('company.fitness.transformations.delete');

        Route::get('/fitness/diet-plans', [App\Http\Controllers\Company\FitnessController::class, 'dietPlans']);
        Route::post('/fitness/diet-plans', [App\Http\Controllers\Company\FitnessController::class, 'storeDietPlan'])->name('company.fitness.diet-plans.store');
        Route::put('/fitness/diet-plans/{id}', [App\Http\Controllers\Company\FitnessController::class, 'updateDietPlan'])->name('company.fitness.diet-plans.update');
        Route::delete('/fitness/diet-plans/{id}', [App\Http\Controllers\Company\FitnessController::class, 'deleteDietPlan'])->name('company.fitness.diet-plans.delete');

        // Education Management
        Route::get('/education/courses', [App\Http\Controllers\Company\EducationController::class, 'courses']);
        Route::post('/education/courses', [App\Http\Controllers\Company\EducationController::class, 'storeCourse'])->name('company.education.courses.store');
        Route::put('/education/courses/{id}', [App\Http\Controllers\Company\EducationController::class, 'updateCourse'])->name('company.education.courses.update');
        Route::delete('/education/courses/{id}', [App\Http\Controllers\Company\EducationController::class, 'deleteCourse'])->name('company.education.courses.delete');

        Route::get('/education/batches', [App\Http\Controllers\Company\EducationController::class, 'batches']);
        Route::post('/education/batches', [App\Http\Controllers\Company\EducationController::class, 'storeBatch'])->name('company.education.batches.store');
        Route::put('/education/batches/{id}', [App\Http\Controllers\Company\EducationController::class, 'updateBatch'])->name('company.education.batches.update');
        Route::delete('/education/batches/{id}', [App\Http\Controllers\Company\EducationController::class, 'deleteBatch'])->name('company.education.batches.delete');

        Route::get('/education/faculty', [App\Http\Controllers\Company\EducationController::class, 'faculty']);
        Route::post('/education/faculty', [App\Http\Controllers\Company\EducationController::class, 'storeFaculty'])->name('company.education.faculty.store');
        Route::put('/education/faculty/{id}', [App\Http\Controllers\Company\EducationController::class, 'updateFaculty'])->name('company.education.faculty.update');
        Route::delete('/education/faculty/{id}', [App\Http\Controllers\Company\EducationController::class, 'deleteFaculty'])->name('company.education.faculty.delete');

        Route::get('/education/admissions', [App\Http\Controllers\Company\EducationController::class, 'admissions']);
        Route::post('/education/admissions', [App\Http\Controllers\Company\EducationController::class, 'storeAdmission'])->name('company.education.admissions.store');
        Route::post('/education/admissions/{id}/status', [App\Http\Controllers\Company\EducationController::class, 'updateAdmissionStatus'])->name('company.education.admissions.status');
        Route::delete('/education/admissions/{id}', [App\Http\Controllers\Company\EducationController::class, 'deleteAdmission'])->name('company.education.admissions.delete');

        Route::get('/education/attendance', [App\Http\Controllers\Company\EducationController::class, 'attendance']);
        Route::post('/education/attendance', [App\Http\Controllers\Company\EducationController::class, 'storeAttendance'])->name('company.education.attendance.store');
        Route::delete('/education/attendance/{id}', [App\Http\Controllers\Company\EducationController::class, 'deleteAttendance'])->name('company.education.attendance.delete');

        Route::get('/education/tests', [App\Http\Controllers\Company\EducationController::class, 'tests']);
        Route::post('/education/tests', [App\Http\Controllers\Company\EducationController::class, 'storeTest'])->name('company.education.tests.store');
        Route::delete('/education/tests/{id}', [App\Http\Controllers\Company\EducationController::class, 'deleteTest'])->name('company.education.tests.delete');

        Route::get('/education/results', [App\Http\Controllers\Company\EducationController::class, 'results']);
        Route::post('/education/results', [App\Http\Controllers\Company\EducationController::class, 'storeResult'])->name('company.education.results.store');
        Route::delete('/education/results/{id}', [App\Http\Controllers\Company\EducationController::class, 'deleteResult'])->name('company.education.results.delete');

        Route::get('/education/materials', [App\Http\Controllers\Company\EducationController::class, 'materials']);
        Route::post('/education/materials', [App\Http\Controllers\Company\EducationController::class, 'storeMaterial'])->name('company.education.materials.store');
        Route::delete('/education/materials/{id}', [App\Http\Controllers\Company\EducationController::class, 'deleteMaterial'])->name('company.education.materials.delete');

        Route::get('/education/fee-structures', [App\Http\Controllers\Company\EducationController::class, 'feeStructures']);
        Route::post('/education/fee-structures', [App\Http\Controllers\Company\EducationController::class, 'storeFeeStructure'])->name('company.education.fee-structures.store');
        Route::delete('/education/fee-structures/{id}', [App\Http\Controllers\Company\EducationController::class, 'deleteFeeStructure'])->name('company.education.fee-structures.delete');

        Route::get('/education/student-fees', [App\Http\Controllers\Company\EducationController::class, 'studentFees']);
        Route::post('/education/student-fees', [App\Http\Controllers\Company\EducationController::class, 'storeStudentFee'])->name('company.education.student-fees.store');
        Route::delete('/education/student-fees/{id}', [App\Http\Controllers\Company\EducationController::class, 'deleteStudentFee'])->name('company.education.student-fees.delete');

        // Solar Management
        Route::get('/solar/solutions', [App\Http\Controllers\Company\SolarController::class, 'solutions']);
        Route::post('/solar/solutions', [App\Http\Controllers\Company\SolarController::class, 'storeSolution'])->name('company.solar.solutions.store');
        Route::put('/solar/solutions/{id}', [App\Http\Controllers\Company\SolarController::class, 'updateSolution'])->name('company.solar.solutions.update');
        Route::delete('/solar/solutions/{id}', [App\Http\Controllers\Company\SolarController::class, 'deleteSolution'])->name('company.solar.solutions.delete');

        Route::get('/solar/surveys', [App\Http\Controllers\Company\SolarController::class, 'surveys']);
        Route::post('/solar/surveys', [App\Http\Controllers\Company\SolarController::class, 'storeSurvey'])->name('company.solar.surveys.store');
        Route::post('/solar/surveys/{id}/status', [App\Http\Controllers\Company\SolarController::class, 'updateSurveyStatus'])->name('company.solar.surveys.status');
        Route::delete('/solar/surveys/{id}', [App\Http\Controllers\Company\SolarController::class, 'deleteSurvey'])->name('company.solar.surveys.delete');

        Route::get('/solar/projects', [App\Http\Controllers\Company\SolarController::class, 'projects']);
        Route::post('/solar/projects', [App\Http\Controllers\Company\SolarController::class, 'storeProject'])->name('company.solar.projects.store');
        Route::post('/solar/projects/{id}/status', [App\Http\Controllers\Company\SolarController::class, 'updateProjectStatus'])->name('company.solar.projects.status');
        Route::delete('/solar/projects/{id}', [App\Http\Controllers\Company\SolarController::class, 'deleteProject'])->name('company.solar.projects.delete');

        Route::get('/solar/subsidies', [App\Http\Controllers\Company\SolarController::class, 'subsidies']);
        Route::post('/solar/subsidies', [App\Http\Controllers\Company\SolarController::class, 'storeSubsidy'])->name('company.solar.subsidies.store');
        Route::post('/solar/subsidies/{id}/status', [App\Http\Controllers\Company\SolarController::class, 'updateSubsidyStatus'])->name('company.solar.subsidies.status');
        Route::delete('/solar/subsidies/{id}', [App\Http\Controllers\Company\SolarController::class, 'deleteSubsidy'])->name('company.solar.subsidies.delete');

        Route::get('/solar/monitoring', [App\Http\Controllers\Company\SolarController::class, 'monitoring']);
        Route::post('/solar/monitoring', [App\Http\Controllers\Company\SolarController::class, 'storeMonitoring'])->name('company.solar.monitoring.store');
        Route::delete('/solar/monitoring/{id}', [App\Http\Controllers\Company\SolarController::class, 'deleteMonitoring'])->name('company.solar.monitoring.delete');

        Route::get('/solar/amc', [App\Http\Controllers\Company\SolarController::class, 'amc']);
        Route::post('/solar/amc', [App\Http\Controllers\Company\SolarController::class, 'storeAmc'])->name('company.solar.amc.store');
        Route::delete('/solar/amc/{id}', [App\Http\Controllers\Company\SolarController::class, 'deleteAmc'])->name('company.solar.amc.delete');

        // CA Management
        Route::get('/ca/services', [App\Http\Controllers\Company\CaController::class, 'services']);
        Route::post('/ca/services', [App\Http\Controllers\Company\CaController::class, 'storeService'])->name('company.ca.services.store');
        Route::put('/ca/services/{id}', [App\Http\Controllers\Company\CaController::class, 'updateService'])->name('company.ca.services.update');
        Route::delete('/ca/services/{id}', [App\Http\Controllers\Company\CaController::class, 'deleteService'])->name('company.ca.services.delete');

        Route::get('/ca/cases', [App\Http\Controllers\Company\CaController::class, 'cases']);
        Route::post('/ca/cases', [App\Http\Controllers\Company\CaController::class, 'storeCase'])->name('company.ca.cases.store');
        Route::post('/ca/cases/{id}/status', [App\Http\Controllers\Company\CaController::class, 'updateCaseStatus'])->name('company.ca.cases.status');
        Route::delete('/ca/cases/{id}', [App\Http\Controllers\Company\CaController::class, 'deleteCase'])->name('company.ca.cases.delete');

        Route::get('/ca/consultations', [App\Http\Controllers\Company\CaController::class, 'consultations']);
        Route::post('/ca/consultations', [App\Http\Controllers\Company\CaController::class, 'storeConsultation'])->name('company.ca.consultations.store');
        Route::post('/ca/consultations/{id}/status', [App\Http\Controllers\Company\CaController::class, 'updateConsultationStatus'])->name('company.ca.consultations.status');
        Route::delete('/ca/consultations/{id}', [App\Http\Controllers\Company\CaController::class, 'deleteConsultation'])->name('company.ca.consultations.delete');

        Route::get('/ca/deadlines', [App\Http\Controllers\Company\CaController::class, 'deadlines']);
        Route::post('/ca/deadlines', [App\Http\Controllers\Company\CaController::class, 'storeDeadline'])->name('company.ca.deadlines.store');
        Route::put('/ca/deadlines/{id}', [App\Http\Controllers\Company\CaController::class, 'updateDeadline'])->name('company.ca.deadlines.update');
        Route::delete('/ca/deadlines/{id}', [App\Http\Controllers\Company\CaController::class, 'deleteDeadline'])->name('company.ca.deadlines.delete');

        // Astrologer Management
        Route::get('/astrologer/services', [App\Http\Controllers\Company\AstrologerController::class, 'services']);
        Route::post('/astrologer/services', [App\Http\Controllers\Company\AstrologerController::class, 'storeService'])->name('company.astrologer.services.store');
        Route::put('/astrologer/services/{id}', [App\Http\Controllers\Company\AstrologerController::class, 'updateService'])->name('company.astrologer.services.update');
        Route::delete('/astrologer/services/{id}', [App\Http\Controllers\Company\AstrologerController::class, 'deleteService'])->name('company.astrologer.services.delete');

        Route::get('/astrologer/consultations', [App\Http\Controllers\Company\AstrologerController::class, 'consultations']);
        Route::post('/astrologer/consultations', [App\Http\Controllers\Company\AstrologerController::class, 'storeConsultation'])->name('company.astrologer.consultations.store');
        Route::post('/astrologer/consultations/{id}/status', [App\Http\Controllers\Company\AstrologerController::class, 'updateConsultationStatus'])->name('company.astrologer.consultations.status');
        Route::delete('/astrologer/consultations/{id}', [App\Http\Controllers\Company\AstrologerController::class, 'deleteConsultation'])->name('company.astrologer.consultations.delete');

        Route::get('/astrologer/reports', [App\Http\Controllers\Company\AstrologerController::class, 'reports']);
        Route::post('/astrologer/reports', [App\Http\Controllers\Company\AstrologerController::class, 'storeReport'])->name('company.astrologer.reports.store');
        Route::delete('/astrologer/reports/{id}', [App\Http\Controllers\Company\AstrologerController::class, 'deleteReport'])->name('company.astrologer.reports.delete');

        // Security Management
        Route::get('/security/products', [App\Http\Controllers\Company\SecurityController::class, 'products']);
        Route::post('/security/products', [App\Http\Controllers\Company\SecurityController::class, 'storeProduct'])->name('company.security.products.store');
        Route::put('/security/products/{id}', [App\Http\Controllers\Company\SecurityController::class, 'updateProduct'])->name('company.security.products.update');
        Route::delete('/security/products/{id}', [App\Http\Controllers\Company\SecurityController::class, 'deleteProduct'])->name('company.security.products.delete');

        Route::get('/security/surveys', [App\Http\Controllers\Company\SecurityController::class, 'surveys']);
        Route::post('/security/surveys', [App\Http\Controllers\Company\SecurityController::class, 'storeSurvey'])->name('company.security.surveys.store');
        Route::post('/security/surveys/{id}/status', [App\Http\Controllers\Company\SecurityController::class, 'updateSurveyStatus'])->name('company.security.surveys.status');
        Route::delete('/security/surveys/{id}', [App\Http\Controllers\Company\SecurityController::class, 'deleteSurvey'])->name('company.security.surveys.delete');

        Route::get('/security/projects', [App\Http\Controllers\Company\SecurityController::class, 'projects']);
        Route::post('/security/projects', [App\Http\Controllers\Company\SecurityController::class, 'storeProject'])->name('company.security.projects.store');
        Route::post('/security/projects/{id}/status', [App\Http\Controllers\Company\SecurityController::class, 'updateProjectStatus'])->name('company.security.projects.status');
        Route::delete('/security/projects/{id}', [App\Http\Controllers\Company\SecurityController::class, 'deleteProject'])->name('company.security.projects.delete');

        Route::get('/security/amc', [App\Http\Controllers\Company\SecurityController::class, 'amc']);
        Route::post('/security/amc', [App\Http\Controllers\Company\SecurityController::class, 'storeAmc'])->name('company.security.amc.store');
        Route::delete('/security/amc/{id}', [App\Http\Controllers\Company\SecurityController::class, 'deleteAmc'])->name('company.security.amc.delete');

        // Influencer Management
        Route::get('/influencer/stats', [App\Http\Controllers\Company\InfluencerController::class, 'stats']);
        Route::post('/influencer/stats', [App\Http\Controllers\Company\InfluencerController::class, 'storeStat'])->name('company.influencer.stats.store');
        Route::put('/influencer/stats/{id}', [App\Http\Controllers\Company\InfluencerController::class, 'updateStat'])->name('company.influencer.stats.update');
        Route::delete('/influencer/stats/{id}', [App\Http\Controllers\Company\InfluencerController::class, 'deleteStat'])->name('company.influencer.stats.delete');

        Route::get('/influencer/collaborations', [App\Http\Controllers\Company\InfluencerController::class, 'collaborations']);
        Route::post('/influencer/collaborations', [App\Http\Controllers\Company\InfluencerController::class, 'storeCollaboration'])->name('company.influencer.collaborations.store');
        Route::put('/influencer/collaborations/{id}', [App\Http\Controllers\Company\InfluencerController::class, 'updateCollaboration'])->name('company.influencer.collaborations.update');
        Route::delete('/influencer/collaborations/{id}', [App\Http\Controllers\Company\InfluencerController::class, 'deleteCollaboration'])->name('company.influencer.collaborations.delete');

        Route::get('/influencer/portfolio', [App\Http\Controllers\Company\InfluencerController::class, 'portfolio']);
        Route::post('/influencer/portfolio', [App\Http\Controllers\Company\InfluencerController::class, 'storePortfolio'])->name('company.influencer.portfolio.store');
        Route::put('/influencer/portfolio/{id}', [App\Http\Controllers\Company\InfluencerController::class, 'updatePortfolio'])->name('company.influencer.portfolio.update');
        Route::delete('/influencer/portfolio/{id}', [App\Http\Controllers\Company\InfluencerController::class, 'deletePortfolio'])->name('company.influencer.portfolio.delete');

        // Lawyer Management
        Route::get('/lawyer/services', [App\Http\Controllers\Company\LawyerController::class, 'services']);
        Route::post('/lawyer/services', [App\Http\Controllers\Company\LawyerController::class, 'storeService'])->name('company.lawyer.services.store');
        Route::put('/lawyer/services/{id}', [App\Http\Controllers\Company\LawyerController::class, 'updateService'])->name('company.lawyer.services.update');
        Route::delete('/lawyer/services/{id}', [App\Http\Controllers\Company\LawyerController::class, 'deleteService'])->name('company.lawyer.services.delete');

        Route::get('/lawyer/cases', [App\Http\Controllers\Company\LawyerController::class, 'cases']);
        Route::post('/lawyer/cases', [App\Http\Controllers\Company\LawyerController::class, 'storeCase'])->name('company.lawyer.cases.store');
        Route::post('/lawyer/cases/{id}/status', [App\Http\Controllers\Company\LawyerController::class, 'updateCaseStatus'])->name('company.lawyer.cases.status');
        Route::delete('/lawyer/cases/{id}', [App\Http\Controllers\Company\LawyerController::class, 'deleteCase'])->name('company.lawyer.cases.delete');

        Route::get('/lawyer/hearings', [App\Http\Controllers\Company\LawyerController::class, 'hearings']);
        Route::post('/lawyer/hearings', [App\Http\Controllers\Company\LawyerController::class, 'storeHearing'])->name('company.lawyer.hearings.store');
        Route::put('/lawyer/hearings/{id}', [App\Http\Controllers\Company\LawyerController::class, 'updateHearing'])->name('company.lawyer.hearings.update');
        Route::delete('/lawyer/hearings/{id}', [App\Http\Controllers\Company\LawyerController::class, 'deleteHearing'])->name('company.lawyer.hearings.delete');

        Route::get('/lawyer/consultations', [App\Http\Controllers\Company\LawyerController::class, 'consultations']);
        Route::post('/lawyer/consultations', [App\Http\Controllers\Company\LawyerController::class, 'storeConsultation'])->name('company.lawyer.consultations.store');
        Route::post('/lawyer/consultations/{id}/status', [App\Http\Controllers\Company\LawyerController::class, 'updateConsultationStatus'])->name('company.lawyer.consultations.status');
        Route::delete('/lawyer/consultations/{id}', [App\Http\Controllers\Company\LawyerController::class, 'deleteConsultation'])->name('company.lawyer.consultations.delete');

        // Salon Management
        Route::get('/salon/services', [App\Http\Controllers\Company\SalonController::class, 'services']);
        Route::post('/salon/services', [App\Http\Controllers\Company\SalonController::class, 'storeService'])->name('company.salon.services.store');
        Route::put('/salon/services/{id}', [App\Http\Controllers\Company\SalonController::class, 'updateService'])->name('company.salon.services.update');
        Route::delete('/salon/services/{id}', [App\Http\Controllers\Company\SalonController::class, 'deleteService'])->name('company.salon.services.delete');

        Route::get('/salon/artists', [App\Http\Controllers\Company\SalonController::class, 'artists']);
        Route::post('/salon/artists', [App\Http\Controllers\Company\SalonController::class, 'storeArtist'])->name('company.salon.artists.store');
        Route::put('/salon/artists/{id}', [App\Http\Controllers\Company\SalonController::class, 'updateArtist'])->name('company.salon.artists.update');
        Route::delete('/salon/artists/{id}', [App\Http\Controllers\Company\SalonController::class, 'deleteArtist'])->name('company.salon.artists.delete');

        Route::get('/salon/appointments', [App\Http\Controllers\Company\SalonController::class, 'appointments']);
        Route::post('/salon/appointments', [App\Http\Controllers\Company\SalonController::class, 'storeAppointment'])->name('company.salon.appointments.store');
        Route::post('/salon/appointments/{id}/status', [App\Http\Controllers\Company\SalonController::class, 'updateAppointmentStatus'])->name('company.salon.appointments.status');
        Route::delete('/salon/appointments/{id}', [App\Http\Controllers\Company\SalonController::class, 'deleteAppointment'])->name('company.salon.appointments.delete');

        Route::get('/salon/packages', [App\Http\Controllers\Company\SalonController::class, 'packages']);
        Route::post('/salon/packages', [App\Http\Controllers\Company\SalonController::class, 'storePackage'])->name('company.salon.packages.store');
        Route::put('/salon/packages/{id}', [App\Http\Controllers\Company\SalonController::class, 'updatePackage'])->name('company.salon.packages.update');
        Route::delete('/salon/packages/{id}', [App\Http\Controllers\Company\SalonController::class, 'deletePackage'])->name('company.salon.packages.delete');

        Route::get('/salon/portfolio', [App\Http\Controllers\Company\SalonController::class, 'portfolio']);
        Route::post('/salon/portfolio', [App\Http\Controllers\Company\SalonController::class, 'storePortfolio'])->name('company.salon.portfolio.store');
        Route::put('/salon/portfolio/{id}', [App\Http\Controllers\Company\SalonController::class, 'updatePortfolio'])->name('company.salon.portfolio.update');
        Route::delete('/salon/portfolio/{id}', [App\Http\Controllers\Company\SalonController::class, 'deletePortfolio'])->name('company.salon.portfolio.delete');

        Route::get('/salon/products', [App\Http\Controllers\Company\SalonController::class, 'products']);
        Route::post('/salon/products', [App\Http\Controllers\Company\SalonController::class, 'storeProduct'])->name('company.salon.products.store');
        Route::put('/salon/products/{id}', [App\Http\Controllers\Company\SalonController::class, 'updateProduct'])->name('company.salon.products.update');
        Route::delete('/salon/products/{id}', [App\Http\Controllers\Company\SalonController::class, 'deleteProduct'])->name('company.salon.products.delete');

        // Political Management
        Route::get('/political/profiles', [App\Http\Controllers\Company\PoliticalController::class, 'profiles']);
        Route::post('/political/profiles', [App\Http\Controllers\Company\PoliticalController::class, 'storeProfile'])->name('company.political.profiles.store');
        Route::put('/political/profiles/{id}', [App\Http\Controllers\Company\PoliticalController::class, 'updateProfile'])->name('company.political.profiles.update');
        Route::delete('/political/profiles/{id}', [App\Http\Controllers\Company\PoliticalController::class, 'deleteProfile'])->name('company.political.profiles.delete');

        Route::get('/political/services', [App\Http\Controllers\Company\PoliticalController::class, 'services']);
        Route::post('/political/services', [App\Http\Controllers\Company\PoliticalController::class, 'storeService'])->name('company.political.services.store');
        Route::put('/political/services/{id}', [App\Http\Controllers\Company\PoliticalController::class, 'updateService'])->name('company.political.services.update');
        Route::delete('/political/services/{id}', [App\Http\Controllers\Company\PoliticalController::class, 'deleteService'])->name('company.political.services.delete');

        Route::get('/political/projects', [App\Http\Controllers\Company\PoliticalController::class, 'projects']);
        Route::post('/political/projects', [App\Http\Controllers\Company\PoliticalController::class, 'storeProject'])->name('company.political.projects.store');
        Route::put('/political/projects/{id}', [App\Http\Controllers\Company\PoliticalController::class, 'updateProject'])->name('company.political.projects.update');
        Route::delete('/political/projects/{id}', [App\Http\Controllers\Company\PoliticalController::class, 'deleteProject'])->name('company.political.projects.delete');

        Route::get('/political/events', [App\Http\Controllers\Company\PoliticalController::class, 'events']);
        Route::post('/political/events', [App\Http\Controllers\Company\PoliticalController::class, 'storeEvent'])->name('company.political.events.store');
        Route::put('/political/events/{id}', [App\Http\Controllers\Company\PoliticalController::class, 'updateEvent'])->name('company.political.events.update');
        Route::delete('/political/events/{id}', [App\Http\Controllers\Company\PoliticalController::class, 'deleteEvent'])->name('company.political.events.delete');

        Route::get('/political/volunteers', [App\Http\Controllers\Company\PoliticalController::class, 'volunteers']);
        Route::post('/political/volunteers', [App\Http\Controllers\Company\PoliticalController::class, 'storeVolunteer'])->name('company.political.volunteers.store');
        Route::put('/political/volunteers/{id}', [App\Http\Controllers\Company\PoliticalController::class, 'updateVolunteer'])->name('company.political.volunteers.update');
        Route::delete('/political/volunteers/{id}', [App\Http\Controllers\Company\PoliticalController::class, 'deleteVolunteer'])->name('company.political.volunteers.delete');

        Route::get('/political/grievances', [App\Http\Controllers\Company\PoliticalController::class, 'grievances']);
        Route::post('/political/grievances', [App\Http\Controllers\Company\PoliticalController::class, 'storeGrievance'])->name('company.political.grievances.store');
        Route::post('/political/grievances/{id}/status', [App\Http\Controllers\Company\PoliticalController::class, 'updateGrievanceStatus'])->name('company.political.grievances.status');
        Route::delete('/political/grievances/{id}', [App\Http\Controllers\Company\PoliticalController::class, 'deleteGrievance'])->name('company.political.grievances.delete');

        // Interior Management
        Route::get('/interior/services', [App\Http\Controllers\Company\InteriorController::class, 'services']);
        Route::post('/interior/services', [App\Http\Controllers\Company\InteriorController::class, 'storeService'])->name('company.interior.services.store');
        Route::put('/interior/services/{id}', [App\Http\Controllers\Company\InteriorController::class, 'updateService'])->name('company.interior.services.update');
        Route::delete('/interior/services/{id}', [App\Http\Controllers\Company\InteriorController::class, 'deleteService'])->name('company.interior.services.delete');

        Route::get('/interior/projects', [App\Http\Controllers\Company\InteriorController::class, 'projects']);
        Route::post('/interior/projects', [App\Http\Controllers\Company\InteriorController::class, 'storeProject'])->name('company.interior.projects.store');
        Route::put('/interior/projects/{id}', [App\Http\Controllers\Company\InteriorController::class, 'updateProject'])->name('company.interior.projects.update');
        Route::delete('/interior/projects/{id}', [App\Http\Controllers\Company\InteriorController::class, 'deleteProject'])->name('company.interior.projects.delete');

        Route::get('/interior/portfolio', [App\Http\Controllers\Company\InteriorController::class, 'portfolio']);
        Route::post('/interior/portfolio', [App\Http\Controllers\Company\InteriorController::class, 'storePortfolio'])->name('company.interior.portfolio.store');
        Route::put('/interior/portfolio/{id}', [App\Http\Controllers\Company\InteriorController::class, 'updatePortfolio'])->name('company.interior.portfolio.update');
        Route::delete('/interior/portfolio/{id}', [App\Http\Controllers\Company\InteriorController::class, 'deletePortfolio'])->name('company.interior.portfolio.delete');

        Route::get('/interior/consultations', [App\Http\Controllers\Company\InteriorController::class, 'consultations']);
        Route::post('/interior/consultations', [App\Http\Controllers\Company\InteriorController::class, 'storeConsultation'])->name('company.interior.consultations.store');
        Route::post('/interior/consultations/{id}/status', [App\Http\Controllers\Company\InteriorController::class, 'updateConsultationStatus'])->name('company.interior.consultations.status');
        Route::delete('/interior/consultations/{id}', [App\Http\Controllers\Company\InteriorController::class, 'deleteConsultation'])->name('company.interior.consultations.delete');
    });
});

// ============================================
// E-COMMERCE STORE ROUTES (Phase 4)
// ============================================

// Frontend Store Routes (Public)
Route::prefix('Product')->name('store.')->group(function () {
    Route::get('/', [App\Http\Controllers\Frontend\StoreController::class, 'index'])->name('index');
    Route::get('/search', [App\Http\Controllers\Frontend\StoreController::class, 'search'])->name('search');
    Route::get('/category/{slug}', [App\Http\Controllers\Frontend\StoreController::class, 'category'])->name('category');
    Route::get('/seller/{id}', [App\Http\Controllers\Frontend\StoreController::class, 'seller'])->name('seller');
    Route::get('/{slug}', [App\Http\Controllers\Frontend\StoreController::class, 'show'])->name('show');
});

// Admin E-Commerce Routes
Route::middleware(['auth:admin'])->prefix('admin-new')->name('admin.')->group(function () {
    // Product Management
    Route::resource('products', App\Http\Controllers\Admin\ProductAdminController::class);
    Route::get('products-pending', [App\Http\Controllers\Admin\ProductAdminController::class, 'pending'])->name('products.pending');
    Route::post('products/{id}/approve', [App\Http\Controllers\Admin\ProductAdminController::class, 'approve'])->name('products.approve');
    Route::post('products/{id}/reject', [App\Http\Controllers\Admin\ProductAdminController::class, 'reject'])->name('products.reject');
    Route::post('products/{id}/toggle-featured', [App\Http\Controllers\Admin\ProductAdminController::class, 'toggleFeatured'])->name('products.toggle-featured');

    // Category Management
    Route::resource('categories', App\Http\Controllers\Admin\CategoryAdminController::class);
});

// User Store Routes
Route::middleware(['auth:customer'])->prefix('user')->name('user.')->group(function () {
    Route::resource('products', App\Http\Controllers\User\UserProductController::class);
});

Route::middleware(['auth:customer'])->prefix('user/political')->name('political.')->group(function () {
    Route::get('/profiles', [App\Http\Controllers\PoliticalController::class, 'profiles']);
    Route::post('/profiles', [App\Http\Controllers\PoliticalController::class, 'storeProfile'])->name('profiles.store');
    Route::put('/profiles/{id}', [App\Http\Controllers\PoliticalController::class, 'updateProfile'])->name('profiles.update');
    Route::delete('/profiles/{id}', [App\Http\Controllers\PoliticalController::class, 'deleteProfile'])->name('profiles.delete');

    Route::get('/services', [App\Http\Controllers\PoliticalController::class, 'services']);
    Route::post('/services', [App\Http\Controllers\PoliticalController::class, 'storeService'])->name('services.store');
    Route::put('/services/{id}', [App\Http\Controllers\PoliticalController::class, 'updateService'])->name('services.update');
    Route::delete('/services/{id}', [App\Http\Controllers\PoliticalController::class, 'deleteService'])->name('services.delete');

    Route::get('/projects', [App\Http\Controllers\PoliticalController::class, 'projects']);
    Route::post('/projects', [App\Http\Controllers\PoliticalController::class, 'storeProject'])->name('projects.store');
    Route::put('/projects/{id}', [App\Http\Controllers\PoliticalController::class, 'updateProject'])->name('projects.update');
    Route::delete('/projects/{id}', [App\Http\Controllers\PoliticalController::class, 'deleteProject'])->name('projects.delete');

    Route::get('/events', [App\Http\Controllers\PoliticalController::class, 'events']);
    Route::post('/events', [App\Http\Controllers\PoliticalController::class, 'storeEvent'])->name('events.store');
    Route::put('/events/{id}', [App\Http\Controllers\PoliticalController::class, 'updateEvent'])->name('events.update');
    Route::delete('/events/{id}', [App\Http\Controllers\PoliticalController::class, 'deleteEvent'])->name('events.delete');

    Route::get('/volunteers', [App\Http\Controllers\PoliticalController::class, 'volunteers']);
    Route::post('/volunteers', [App\Http\Controllers\PoliticalController::class, 'storeVolunteer'])->name('volunteers.store');
    Route::put('/volunteers/{id}', [App\Http\Controllers\PoliticalController::class, 'updateVolunteer'])->name('volunteers.update');
    Route::delete('/volunteers/{id}', [App\Http\Controllers\PoliticalController::class, 'deleteVolunteer'])->name('volunteers.delete');

    Route::get('/grievances', [App\Http\Controllers\PoliticalController::class, 'grievances']);
    Route::post('/grievances', [App\Http\Controllers\PoliticalController::class, 'storeGrievance'])->name('grievances.store');
    Route::post('/grievances/{id}/status', [App\Http\Controllers\PoliticalController::class, 'updateGrievanceStatus'])->name('grievances.status');
    Route::delete('/grievances/{id}', [App\Http\Controllers\PoliticalController::class, 'deleteGrievance'])->name('grievances.delete');
});

Route::middleware(['auth:customer'])->prefix('user/interior')->name('interior.')->group(function () {
    Route::get('/services', [App\Http\Controllers\InteriorController::class, 'services']);
    Route::post('/services', [App\Http\Controllers\InteriorController::class, 'storeService'])->name('services.store');
    Route::put('/services/{id}', [App\Http\Controllers\InteriorController::class, 'updateService'])->name('services.update');
    Route::delete('/services/{id}', [App\Http\Controllers\InteriorController::class, 'deleteService'])->name('services.delete');

    Route::get('/projects', [App\Http\Controllers\InteriorController::class, 'projects']);
    Route::post('/projects', [App\Http\Controllers\InteriorController::class, 'storeProject'])->name('projects.store');
    Route::put('/projects/{id}', [App\Http\Controllers\InteriorController::class, 'updateProject'])->name('projects.update');
    Route::delete('/projects/{id}', [App\Http\Controllers\InteriorController::class, 'deleteProject'])->name('projects.delete');

    Route::get('/portfolio', [App\Http\Controllers\InteriorController::class, 'portfolio']);
    Route::post('/portfolio', [App\Http\Controllers\InteriorController::class, 'storePortfolio'])->name('portfolio.store');
    Route::put('/portfolio/{id}', [App\Http\Controllers\InteriorController::class, 'updatePortfolio'])->name('portfolio.update');
    Route::delete('/portfolio/{id}', [App\Http\Controllers\InteriorController::class, 'deletePortfolio'])->name('portfolio.delete');

    Route::get('/consultations', [App\Http\Controllers\InteriorController::class, 'consultations']);
    Route::post('/consultations', [App\Http\Controllers\InteriorController::class, 'storeConsultation'])->name('consultations.store');
    Route::post('/consultations/{id}/status', [App\Http\Controllers\InteriorController::class, 'updateConsultationStatus'])->name('consultations.status');
    Route::delete('/consultations/{id}', [App\Http\Controllers\InteriorController::class, 'deleteConsultation'])->name('consultations.delete');
});

Route::middleware(['auth:customer'])->prefix('user/education')->name('education.')->group(function () {
    Route::get('/courses', [App\Http\Controllers\EducationController::class, 'courses']);
    Route::post('/courses', [App\Http\Controllers\EducationController::class, 'storeCourse'])->name('courses.store');
    Route::put('/courses/{id}', [App\Http\Controllers\EducationController::class, 'updateCourse'])->name('courses.update');
    Route::delete('/courses/{id}', [App\Http\Controllers\EducationController::class, 'deleteCourse'])->name('courses.delete');

    Route::get('/batches', [App\Http\Controllers\EducationController::class, 'batches']);
    Route::post('/batches', [App\Http\Controllers\EducationController::class, 'storeBatch'])->name('batches.store');
    Route::put('/batches/{id}', [App\Http\Controllers\EducationController::class, 'updateBatch'])->name('batches.update');
    Route::delete('/batches/{id}', [App\Http\Controllers\EducationController::class, 'deleteBatch'])->name('batches.delete');

    Route::get('/faculty', [App\Http\Controllers\EducationController::class, 'faculty']);
    Route::post('/faculty', [App\Http\Controllers\EducationController::class, 'storeFaculty'])->name('faculty.store');
    Route::put('/faculty/{id}', [App\Http\Controllers\EducationController::class, 'updateFaculty'])->name('faculty.update');
    Route::delete('/faculty/{id}', [App\Http\Controllers\EducationController::class, 'deleteFaculty'])->name('faculty.delete');

    Route::get('/admissions', [App\Http\Controllers\EducationController::class, 'admissions']);
    Route::post('/admissions', [App\Http\Controllers\EducationController::class, 'storeAdmission'])->name('admissions.store');
    Route::post('/admissions/{id}/status', [App\Http\Controllers\EducationController::class, 'updateAdmissionStatus'])->name('admissions.status');
    Route::delete('/admissions/{id}', [App\Http\Controllers\EducationController::class, 'deleteAdmission'])->name('admissions.delete');

    Route::get('/attendance', [App\Http\Controllers\EducationController::class, 'attendance']);
    Route::post('/attendance', [App\Http\Controllers\EducationController::class, 'storeAttendance'])->name('attendance.store');
    Route::delete('/attendance/{id}', [App\Http\Controllers\EducationController::class, 'deleteAttendance'])->name('attendance.delete');

    Route::get('/tests', [App\Http\Controllers\EducationController::class, 'tests']);
    Route::post('/tests', [App\Http\Controllers\EducationController::class, 'storeTest'])->name('tests.store');
    Route::delete('/tests/{id}', [App\Http\Controllers\EducationController::class, 'deleteTest'])->name('tests.delete');

    Route::get('/results', [App\Http\Controllers\EducationController::class, 'results']);
    Route::post('/results', [App\Http\Controllers\EducationController::class, 'storeResult'])->name('results.store');
    Route::delete('/results/{id}', [App\Http\Controllers\EducationController::class, 'deleteResult'])->name('results.delete');

    Route::get('/materials', [App\Http\Controllers\EducationController::class, 'materials']);
    Route::post('/materials', [App\Http\Controllers\EducationController::class, 'storeMaterial'])->name('materials.store');
    Route::delete('/materials/{id}', [App\Http\Controllers\EducationController::class, 'deleteMaterial'])->name('materials.delete');

    Route::get('/fee-structures', [App\Http\Controllers\EducationController::class, 'feeStructures']);
    Route::post('/fee-structures', [App\Http\Controllers\EducationController::class, 'storeFeeStructure'])->name('fee-structures.store');
    Route::delete('/fee-structures/{id}', [App\Http\Controllers\EducationController::class, 'deleteFeeStructure'])->name('fee-structures.delete');

    Route::get('/student-fees', [App\Http\Controllers\EducationController::class, 'studentFees']);
    Route::post('/student-fees', [App\Http\Controllers\EducationController::class, 'storeStudentFee'])->name('student-fees.store');
    Route::delete('/student-fees/{id}', [App\Http\Controllers\EducationController::class, 'deleteStudentFee'])->name('student-fees.delete');
});

Route::middleware(['auth:customer'])->prefix('user/ca')->name('ca.')->group(function () {
    Route::get('/services', [App\Http\Controllers\CaController::class, 'services']);
    Route::post('/services', [App\Http\Controllers\CaController::class, 'storeService'])->name('services.store');
    Route::put('/services/{id}', [App\Http\Controllers\CaController::class, 'updateService'])->name('services.update');
    Route::delete('/services/{id}', [App\Http\Controllers\CaController::class, 'deleteService'])->name('services.delete');

    Route::get('/cases', [App\Http\Controllers\CaController::class, 'cases']);
    Route::post('/cases', [App\Http\Controllers\CaController::class, 'storeCase'])->name('cases.store');
    Route::post('/cases/{id}/status', [App\Http\Controllers\CaController::class, 'updateCaseStatus'])->name('cases.status');
    Route::delete('/cases/{id}', [App\Http\Controllers\CaController::class, 'deleteCase'])->name('cases.delete');

    Route::get('/consultations', [App\Http\Controllers\CaController::class, 'consultations']);
    Route::post('/consultations', [App\Http\Controllers\CaController::class, 'storeConsultation'])->name('consultations.store');
    Route::post('/consultations/{id}/status', [App\Http\Controllers\CaController::class, 'updateConsultationStatus'])->name('consultations.status');
    Route::delete('/consultations/{id}', [App\Http\Controllers\CaController::class, 'deleteConsultation'])->name('consultations.delete');

    Route::get('/deadlines', [App\Http\Controllers\CaController::class, 'deadlines']);
    Route::post('/deadlines', [App\Http\Controllers\CaController::class, 'storeDeadline'])->name('deadlines.store');
    Route::put('/deadlines/{id}', [App\Http\Controllers\CaController::class, 'updateDeadline'])->name('deadlines.update');
    Route::delete('/deadlines/{id}', [App\Http\Controllers\CaController::class, 'deleteDeadline'])->name('deadlines.delete');
});

Route::middleware(['auth:customer'])->prefix('user/astrologer')->name('astrologer.')->group(function () {
    Route::get('/services', [App\Http\Controllers\AstrologerController::class, 'services']);
    Route::post('/services', [App\Http\Controllers\AstrologerController::class, 'storeService'])->name('services.store');
    Route::put('/services/{id}', [App\Http\Controllers\AstrologerController::class, 'updateService'])->name('services.update');
    Route::delete('/services/{id}', [App\Http\Controllers\AstrologerController::class, 'deleteService'])->name('services.delete');

    Route::get('/consultations', [App\Http\Controllers\AstrologerController::class, 'consultations']);
    Route::post('/consultations', [App\Http\Controllers\AstrologerController::class, 'storeConsultation'])->name('consultations.store');
    Route::post('/consultations/{id}/status', [App\Http\Controllers\AstrologerController::class, 'updateConsultationStatus'])->name('consultations.status');
    Route::delete('/consultations/{id}', [App\Http\Controllers\AstrologerController::class, 'deleteConsultation'])->name('consultations.delete');

    Route::get('/reports', [App\Http\Controllers\AstrologerController::class, 'reports']);
    Route::post('/reports', [App\Http\Controllers\AstrologerController::class, 'storeReport'])->name('reports.store');
    Route::delete('/reports/{id}', [App\Http\Controllers\AstrologerController::class, 'deleteReport'])->name('reports.delete');
});

Route::middleware(['auth:customer'])->prefix('user/security')->name('security.')->group(function () {
    Route::get('/products', [App\Http\Controllers\SecurityController::class, 'products']);
    Route::post('/products', [App\Http\Controllers\SecurityController::class, 'storeProduct'])->name('products.store');
    Route::put('/products/{id}', [App\Http\Controllers\SecurityController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{id}', [App\Http\Controllers\SecurityController::class, 'deleteProduct'])->name('products.delete');

    Route::get('/surveys', [App\Http\Controllers\SecurityController::class, 'surveys']);
    Route::post('/surveys', [App\Http\Controllers\SecurityController::class, 'storeSurvey'])->name('surveys.store');
    Route::post('/surveys/{id}/status', [App\Http\Controllers\SecurityController::class, 'updateSurveyStatus'])->name('surveys.status');
    Route::delete('/surveys/{id}', [App\Http\Controllers\SecurityController::class, 'deleteSurvey'])->name('surveys.delete');

    Route::get('/projects', [App\Http\Controllers\SecurityController::class, 'projects']);
    Route::post('/projects', [App\Http\Controllers\SecurityController::class, 'storeProject'])->name('projects.store');
    Route::post('/projects/{id}/status', [App\Http\Controllers\SecurityController::class, 'updateProjectStatus'])->name('projects.status');
    Route::delete('/projects/{id}', [App\Http\Controllers\SecurityController::class, 'deleteProject'])->name('projects.delete');

    Route::get('/amc', [App\Http\Controllers\SecurityController::class, 'amc']);
    Route::post('/amc', [App\Http\Controllers\SecurityController::class, 'storeAmc'])->name('amc.store');
    Route::delete('/amc/{id}', [App\Http\Controllers\SecurityController::class, 'deleteAmc'])->name('amc.delete');
});

Route::middleware(['auth:customer'])->prefix('user/solar')->name('solar.')->group(function () {
    Route::get('/solutions', [App\Http\Controllers\SolarController::class, 'solutions']);
    Route::post('/solutions', [App\Http\Controllers\SolarController::class, 'storeSolution'])->name('solutions.store');
    Route::put('/solutions/{id}', [App\Http\Controllers\SolarController::class, 'updateSolution'])->name('solutions.update');
    Route::delete('/solutions/{id}', [App\Http\Controllers\SolarController::class, 'deleteSolution'])->name('solutions.delete');

    Route::get('/surveys', [App\Http\Controllers\SolarController::class, 'surveys']);
    Route::post('/surveys', [App\Http\Controllers\SolarController::class, 'storeSurvey'])->name('surveys.store');
    Route::post('/surveys/{id}/status', [App\Http\Controllers\SolarController::class, 'updateSurveyStatus'])->name('surveys.status');
    Route::delete('/surveys/{id}', [App\Http\Controllers\SolarController::class, 'deleteSurvey'])->name('surveys.delete');

    Route::get('/projects', [App\Http\Controllers\SolarController::class, 'projects']);
    Route::post('/projects', [App\Http\Controllers\SolarController::class, 'storeProject'])->name('projects.store');
    Route::post('/projects/{id}/status', [App\Http\Controllers\SolarController::class, 'updateProjectStatus'])->name('projects.status');
    Route::delete('/projects/{id}', [App\Http\Controllers\SolarController::class, 'deleteProject'])->name('projects.delete');

    Route::get('/subsidies', [App\Http\Controllers\SolarController::class, 'subsidies']);
    Route::post('/subsidies', [App\Http\Controllers\SolarController::class, 'storeSubsidy'])->name('subsidies.store');
    Route::post('/subsidies/{id}/status', [App\Http\Controllers\SolarController::class, 'updateSubsidyStatus'])->name('subsidies.status');
    Route::delete('/subsidies/{id}', [App\Http\Controllers\SolarController::class, 'deleteSubsidy'])->name('subsidies.delete');

    Route::get('/monitoring', [App\Http\Controllers\SolarController::class, 'monitoring']);
    Route::post('/monitoring', [App\Http\Controllers\SolarController::class, 'storeMonitoring'])->name('monitoring.store');
    Route::delete('/monitoring/{id}', [App\Http\Controllers\SolarController::class, 'deleteMonitoring'])->name('monitoring.delete');

    Route::get('/amc', [App\Http\Controllers\SolarController::class, 'amc']);
    Route::post('/amc', [App\Http\Controllers\SolarController::class, 'storeAmc'])->name('amc.store');
    Route::delete('/amc/{id}', [App\Http\Controllers\SolarController::class, 'deleteAmc'])->name('amc.delete');
});

Route::middleware(['auth:customer'])->prefix('user/influencer')->name('influencer.')->group(function () {
    Route::get('/stats', [App\Http\Controllers\InfluencerController::class, 'stats']);
    Route::post('/stats', [App\Http\Controllers\InfluencerController::class, 'storeStat'])->name('stats.store');
    Route::put('/stats/{id}', [App\Http\Controllers\InfluencerController::class, 'updateStat'])->name('stats.update');
    Route::delete('/stats/{id}', [App\Http\Controllers\InfluencerController::class, 'deleteStat'])->name('stats.delete');

    Route::get('/collaborations', [App\Http\Controllers\InfluencerController::class, 'collaborations']);
    Route::post('/collaborations', [App\Http\Controllers\InfluencerController::class, 'storeCollaboration'])->name('collaborations.store');
    Route::put('/collaborations/{id}', [App\Http\Controllers\InfluencerController::class, 'updateCollaboration'])->name('collaborations.update');
    Route::delete('/collaborations/{id}', [App\Http\Controllers\InfluencerController::class, 'deleteCollaboration'])->name('collaborations.delete');

    Route::get('/portfolio', [App\Http\Controllers\InfluencerController::class, 'portfolio']);
    Route::post('/portfolio', [App\Http\Controllers\InfluencerController::class, 'storePortfolio'])->name('portfolio.store');
    Route::put('/portfolio/{id}', [App\Http\Controllers\InfluencerController::class, 'updatePortfolio'])->name('portfolio.update');
    Route::delete('/portfolio/{id}', [App\Http\Controllers\InfluencerController::class, 'deletePortfolio'])->name('portfolio.delete');
});

Route::get('{slug}/design-consultation', [App\Http\Controllers\InteriorController::class, 'consultationForm'])->name('interior.consultation.form');
Route::post('{slug}/design-consultation', [App\Http\Controllers\InteriorController::class, 'storePublicConsultation'])->name('interior.consultation.store');
Route::get('{slug}/design-consultation/thanks/{consultationId}', [App\Http\Controllers\InteriorController::class, 'consultationThanks'])->name('interior.consultation.thanks');

Route::get('{slug}/admission', [App\Http\Controllers\EducationController::class, 'admissionForm'])->name('education.admission.form');
Route::post('{slug}/admission', [App\Http\Controllers\EducationController::class, 'storePublicAdmission'])->name('education.admission.store');
Route::get('{slug}/admission/thanks/{admissionId}', [App\Http\Controllers\EducationController::class, 'admissionThanks'])->name('education.admission.thanks');

Route::get('{slug}/ca-consultation', [App\Http\Controllers\CaController::class, 'consultationForm'])->name('ca.consultation.form');
Route::post('{slug}/ca-consultation', [App\Http\Controllers\CaController::class, 'storePublicConsultation'])->name('ca.consultation.store');
Route::get('{slug}/ca-consultation/thanks/{consultationId}', [App\Http\Controllers\CaController::class, 'consultationThanks'])->name('ca.consultation.thanks');

Route::get('{slug}/astro-consultation', [App\Http\Controllers\AstrologerController::class, 'consultationForm'])->name('astro.consultation.form');
Route::post('{slug}/astro-consultation', [App\Http\Controllers\AstrologerController::class, 'storePublicConsultation'])->name('astro.consultation.store');
Route::get('{slug}/astro-consultation/thanks/{consultationId}', [App\Http\Controllers\AstrologerController::class, 'consultationThanks'])->name('astro.consultation.thanks');

Route::get('{slug}/security-survey', [App\Http\Controllers\SecurityController::class, 'surveyForm'])->name('security.survey.form');
Route::post('{slug}/security-survey', [App\Http\Controllers\SecurityController::class, 'storePublicSurvey'])->name('security.survey.store');
Route::get('{slug}/security-survey/thanks/{surveyId}', [App\Http\Controllers\SecurityController::class, 'surveyThanks'])->name('security.survey.thanks');

Route::get('{slug}/solar-survey', [App\Http\Controllers\SolarController::class, 'surveyForm'])->name('solar.survey.form');
Route::post('{slug}/solar-survey', [App\Http\Controllers\SolarController::class, 'storePublicSurvey'])->name('solar.survey.store');
Route::get('{slug}/solar-survey/thanks/{surveyId}', [App\Http\Controllers\SolarController::class, 'surveyThanks'])->name('solar.survey.thanks');

Route::get('{slug}/brand-collaboration', [App\Http\Controllers\InfluencerController::class, 'collaborationForm'])->name('influencer.collaboration.form');
Route::post('{slug}/brand-collaboration', [App\Http\Controllers\InfluencerController::class, 'storePublicCollaboration'])->name('influencer.collaboration.store');
Route::get('{slug}/brand-collaboration/thanks/{collaborationId}', [App\Http\Controllers\InfluencerController::class, 'collaborationThanks'])->name('influencer.collaboration.thanks');

Route::get('{slug}/grievance', [App\Http\Controllers\PoliticalController::class, 'grievanceForm'])->name('political.grievance.form');
Route::post('{slug}/grievance', [App\Http\Controllers\PoliticalController::class, 'storePublicGrievance'])->name('political.grievance.store');
Route::get('{slug}/grievance/thanks/{grievanceId}', [App\Http\Controllers\PoliticalController::class, 'grievanceThanks'])->name('political.grievance.thanks');

// ============================================
// MEDICAL FEATURES ROUTES (Phase 5)
// ============================================

// Medical User Dashboard Routes (Authenticated)
Route::middleware(['auth:customer'])->prefix('user/medical')->name('user.medical.')->group(function () {
    // Profile Management
    Route::get('/profiles', [App\Http\Controllers\MedicalController::class, 'profileSettings'])->name('profiles');
    Route::post('/profile/save', [App\Http\Controllers\MedicalController::class, 'saveProfile'])->name('profile.save');
    Route::delete('/profile/{id}', [App\Http\Controllers\MedicalController::class, 'deleteProfile'])->name('profile.delete');

    // Appointments Management
    Route::get('/appointments', [App\Http\Controllers\MedicalController::class, 'appointments'])->name('appointments');
    Route::post('/appointment/{id}/status', [App\Http\Controllers\MedicalController::class, 'updateAppointmentStatus'])->name('appointment.updateStatus');

    // Payments Management
    Route::get('/payments', [App\Http\Controllers\MedicalController::class, 'payments'])->name('payments');
    Route::get('/payment/{id}/receipt', [App\Http\Controllers\MedicalController::class, 'downloadReceipt'])->name('receipt.download');
    Route::get('/payment-settings', [App\Http\Controllers\MedicalController::class, 'paymentSettings'])->name('payment.settings');
    Route::post('/payment-settings/save', [App\Http\Controllers\MedicalController::class, 'savePaymentSettings'])->name('payment.settings.save');

    // Reviews Management
    Route::get('/reviews', [App\Http\Controllers\MedicalController::class, 'reviews'])->name('reviews');
    Route::post('/review/{id}/approve', [App\Http\Controllers\MedicalController::class, 'approveReview'])->name('review.approve');
    Route::post('/review/{id}/reject', [App\Http\Controllers\MedicalController::class, 'rejectReview'])->name('review.reject');
    Route::post('/review/{id}/toggle-featured', [App\Http\Controllers\MedicalController::class, 'toggleFeaturedReview'])->name('review.toggleFeatured');
    Route::delete('/review/{id}', [App\Http\Controllers\MedicalController::class, 'deleteReview'])->name('review.delete');
});

// Medical Frontend Routes (Public)
Route::prefix('{slug}/medical')->name('medical.')->group(function () {
    // Profile selector and viewing
    Route::get('/', [App\Http\Controllers\MedicalController::class, 'showProfileSelector'])->name('selector');
    Route::get('/{profileType}', [App\Http\Controllers\MedicalController::class, 'showProfile'])->name('profile.show')->where('profileType', 'doctor|hospital|daycare');

    // Appointment booking (public)
    Route::get('/book-appointment', [App\Http\Controllers\MedicalController::class, 'showAppointmentForm'])->name('appointment.form');
    Route::post('/book-appointment', [App\Http\Controllers\MedicalController::class, 'storeAppointment'])->name('appointment.store');

    // Payment (public)
    Route::get('/payment/{appointmentId?}', [App\Http\Controllers\MedicalController::class, 'showPaymentForm'])->name('payment.form');
    Route::post('/payment/process', [App\Http\Controllers\MedicalController::class, 'processPayment'])->name('payment.process');

    // Reviews (public)
    Route::get('/reviews', [App\Http\Controllers\MedicalController::class, 'showReviews'])->name('reviews');
    Route::post('/review/submit', [App\Http\Controllers\MedicalController::class, 'storeReview'])->name('review.store');
});

// ============================================
// CREATIVE (PHOTOGRAPHER/EVENT) ROUTES (Phase 7)
// ============================================

// Frontend Creative Routes (Public - Booking Form)
Route::prefix('{slug}/creative')->name('creative.')->group(function () {
    Route::get('/book', [App\Http\Controllers\CreativeBookingController::class, 'showBookingForm'])->name('booking.form');
    Route::post('/book', [App\Http\Controllers\CreativeBookingController::class, 'store'])->name('booking.store');
});

// Creative User Dashboard Routes (Authenticated)
Route::middleware(['auth:customer'])->prefix('user/creative')->name('user.creative.')->group(function () {
    // Package Management
    Route::resource('packages', App\Http\Controllers\CreativePackageController::class);
    Route::post('/packages/{id}/toggle-status', [App\Http\Controllers\CreativePackageController::class, 'toggleStatus'])->name('packages.toggleStatus');

    // Booking Management
    Route::get('/bookings', [App\Http\Controllers\CreativeBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{id}', [App\Http\Controllers\CreativeBookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{id}/status', [App\Http\Controllers\CreativeBookingController::class, 'updateStatus'])->name('bookings.updateStatus');
    Route::post('/bookings/{id}/payment', [App\Http\Controllers\CreativeBookingController::class, 'updatePaymentStatus'])->name('bookings.updatePayment');
    Route::post('/bookings/{id}/notes', [App\Http\Controllers\CreativeBookingController::class, 'addNotes'])->name('bookings.addNotes');

    // Portfolio Category Management
    Route::resource('portfolio', App\Http\Controllers\CreativePortfolioController::class);
    Route::post('/portfolio/{id}/toggle-status', [App\Http\Controllers\CreativePortfolioController::class, 'toggleStatus'])->name('portfolio.toggleStatus');
});

// ============================================

// REAL ESTATE ROUTES (Phase 8)
// ============================================

// Frontend Real Estate Routes (Public - Site Visit Booking)
Route::post('/property/{id}/book-visit', [App\Http\Controllers\RealEstateController::class, 'bookSiteVisit'])->name('real-estate.book-visit');

// Real Estate User Dashboard Routes (Authenticated)
Route::middleware(['auth:customer'])->prefix('user/real-estate')->name('real-estate.')->group(function () {
    // Profile Management
    Route::get('/profiles', [App\Http\Controllers\RealEstateController::class, 'profiles'])->name('profiles.index');
    Route::match(['POST', 'PUT'], '/profiles', [App\Http\Controllers\RealEstateController::class, 'storeProfiles'])->name('profiles.update');

    // Property Management
    Route::get('/properties', [App\Http\Controllers\RealEstateController::class, 'properties'])->name('properties.index');
    Route::get('/properties/create', [App\Http\Controllers\RealEstateController::class, 'createProperty'])->name('properties.create');
    Route::post('/properties', [App\Http\Controllers\RealEstateController::class, 'storeProperty'])->name('properties.store');
    Route::get('/properties/{id}/edit', [App\Http\Controllers\RealEstateController::class, 'editProperty'])->name('properties.edit');
    Route::put('/properties/{id}', [App\Http\Controllers\RealEstateController::class, 'updateProperty'])->name('properties.update');
    Route::delete('/properties/{id}', [App\Http\Controllers\RealEstateController::class, 'destroyProperty'])->name('properties.destroy');
    Route::post('/properties/{id}/toggle-status', [App\Http\Controllers\RealEstateController::class, 'togglePropertyStatus'])->name('properties.toggle-status');

    // Site Visit Management
    Route::get('/site-visits', [App\Http\Controllers\RealEstateController::class, 'siteVisits'])->name('site-visits.index');
    Route::get('/site-visits/{id}', [App\Http\Controllers\RealEstateController::class, 'showVisit'])->name('site-visits.show');
    Route::match(['POST', 'PATCH'], '/site-visits/{id}/status', [App\Http\Controllers\RealEstateController::class, 'updateVisitStatus'])->name('site-visits.update-status');
    Route::match(['POST', 'PATCH'], '/site-visits/{id}/notes', [App\Http\Controllers\RealEstateController::class, 'addVisitNotes'])->name('site-visits.add-notes');

    // Location Tracking
    Route::get('/location-tracking', [App\Http\Controllers\RealEstateController::class, 'locationTracking'])->name('location-tracking.index');
});

// ============================================

// TALENT (ACTOR/MODEL) ROUTES (Phase 9)
// ============================================

// Frontend Talent Routes (Public - Booking Form)
Route::get('/{customerId}/talent/{talentType}/book', [App\Http\Controllers\TalentController::class, 'showBookingForm'])->name('talent.booking.form');
Route::post('/talent/book', [App\Http\Controllers\TalentController::class, 'storeBooking'])->name('talent.booking.store');

// Talent User Dashboard Routes (Authenticated)
Route::middleware(['auth:customer'])->prefix('user/talent')->name('talent.')->group(function () {
    // Profile Management
    Route::get('/profiles', [App\Http\Controllers\TalentController::class, 'manageProfiles'])->name('profiles.index');
    Route::put('/profiles', [App\Http\Controllers\TalentController::class, 'updateProfiles'])->name('profiles.update');
    Route::post('/profiles/toggle', [App\Http\Controllers\TalentController::class, 'toggleProfile'])->name('profiles.toggle');
    Route::post('/profiles/set-default', [App\Http\Controllers\TalentController::class, 'setDefaultProfile'])->name('profiles.set-default');

    // Portfolio Management
    Route::get('/portfolio', [App\Http\Controllers\TalentController::class, 'portfolio'])->name('portfolio.index');
    Route::get('/portfolio/create', [App\Http\Controllers\TalentController::class, 'createPortfolio'])->name('portfolio.create');
    Route::post('/portfolio', [App\Http\Controllers\TalentController::class, 'storePortfolio'])->name('portfolio.store');
    Route::get('/portfolio/{id}/edit', [App\Http\Controllers\TalentController::class, 'editPortfolio'])->name('portfolio.edit');
    Route::put('/portfolio/{id}', [App\Http\Controllers\TalentController::class, 'updatePortfolio'])->name('portfolio.update');
    Route::delete('/portfolio/{id}', [App\Http\Controllers\TalentController::class, 'destroyPortfolio'])->name('portfolio.destroy');
    Route::post('/portfolio/{id}/toggle-status', [App\Http\Controllers\TalentController::class, 'togglePortfolioStatus'])->name('portfolio.toggle-status');

    // Booking Management
    Route::get('/bookings', [App\Http\Controllers\TalentController::class, 'bookings'])->name('bookings.index');
    Route::get('/bookings/{id}', [App\Http\Controllers\TalentController::class, 'showBooking'])->name('bookings.show');
    Route::post('/bookings/{id}/status', [App\Http\Controllers\TalentController::class, 'updateBookingStatus'])->name('bookings.update-status');
    Route::post('/bookings/{id}/payment', [App\Http\Controllers\TalentController::class, 'updatePaymentStatus'])->name('bookings.update-payment');
    Route::post('/bookings/{id}/notes', [App\Http\Controllers\TalentController::class, 'addBookingNotes'])->name('bookings.add-notes');

    // Social Stats Management
    Route::get('/social-stats', [App\Http\Controllers\TalentController::class, 'socialStats'])->name('social-stats.index');
    Route::post('/social-stats', [App\Http\Controllers\TalentController::class, 'storeSocialStat'])->name('social-stats.store');
    Route::delete('/social-stats/{id}', [App\Http\Controllers\TalentController::class, 'destroySocialStat'])->name('social-stats.destroy');
});

// ============================================
// RESTAURANT ADVANCED ROUTES (Phase 11)
// ============================================

// Restaurant User Dashboard Routes (Authenticated)
    Route::middleware(['auth:customer'])->prefix('user/restaurant')->name('user.restaurant.')->group(function () {
    Route::get('/profiles', [App\Http\Controllers\RestaurantAdvancedController::class, 'profiles'])->name('profiles.index');
    Route::post('/profiles', [App\Http\Controllers\RestaurantAdvancedController::class, 'storeProfile'])->name('profiles.store');
    Route::put('/profiles/{id}', [App\Http\Controllers\RestaurantAdvancedController::class, 'updateProfile'])->name('profiles.update');
    Route::post('/profiles/{id}/default', [App\Http\Controllers\RestaurantAdvancedController::class, 'setDefaultProfile'])->name('profiles.default');
    Route::delete('/profiles/{id}', [App\Http\Controllers\RestaurantAdvancedController::class, 'deleteProfile'])->name('profiles.delete');

    Route::get('/tables', [App\Http\Controllers\RestaurantAdvancedController::class, 'tables'])->name('tables.index');
    Route::post('/tables', [App\Http\Controllers\RestaurantAdvancedController::class, 'storeTable'])->name('tables.store');
    Route::put('/tables/{id}', [App\Http\Controllers\RestaurantAdvancedController::class, 'updateTable'])->name('tables.update');
    Route::post('/tables/{id}/qr', [App\Http\Controllers\RestaurantAdvancedController::class, 'regenerateTableQr'])->name('tables.qr');
    Route::delete('/tables/{id}', [App\Http\Controllers\RestaurantAdvancedController::class, 'deleteTable'])->name('tables.delete');

    Route::get('/rooms', [App\Http\Controllers\RestaurantAdvancedController::class, 'rooms'])->name('rooms.index');
    Route::post('/rooms', [App\Http\Controllers\RestaurantAdvancedController::class, 'storeRoom'])->name('rooms.store');
    Route::put('/rooms/{id}', [App\Http\Controllers\RestaurantAdvancedController::class, 'updateRoom'])->name('rooms.update');
    Route::post('/rooms/{id}/qr', [App\Http\Controllers\RestaurantAdvancedController::class, 'regenerateRoomQr'])->name('rooms.qr');
    Route::delete('/rooms/{id}', [App\Http\Controllers\RestaurantAdvancedController::class, 'deleteRoom'])->name('rooms.delete');

    Route::get('/orders', [App\Http\Controllers\RestaurantAdvancedController::class, 'orders'])->name('orders.index');
    Route::post('/orders/table/{id}/status', [App\Http\Controllers\RestaurantAdvancedController::class, 'updateTableOrderStatus'])->name('orders.table.status');
    Route::post('/orders/room/{id}/status', [App\Http\Controllers\RestaurantAdvancedController::class, 'updateRoomOrderStatus'])->name('orders.room.status');

    Route::get('/events', [App\Http\Controllers\RestaurantAdvancedController::class, 'events'])->name('events.index');
    Route::post('/events/{id}/status', [App\Http\Controllers\RestaurantAdvancedController::class, 'updateEventStatus'])->name('events.status');

    Route::get('/banquets', [App\Http\Controllers\RestaurantAdvancedController::class, 'banquets'])->name('banquets.index');
    Route::get('/banquets/create', [App\Http\Controllers\RestaurantAdvancedController::class, 'createBanquet'])->name('banquets.create');
    Route::post('/banquets', [App\Http\Controllers\RestaurantAdvancedController::class, 'storeBanquet'])->name('banquets.store');
    Route::get('/banquets/{id}/edit', [App\Http\Controllers\RestaurantAdvancedController::class, 'editBanquet'])->name('banquets.edit');
    Route::put('/banquets/{id}', [App\Http\Controllers\RestaurantAdvancedController::class, 'updateBanquet'])->name('banquets.update');
    Route::delete('/banquets/{id}', [App\Http\Controllers\RestaurantAdvancedController::class, 'deleteBanquet'])->name('banquets.delete');

    Route::get('/payments', [App\Http\Controllers\RestaurantAdvancedController::class, 'payments'])->name('payments.index');
    Route::get('/kitchen', [App\Http\Controllers\RestaurantAdvancedController::class, 'kitchen'])->name('kitchen.index');
    Route::get('/analytics', [App\Http\Controllers\RestaurantAdvancedController::class, 'analytics'])->name('analytics.index');
});

// Restaurant Frontend Routes (Public)
Route::get('{slug}/table-order', [App\Http\Controllers\RestaurantAdvancedController::class, 'tableOrderForm'])->name('restaurant.table.form');
Route::post('{slug}/table-order', [App\Http\Controllers\RestaurantAdvancedController::class, 'storeTableOrder'])->name('restaurant.table.store');
Route::get('{slug}/table-order/thanks/{orderId}', [App\Http\Controllers\RestaurantAdvancedController::class, 'orderThanks'])->name('restaurant.table.thanks');

Route::get('{slug}/room-service', [App\Http\Controllers\RestaurantAdvancedController::class, 'roomServiceForm'])->name('restaurant.room.form');
Route::post('{slug}/room-service', [App\Http\Controllers\RestaurantAdvancedController::class, 'storeRoomService'])->name('restaurant.room.store');
Route::get('{slug}/room-service/thanks/{orderId}', [App\Http\Controllers\RestaurantAdvancedController::class, 'roomThanks'])->name('restaurant.room.thanks');

Route::get('{slug}/event-booking', [App\Http\Controllers\RestaurantAdvancedController::class, 'eventBookingForm'])->name('restaurant.event.form');
Route::post('{slug}/event-booking', [App\Http\Controllers\RestaurantAdvancedController::class, 'storeEventBooking'])->name('restaurant.event.store');
Route::get('{slug}/event-booking/thanks', [App\Http\Controllers\RestaurantAdvancedController::class, 'eventThanks'])->name('restaurant.event.thanks');

// ============================================
// PRODUCTION HOUSE ADVANCED ROUTES (Phase 12)
// ============================================

// Production User Dashboard Routes (Authenticated)
Route::middleware(['auth:customer'])->prefix('user/production')->name('production.')->group(function () {
    Route::get('/services', [App\Http\Controllers\ProductionController::class, 'services'])->name('services.index');
    Route::post('/services', [App\Http\Controllers\ProductionController::class, 'storeService'])->name('services.store');
    Route::put('/services/{id}', [App\Http\Controllers\ProductionController::class, 'updateService'])->name('services.update');
    Route::delete('/services/{id}', [App\Http\Controllers\ProductionController::class, 'deleteService'])->name('services.delete');

    Route::get('/projects', [App\Http\Controllers\ProductionController::class, 'projects'])->name('projects.index');
    Route::post('/projects', [App\Http\Controllers\ProductionController::class, 'storeProject'])->name('projects.store');
    Route::post('/projects/{id}/status', [App\Http\Controllers\ProductionController::class, 'updateProjectStatus'])->name('projects.status');
    Route::delete('/projects/{id}', [App\Http\Controllers\ProductionController::class, 'deleteProject'])->name('projects.delete');

    Route::get('/portfolios', [App\Http\Controllers\ProductionController::class, 'portfolios'])->name('portfolios.index');
    Route::post('/portfolios', [App\Http\Controllers\ProductionController::class, 'storePortfolio'])->name('portfolios.store');
    Route::delete('/portfolios/{id}', [App\Http\Controllers\ProductionController::class, 'deletePortfolio'])->name('portfolios.delete');

    Route::get('/team', [App\Http\Controllers\ProductionController::class, 'team'])->name('team.index');
    Route::post('/team', [App\Http\Controllers\ProductionController::class, 'storeTeam'])->name('team.store');
    Route::put('/team/{id}', [App\Http\Controllers\ProductionController::class, 'updateTeam'])->name('team.update');
    Route::delete('/team/{id}', [App\Http\Controllers\ProductionController::class, 'deleteTeam'])->name('team.delete');

    Route::get('/payments', [App\Http\Controllers\ProductionController::class, 'payments'])->name('payments.index');
    Route::post('/payments', [App\Http\Controllers\ProductionController::class, 'storePayment'])->name('payments.store');
});

// Production Frontend Routes (Public)
Route::get('{slug}/production-booking', [App\Http\Controllers\ProductionController::class, 'bookingForm'])->name('production.booking.form');
Route::post('{slug}/production-booking', [App\Http\Controllers\ProductionController::class, 'storeBooking'])->name('production.booking.store');
Route::get('{slug}/production-booking/thanks/{projectId}', [App\Http\Controllers\ProductionController::class, 'bookingThanks'])->name('production.booking.thanks');

// ============================================
// JEWELLERY ADVANCED ROUTES (Phase 13)
// ============================================

// Jewellery User Dashboard Routes (Authenticated)
Route::middleware(['auth:customer'])->prefix('user/jewellery')->name('jewellery.')->group(function () {
    Route::get('/products', [App\Http\Controllers\JewelleryController::class, 'products'])->name('products.index');
    Route::post('/products', [App\Http\Controllers\JewelleryController::class, 'storeProduct'])->name('products.store');
    Route::put('/products/{id}', [App\Http\Controllers\JewelleryController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{id}', [App\Http\Controllers\JewelleryController::class, 'deleteProduct'])->name('products.delete');

    Route::get('/rates', [App\Http\Controllers\JewelleryController::class, 'rates'])->name('rates.index');
    Route::post('/rates', [App\Http\Controllers\JewelleryController::class, 'storeRate'])->name('rates.store');
    Route::put('/rates/{id}', [App\Http\Controllers\JewelleryController::class, 'updateRate'])->name('rates.update');
    Route::delete('/rates/{id}', [App\Http\Controllers\JewelleryController::class, 'deleteRate'])->name('rates.delete');

    Route::get('/orders', [App\Http\Controllers\JewelleryController::class, 'orders'])->name('orders.index');
    Route::post('/orders', [App\Http\Controllers\JewelleryController::class, 'storeOrder'])->name('orders.store');
    Route::post('/orders/{id}/status', [App\Http\Controllers\JewelleryController::class, 'updateOrderStatus'])->name('orders.status');
    Route::delete('/orders/{id}', [App\Http\Controllers\JewelleryController::class, 'deleteOrder'])->name('orders.delete');
});

// Jewellery Frontend Routes (Public)
Route::get('{slug}/jewellery-order', [App\Http\Controllers\JewelleryController::class, 'orderForm'])->name('jewellery.order.form');
Route::post('{slug}/jewellery-order', [App\Http\Controllers\JewelleryController::class, 'storePublicOrder'])->name('jewellery.order.store');
Route::get('{slug}/jewellery-order/thanks/{orderId}', [App\Http\Controllers\JewelleryController::class, 'orderThanks'])->name('jewellery.order.thanks');

// ============================================
// TECHNOLOGY ADVANCED ROUTES (Phase 14)
// ============================================

// Technology User Dashboard Routes (Authenticated)
Route::middleware(['auth:customer'])->prefix('user/tech')->name('tech.')->group(function () {
    Route::get('/services', [App\Http\Controllers\TechController::class, 'services'])->name('services.index');
    Route::post('/services', [App\Http\Controllers\TechController::class, 'storeService'])->name('services.store');
    Route::put('/services/{id}', [App\Http\Controllers\TechController::class, 'updateService'])->name('services.update');
    Route::delete('/services/{id}', [App\Http\Controllers\TechController::class, 'deleteService'])->name('services.delete');

    Route::get('/projects', [App\Http\Controllers\TechController::class, 'projects'])->name('projects.index');
    Route::post('/projects', [App\Http\Controllers\TechController::class, 'storeProject'])->name('projects.store');
    Route::post('/projects/{id}/status', [App\Http\Controllers\TechController::class, 'updateProjectStatus'])->name('projects.status');
    Route::delete('/projects/{id}', [App\Http\Controllers\TechController::class, 'deleteProject'])->name('projects.delete');

    Route::get('/case-studies', [App\Http\Controllers\TechController::class, 'caseStudies'])->name('case-studies.index');
    Route::post('/case-studies', [App\Http\Controllers\TechController::class, 'storeCaseStudy'])->name('case-studies.store');
    Route::delete('/case-studies/{id}', [App\Http\Controllers\TechController::class, 'deleteCaseStudy'])->name('case-studies.delete');
});

// Technology Frontend Routes (Public)
Route::get('{slug}/tech-inquiry', [App\Http\Controllers\TechController::class, 'inquiryForm'])->name('tech.inquiry.form');
Route::post('{slug}/tech-inquiry', [App\Http\Controllers\TechController::class, 'storeInquiry'])->name('tech.inquiry.store');
Route::get('{slug}/tech-inquiry/thanks/{projectId}', [App\Http\Controllers\TechController::class, 'inquiryThanks'])->name('tech.inquiry.thanks');

// ============================================
// TOUR ADVANCED ROUTES (Phase 15)
// ============================================

// Tour User Dashboard Routes (Authenticated)
Route::middleware(['auth:customer'])->prefix('user/tour')->name('tour.')->group(function () {
    Route::get('/packages', [App\Http\Controllers\TourController::class, 'packages'])->name('packages.index');
    Route::post('/packages', [App\Http\Controllers\TourController::class, 'storePackage'])->name('packages.store');
    Route::put('/packages/{id}', [App\Http\Controllers\TourController::class, 'updatePackage'])->name('packages.update');
    Route::delete('/packages/{id}', [App\Http\Controllers\TourController::class, 'deletePackage'])->name('packages.delete');

    Route::get('/bookings', [App\Http\Controllers\TourController::class, 'bookings'])->name('bookings.index');
    Route::post('/bookings', [App\Http\Controllers\TourController::class, 'storeBooking'])->name('bookings.store');
    Route::post('/bookings/{id}/status', [App\Http\Controllers\TourController::class, 'updateBookingStatus'])->name('bookings.status');
    Route::delete('/bookings/{id}', [App\Http\Controllers\TourController::class, 'deleteBooking'])->name('bookings.delete');
});

// Tour Frontend Routes (Public)
Route::get('{slug}/tour-booking', [App\Http\Controllers\TourController::class, 'bookingForm'])->name('tour.booking.form');
Route::post('{slug}/tour-booking', [App\Http\Controllers\TourController::class, 'storePublicBooking'])->name('tour.booking.store');
Route::get('{slug}/tour-booking/thanks/{bookingId}', [App\Http\Controllers\TourController::class, 'bookingThanks'])->name('tour.booking.thanks');

// ============================================
// FITNESS ADVANCED ROUTES (Phase 16)
// ============================================

// Fitness User Dashboard Routes (Authenticated)
Route::middleware(['auth:customer'])->prefix('user/fitness')->name('fitness.')->group(function () {
    Route::get('/programs', [App\Http\Controllers\FitnessController::class, 'programs'])->name('programs.index');
    Route::post('/programs', [App\Http\Controllers\FitnessController::class, 'storeProgram'])->name('programs.store');
    Route::put('/programs/{id}', [App\Http\Controllers\FitnessController::class, 'updateProgram'])->name('programs.update');
    Route::delete('/programs/{id}', [App\Http\Controllers\FitnessController::class, 'deleteProgram'])->name('programs.delete');

    Route::get('/trainers', [App\Http\Controllers\FitnessController::class, 'trainers'])->name('trainers.index');
    Route::post('/trainers', [App\Http\Controllers\FitnessController::class, 'storeTrainer'])->name('trainers.store');
    Route::put('/trainers/{id}', [App\Http\Controllers\FitnessController::class, 'updateTrainer'])->name('trainers.update');
    Route::delete('/trainers/{id}', [App\Http\Controllers\FitnessController::class, 'deleteTrainer'])->name('trainers.delete');

    Route::get('/memberships', [App\Http\Controllers\FitnessController::class, 'memberships'])->name('memberships.index');
    Route::post('/memberships', [App\Http\Controllers\FitnessController::class, 'storeMembership'])->name('memberships.store');
    Route::put('/memberships/{id}', [App\Http\Controllers\FitnessController::class, 'updateMembership'])->name('memberships.update');
    Route::delete('/memberships/{id}', [App\Http\Controllers\FitnessController::class, 'deleteMembership'])->name('memberships.delete');

    Route::get('/subscriptions', [App\Http\Controllers\FitnessController::class, 'subscriptions'])->name('subscriptions.index');
    Route::post('/subscriptions', [App\Http\Controllers\FitnessController::class, 'storeSubscription'])->name('subscriptions.store');
    Route::put('/subscriptions/{id}', [App\Http\Controllers\FitnessController::class, 'updateSubscription'])->name('subscriptions.update');
    Route::delete('/subscriptions/{id}', [App\Http\Controllers\FitnessController::class, 'deleteSubscription'])->name('subscriptions.delete');

    Route::get('/classes', [App\Http\Controllers\FitnessController::class, 'classes'])->name('classes.index');
    Route::post('/classes', [App\Http\Controllers\FitnessController::class, 'storeClass'])->name('classes.store');
    Route::put('/classes/{id}', [App\Http\Controllers\FitnessController::class, 'updateClass'])->name('classes.update');
    Route::delete('/classes/{id}', [App\Http\Controllers\FitnessController::class, 'deleteClass'])->name('classes.delete');

    Route::get('/bookings', [App\Http\Controllers\FitnessController::class, 'bookings'])->name('bookings.index');
    Route::post('/bookings', [App\Http\Controllers\FitnessController::class, 'storeBooking'])->name('bookings.store');
    Route::post('/bookings/{id}/status', [App\Http\Controllers\FitnessController::class, 'updateBookingStatus'])->name('bookings.status');
    Route::delete('/bookings/{id}', [App\Http\Controllers\FitnessController::class, 'deleteBooking'])->name('bookings.delete');

    Route::get('/progress', [App\Http\Controllers\FitnessController::class, 'progress'])->name('progress.index');
    Route::post('/progress', [App\Http\Controllers\FitnessController::class, 'storeProgress'])->name('progress.store');
    Route::delete('/progress/{id}', [App\Http\Controllers\FitnessController::class, 'deleteProgress'])->name('progress.delete');

    Route::get('/transformations', [App\Http\Controllers\FitnessController::class, 'transformations'])->name('transformations.index');
    Route::post('/transformations', [App\Http\Controllers\FitnessController::class, 'storeTransformation'])->name('transformations.store');
    Route::put('/transformations/{id}', [App\Http\Controllers\FitnessController::class, 'updateTransformation'])->name('transformations.update');
    Route::delete('/transformations/{id}', [App\Http\Controllers\FitnessController::class, 'deleteTransformation'])->name('transformations.delete');

    Route::get('/diet-plans', [App\Http\Controllers\FitnessController::class, 'dietPlans'])->name('diet-plans.index');
    Route::post('/diet-plans', [App\Http\Controllers\FitnessController::class, 'storeDietPlan'])->name('diet-plans.store');
    Route::put('/diet-plans/{id}', [App\Http\Controllers\FitnessController::class, 'updateDietPlan'])->name('diet-plans.update');
    Route::delete('/diet-plans/{id}', [App\Http\Controllers\FitnessController::class, 'deleteDietPlan'])->name('diet-plans.delete');
});

// Fitness Frontend Routes (Public)
Route::get('{slug}/fitness-booking', [App\Http\Controllers\FitnessController::class, 'bookingForm'])->name('fitness.booking.form');
Route::post('{slug}/fitness-booking', [App\Http\Controllers\FitnessController::class, 'storePublicBooking'])->name('fitness.booking.store');
Route::get('{slug}/fitness-booking/thanks/{bookingId}', [App\Http\Controllers\FitnessController::class, 'bookingThanks'])->name('fitness.booking.thanks');

// ============================================
// LAWYER ADVANCED ROUTES (Phase 17)
// ============================================

// Lawyer User Dashboard Routes (Authenticated)
Route::middleware(['auth:customer'])->prefix('user/lawyer')->name('lawyer.')->group(function () {
    Route::get('/services', [App\Http\Controllers\LawyerController::class, 'services'])->name('services.index');
    Route::post('/services', [App\Http\Controllers\LawyerController::class, 'storeService'])->name('services.store');
    Route::put('/services/{id}', [App\Http\Controllers\LawyerController::class, 'updateService'])->name('services.update');
    Route::delete('/services/{id}', [App\Http\Controllers\LawyerController::class, 'deleteService'])->name('services.delete');

    Route::get('/cases', [App\Http\Controllers\LawyerController::class, 'cases'])->name('cases.index');
    Route::post('/cases', [App\Http\Controllers\LawyerController::class, 'storeCase'])->name('cases.store');
    Route::post('/cases/{id}/status', [App\Http\Controllers\LawyerController::class, 'updateCaseStatus'])->name('cases.status');
    Route::delete('/cases/{id}', [App\Http\Controllers\LawyerController::class, 'deleteCase'])->name('cases.delete');

    Route::get('/hearings', [App\Http\Controllers\LawyerController::class, 'hearings'])->name('hearings.index');
    Route::post('/hearings', [App\Http\Controllers\LawyerController::class, 'storeHearing'])->name('hearings.store');
    Route::put('/hearings/{id}', [App\Http\Controllers\LawyerController::class, 'updateHearing'])->name('hearings.update');
    Route::delete('/hearings/{id}', [App\Http\Controllers\LawyerController::class, 'deleteHearing'])->name('hearings.delete');

    Route::get('/consultations', [App\Http\Controllers\LawyerController::class, 'consultations'])->name('consultations.index');
    Route::post('/consultations', [App\Http\Controllers\LawyerController::class, 'storeConsultation'])->name('consultations.store');
    Route::post('/consultations/{id}/status', [App\Http\Controllers\LawyerController::class, 'updateConsultationStatus'])->name('consultations.status');
    Route::delete('/consultations/{id}', [App\Http\Controllers\LawyerController::class, 'deleteConsultation'])->name('consultations.delete');
});

// Lawyer Frontend Routes (Public)
Route::get('{slug}/legal-consultation', [App\Http\Controllers\LawyerController::class, 'consultationForm'])->name('lawyer.consultation.form');
Route::post('{slug}/legal-consultation', [App\Http\Controllers\LawyerController::class, 'storePublicConsultation'])->name('lawyer.consultation.store');
Route::get('{slug}/legal-consultation/thanks/{consultationId}', [App\Http\Controllers\LawyerController::class, 'consultationThanks'])->name('lawyer.consultation.thanks');

// ============================================
// SALON ADVANCED ROUTES (Phase 18)
// ============================================

// Salon User Dashboard Routes (Authenticated)
Route::middleware(['auth:customer'])->prefix('user/salon')->name('salon.')->group(function () {
    Route::get('/services', [App\Http\Controllers\SalonController::class, 'services'])->name('services.index');
    Route::post('/services', [App\Http\Controllers\SalonController::class, 'storeService'])->name('services.store');
    Route::put('/services/{id}', [App\Http\Controllers\SalonController::class, 'updateService'])->name('services.update');
    Route::delete('/services/{id}', [App\Http\Controllers\SalonController::class, 'deleteService'])->name('services.delete');

    Route::get('/artists', [App\Http\Controllers\SalonController::class, 'artists'])->name('artists.index');
    Route::post('/artists', [App\Http\Controllers\SalonController::class, 'storeArtist'])->name('artists.store');
    Route::put('/artists/{id}', [App\Http\Controllers\SalonController::class, 'updateArtist'])->name('artists.update');
    Route::delete('/artists/{id}', [App\Http\Controllers\SalonController::class, 'deleteArtist'])->name('artists.delete');

    Route::get('/appointments', [App\Http\Controllers\SalonController::class, 'appointments'])->name('appointments.index');
    Route::post('/appointments', [App\Http\Controllers\SalonController::class, 'storeAppointment'])->name('appointments.store');
    Route::post('/appointments/{id}/status', [App\Http\Controllers\SalonController::class, 'updateAppointmentStatus'])->name('appointments.status');
    Route::delete('/appointments/{id}', [App\Http\Controllers\SalonController::class, 'deleteAppointment'])->name('appointments.delete');

    Route::get('/packages', [App\Http\Controllers\SalonController::class, 'packages'])->name('packages.index');
    Route::post('/packages', [App\Http\Controllers\SalonController::class, 'storePackage'])->name('packages.store');
    Route::put('/packages/{id}', [App\Http\Controllers\SalonController::class, 'updatePackage'])->name('packages.update');
    Route::delete('/packages/{id}', [App\Http\Controllers\SalonController::class, 'deletePackage'])->name('packages.delete');

    Route::get('/portfolio', [App\Http\Controllers\SalonController::class, 'portfolio'])->name('portfolio.index');
    Route::post('/portfolio', [App\Http\Controllers\SalonController::class, 'storePortfolio'])->name('portfolio.store');
    Route::put('/portfolio/{id}', [App\Http\Controllers\SalonController::class, 'updatePortfolio'])->name('portfolio.update');
    Route::delete('/portfolio/{id}', [App\Http\Controllers\SalonController::class, 'deletePortfolio'])->name('portfolio.delete');

    Route::get('/products', [App\Http\Controllers\SalonController::class, 'products'])->name('products.index');
    Route::post('/products', [App\Http\Controllers\SalonController::class, 'storeProduct'])->name('products.store');
    Route::put('/products/{id}', [App\Http\Controllers\SalonController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{id}', [App\Http\Controllers\SalonController::class, 'deleteProduct'])->name('products.delete');
});

// Salon Frontend Routes (Public)
Route::get('{slug}/salon-booking', [App\Http\Controllers\SalonController::class, 'bookingForm'])->name('salon.booking.form');
Route::post('{slug}/salon-booking', [App\Http\Controllers\SalonController::class, 'storePublicAppointment'])->name('salon.booking.store');
Route::get('{slug}/salon-booking/thanks/{appointmentId}', [App\Http\Controllers\SalonController::class, 'bookingThanks'])->name('salon.booking.thanks');

// ============================================

// Catch-all route for slug-based profile URLs (MUST BE LAST)
// This allows URLs like domain.com/john-doe to display user profiles
Route::get('/{slug}', [FrontendController::class, 'profileBySlug'])->where('slug', '[a-z0-9\-]+');
