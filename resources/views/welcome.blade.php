use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('products.index'); // Redirect to products page
});

Route::resource('products', ProductController::class);
