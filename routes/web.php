<?php


// front 

Route::get('/',"FrontController@index");
Route::get('/front/login',"FrontController@login");
// shop owner
Route::get('/owner/product', "FrontShopOwnerController@product");
Route::get('/owner/product/create', "FrontShopOwnerController@create_product");
Route::get('/owner/shop', "FrontShopOwnerController@shop");
Route::get('/owner/shop/create', "FrontShopOwnerController@create_shop");
Route::get('/owner/shop/edit', "FrontShopOwnerController@edit_shop");
Route::post('/owner/shop/save', "FrontShopOwnerController@save_shop");
Route::post('/owner/shop/update', "FrontShopOwnerController@update_shop");
Route::get('/owner/profile', "FrontShopOwnerController@profile");
Route::get('/owner/profile/edit', "FrontShopOwnerController@edit_profile");
Route::post('/owner/profile/update', "FrontShopOwnerController@update_profile");
Route::get('/owner/logout', "FrontShopOwnerController@logout");
Route::get('/shop-owner/register',"FrontController@register");
Route::post('/owner/register', "FrontShopOwnerController@do_register");
Route::post('/owner/do-login', "FrontShopOwnerController@do_login");
Route::get('/owner/reset-password', "FrontShopOwnerController@reset");
Route::post('/owner/reset-password/update', "FrontShopOwnerController@reset_password");
Route::get('/confirm/{id}', "FrontShopOwnerController@confirm");
Route::view('/test', 'fronts.owners.confirm');
// product
Route::get('/product-list',"FrontController@product_list");
Route::get('/product-single',"FrontController@product_single");
Route::get('/product/best-selling', "FrontProductController@best_selling");
Route::get('/product/{id}',"FrontController@product_detail");
Route::get('/product-listing', "FrontProductController@product_listing");
Route::get('/product-baby', "FrontProductController@baby_listing");
Route::get('/product/category/{id}', "FrontProductController@product_category");
Route::get('/product/baby/{id}', "FrontProductController@baby_category");
Route::get('/cart',"FrontController@cart");
Route::get('/checkout',"FrontController@checkout");
Route::get('/contact',"FrontController@contact");
Route::get('/about',"FrontController@about");
Route::get('/shop-owner/login',"FrontShopOwnerController@login");
Route::get('/shop-owner/register',"FrontShopOwnerController@register");
Route::get('/shop-list/all',"FrontShopOwnerController@index");
Route::get('/shop/detail/{id}',"FrontShopOwnerController@shop_detail");
Route::get('/shop-list/{id}',"FrontShopOwnerController@shop_by_category");
Route::get('/school-list/all',"FrontController@school_all");
Route::get('/school-list/{id}',"FrontController@school_by_category");
Route::get('/school/detail/{id}',"FrontController@school_detail");
Route::get('/scholarship',"FrontController@scholarship");
Route::get('/company-category',"FrontController@company_category");
Route::get('/company-list/{id}',"FrontController@company_list");
Route::get('/company-detail/{id}',"FrontController@company_detail");
Route::get('/event/all',"FrontController@event_all");
Route::get('/event-list/{id}',"FrontController@event_list");
Route::get('/event/detail/{id}',"FrontController@event_detail");

//header('Access-Control-Allow-Headers: X-Requested-With, origin, content-type');

Route::get('/admin', function () {
    return redirect('/login');
});
// management
Route::get('/admin/product-management', "ManagementController@product");
Route::get('/admin/school-management', "ManagementController@school");
Route::get('/admin/customer-management', "ManagementController@customer");
Route::get('/admin/career-management', "ManagementController@career");
Route::get('/admin/company-management', "ManagementController@company");
Route::get('/admin/event-management', "ManagementController@event");

// product category
Route::resource('product-category', "ProductCategoryController");
// user route
Route::get('/user', "UserController@index");
Route::get('/user/profile', "UserController@load_profile");
Route::get('/user/reset-password', "UserController@reset_password");
Route::post('/user/change-password', "UserController@change_password");
Route::get('/user/finish', "UserController@finish_page");
Route::post('/user/update-profile', "UserController@update_profile");
Route::get('/user/delete/{id}', "UserController@delete");
Route::get('/user/create', "UserController@create");
Route::post('/user/save', "UserController@save");
Route::get('/user/edit/{id}', "UserController@edit");
Route::post('/user/update', "UserController@update");
Route::get('/user/update-password/{id}', "UserController@load_password");
Route::post('/user/save-password', "UserController@update_password");

// Slide 
Route::get('/admin/slide', "SlideController@index");
Route::get('/admin/slide/create', "SlideController@create");
Route::post('/admin/slide/save', "SlideController@save");
Route::get('/admin/slide/edit/{id}', "SlideController@edit");
Route::post('/admin/slide/update', "SlideController@update");
Route::get('/admin/slide/delete/{id}', "SlideController@delete");

// company category
Route::get("/admin/company-category", "CompanyCategoryController@index");
Route::get("/admin/company-category/create", "CompanyCategoryController@create");
Route::get("/admin/company-category/edit/{id}", "CompanyCategoryController@edit");
Route::get("/admin/company-category/delete/{id}", "CompanyCategoryController@destroy");
Route::post("/admin/company-category/save", "CompanyCategoryController@store");
Route::post("/admin/company-category/update", "CompanyCategoryController@update");

// event
Route::get("/admin/event", "EventController@index");
Route::get("/admin/event/create", "EventController@create");
Route::get("/admin/event/edit/{id}", "EventController@edit");
Route::get("/admin/event/detail/{id}", "EventController@show");
Route::get("/admin/event/delete/{id}", "EventController@destroy");
Route::post("/admin/event/save", "EventController@store");
Route::post("/admin/event/update", "EventController@update");

// event category
Route::get("/admin/event-category", "EventCategoryController@index");
Route::get("/admin/event-category/create", "EventCategoryController@create");
Route::get("/admin/event-category/edit/{id}", "EventCategoryController@edit");
Route::get("/admin/event-category/delete/{id}", "EventCategoryController@destroy");
Route::post("/admin/event-category/save", "EventCategoryController@store");
Route::post("/admin/event-category/update", "EventCategoryController@update");


// scholarship category
Route::get("/admin/scholarship-category", "ScholarshipCategoryController@index");
Route::get("/admin/scholarship-category/create", "ScholarshipCategoryController@create");
Route::get("/admin/scholarship-category/edit/{id}", "ScholarshipCategoryController@edit");
Route::get("/admin/scholarship-category/delete/{id}", "ScholarshipCategoryController@destroy");
Route::post("/admin/scholarship-category/save", "ScholarshipCategoryController@store");
Route::post("/admin/scholarship-category/update", "ScholarshipCategoryController@update");

// program category
Route::get("/admin/program-category", "ProgramCategoryController@index");
Route::get("/admin/program-category/create", "ProgramCategoryController@create");
Route::get("/admin/program-category/edit/{id}", "ProgramCategoryController@edit");
Route::get("/admin/program-category/delete/{id}", "ProgramCategoryController@destroy");
Route::post("/admin/program-category/save", "ProgramCategoryController@store");
Route::post("/admin/program-category/update", "ProgramCategoryController@update");

// business type
Route::get("/admin/business-type", "BusinessTypeController@index");
Route::get("/admin/business-type/create", "BusinessTypeController@create");
Route::get("/admin/business-type/edit/{id}", "BusinessTypeController@edit");
Route::get("/admin/business-type/delete/{id}", "BusinessTypeController@destroy");
Route::post("/admin/business-type/save", "BusinessTypeController@store");
Route::post("/admin/business-type/update", "BusinessTypeController@update");

// company
Route::get("/admin/company", "CompanyController@index");
Route::get("/admin/company/create", "CompanyController@create");
Route::get("/admin/company/edit/{id}", "CompanyController@edit");
Route::get("/admin/company/detail/{id}", "CompanyController@show");
Route::get("/admin/company/delete/{id}", "CompanyController@destroy");
Route::post("/admin/company/save", "CompanyController@store");
Route::post("/admin/company/update", "CompanyController@update");

// school category
Route::get("/admin/school-category", "SchoolCategoryController@index");
Route::get("/admin/school-category/create", "SchoolCategoryController@create");
Route::get("/admin/school-category/edit/{id}", "SchoolCategoryController@edit");
Route::get("/admin/school-category/delete/{id}", "SchoolCategoryController@destroy");
Route::post("/admin/school-category/save", "SchoolCategoryController@store");
Route::post("/admin/school-category/update", "SchoolCategoryController@update");

// school program
Route::get("/admin/school-program", "SchoolProgramController@index");
Route::get("/admin/school-program/create", "SchoolProgramController@create");
Route::get("/admin/school-program/edit/{id}", "SchoolProgramController@edit");
Route::get("/admin/school-program/detail/{id}", "SchoolProgramController@show");
Route::get("/admin/school-program/delete/{id}", "SchoolProgramController@destroy");
Route::post("/admin/school-program/save", "SchoolProgramController@store");
Route::post("/admin/school-program/update", "SchoolProgramController@update");

// scholarship
Route::get("/admin/scholarship", "ScholarshipController@index");
Route::get("/admin/scholarship/create", "ScholarshipController@create");
Route::get("/admin/scholarship/edit/{id}", "ScholarshipController@edit");
Route::get("/admin/scholarship/detail/{id}", "ScholarshipController@show");
Route::get("/admin/scholarship/delete/{id}", "ScholarshipController@destroy");
Route::post("/admin/scholarship/save", "ScholarshipController@store");
Route::post("/admin/scholarship/update", "ScholarshipController@update");

// school
Route::get("/admin/school", "SchoolController@index");
Route::get("/admin/school/create", "SchoolController@create");
Route::get("/admin/school/edit/{id}", "SchoolController@edit");
Route::get("/admin/school/detail/{id}", "SchoolController@show");
Route::get("/admin/school/delete/{id}", "SchoolController@destroy");
Route::post("/admin/school/save", "SchoolController@store");
Route::post("/admin/school/update", "SchoolController@update");

// product category
Route::get("/admin/product-category", "ProductCategoryController@index");
Route::get("/admin/product-category/create", "ProductCategoryController@create");
Route::get("/admin/product-category/edit/{id}", "ProductCategoryController@edit");
Route::get("/admin/product-category/delete/{id}", "ProductCategoryController@destroy");
Route::post("/admin/product-category/save", "ProductCategoryController@save");
Route::post("/admin/product-category/update", "ProductCategoryController@update");

// shop category
Route::get("/admin/shop-category", "ShopCategoryController@index");
Route::get("/admin/shop-category/create", "ShopCategoryController@create");
Route::get("/admin/shop-category/edit/{id}", "ShopCategoryController@edit");
Route::get("/admin/shop-category/delete/{id}", "ShopCategoryController@destroy");
Route::post("/admin/shop-category/save", "ShopCategoryController@store");
Route::post("admin/shop-category/update", "ShopCategoryController@update");

// shop owner
Route::get("/admin/shop-owner", "ShopOwnerController@index");
Route::get("/admin/shop-owner/create", "ShopOwnerController@create");
Route::get("/admin/shop-owner/edit/{id}", "ShopOwnerController@edit");
Route::get("/admin/shop-owner/detail/{id}", "ShopOwnerController@show");
Route::get("/admin/shop-owner/delete/{id}", "ShopOwnerController@destroy");
Route::post("/admin/shop-owner/save", "ShopOwnerController@store");
Route::post("/admin/shop-owner/update", "ShopOwnerController@update");
Route::get("/admin/shop-owner/reset-password/{id}", "ShopOwnerController@reset_password");
Route::post("/admin/shop-owner/reset", "ShopOwnerController@reset");

// shop owner
Route::get("/admin/shop", "ShopController@index");
Route::get("/admin/shop/create", "ShopController@create");
Route::get("/admin/shop/edit/{id}", "ShopController@edit");
Route::get("/admin/shop/detail/{id}", "ShopController@show");
Route::get("/admin/shop/delete/{id}", "ShopController@destroy");
Route::post("/admin/shop/save", "ShopController@store");
Route::post("/admin/shop/update", "ShopController@update");

// review
Route::get("/admin/review", "ReviewController@index");
Route::get("/admin/review/create", "ReviewController@create");
Route::get("/admin/review/edit/{id}", "ReviewController@edit");
Route::get("/admin/review/detail/{id}", "ReviewController@detail");
Route::get("/admin/review/delete/{id}", "ReviewController@delete");
Route::post("/admin/review/save", "ReviewController@save");
Route::post("/admin/review/update", "ReviewController@update");

// review category
Route::get("/admin/review-category", "ReviewCategoryController@index");
Route::get("/admin/review-category/create", "ReviewCategoryController@create");
Route::get("/admin/review-category/edit/{id}", "ReviewCategoryController@edit");
Route::get("/admin/review-category/delete/{id}", "ReviewCategoryController@destroy");
Route::post("/admin/review-category/save", "ReviewCategoryController@store");
Route::post("/admin/review-category/update", "ReviewCategoryController@update");

// role
Route::get("/role", "RoleController@index");
Route::get("/role/create", "RoleController@create");
Route::get("/role/edit/{id}", "RoleController@edit");
Route::get("/role/delete/{id}", "RoleController@delete");
Route::post("/role/save", "RoleController@save");
Route::post("/role/update", "RoleController@update");
Route::auth();
Route::get('/home', 'HomeController@index')->name('home');
// settings
Route::get('/admin/setting', "SettingController@index");

// mgmt
Route::get("/management" ,"ManagementController@index");
// category
Route::get('/admin/category', "CategoryController@index");


// school program
Route::get('/school-program', "FrontController@school_program");
Route::get('/program/detail/{id}', "FrontController@program_detail");
Route::get('/school-program/category/{id}', "FrontController@program_category");

// review
Route::get('/review', "FrontController@review");
Route::get('/review/detail/{id}', "FrontController@review_detail");
Route::get('/review/category/{id}', "FrontController@review_category");
// scholarship
Route::get('/scholarship/detail/{id}', "FrontController@scholarship_detail");
Route::get('/scholarship/category/{id}', "FrontController@scholarship_category");
// product
Route::get('/admin/product', "ProductController@index");
Route::get('/admin/product/detail/{id}', "ProductController@detail");
Route::get('/admin/product/create', "ProductController@create");
Route::get('/admin/product/edit/{id}', "ProductController@edit");
Route::get('/admin/product/delete/{id}', "ProductController@delete");
Route::post('/admin/product/save', "ProductController@save");
Route::post('/admin/product/update', "ProductController@update");
Route::get('/admin/product/photo/delete/{id}', "PhotoController@delete");
Route::post('/admin/product/photo/save', "PhotoController@save");
// page
// Page
Route::get('/admin/page', "PageController@index");
Route::get('/admin/page/create', "PageController@create");
Route::post('/admin/page/save', "PageController@save");
Route::get('/admin/page/delete/{id}', "PageController@delete");
Route::get('/admin/page/edit/{id}', "PageController@edit");
Route::post('/admin/page/update', "PageController@update");
Route::get('/admin/page/view/{id}', "PageController@view");
