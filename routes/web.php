Route::prefix('admin')
->name('admin.')
->middleware(['auth', 'admin'])
->group(function () {
// Dashboard route
Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
->name('dashboard');

// Resource routes for admin management
Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
Route::resource('orders', App\Http\Controllers\Admin\OrderController::class);
Route::resource('users', App\Http\Controllers\Admin\UserController::class);
Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);
Route::resource('banners', App\Http\Controllers\Admin\BannerController::class);
Route::resource('comments', App\Http\Controllers\Admin\CommentController::class);
Route::resource('promotions', App\Http\Controllers\Admin\PromotionController::class);
});