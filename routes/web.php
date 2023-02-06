<?php

use App\Events\OrderStatusUpdated;
use App\Http\Livewire\TaskManager;
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

// Level 1
class Order {
    public $id;
    public $status;
    public $total;

    public function __construct($id, $status, $total) {
        $this->id = $id;
        $this->status = $status;
        $this->total = $total;
    }
}

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('tasks');
});

// Route::get('/update', function() {
//     OrderStatusUpdated::dispatch(new Order(21, 'in-transit', '487500'));
// });

// Level 2
Route::get('tasks', TaskManager::class)->name('tasks');