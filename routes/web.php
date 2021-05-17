<?php

    use App\Http\Controllers\Auth\RegisteredUserController;
    use App\Http\Controllers\FeedController;
    use App\Http\Controllers\SubscribedFeedController;
    use App\Models\Feed;
    use App\Models\SubscribedFeed;
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
    return redirect()->route('dashboard');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [RegisteredUserController::class, 'viewDashboard'])->name('dashboard');

    Route::get('/subscribe', [FeedController::class, 'requestCreateAndSubscribe'])->name('subscribe');

    Route::get('/feed/{id}', [SubscribedFeedController::class, 'displayFeed'])->name('feed');

    Route::get('/unsubscribe/{id}', [SubscribedFeedController::class, 'unsubscribe'])->name('unsubscribe');
});


require __DIR__.'/auth.php';
