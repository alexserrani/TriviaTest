<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TriviaController;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class TriviaController extends Controller
{
    public function index()
    {
        $response = Http::get('https://opentdb.com/api.php', [
        'amount' => 10,
        'category' => 9,
        'difficulty' => 'easy',
        'type' => 'multiple',
        'encode' => 'url3986',
    ]);

    $questions = $response->json()['results'];

    return view('index', compact('questions'));
}

    public function submitScore(Request $request)
    {
        $score = new Score();
        $score->user_id = auth()->user()->id;
        $score->score = $request->score;
        $score->save();

        return redirect()->route('trivia.index');
    }

    public function dashboard()
    {
        // ...
    }
}

Route::get('/', [TriviaController::class, 'index'])->name('home');
Route::get('/submit-score', [TriviaController::class, 'submitScore'])->middleware('auth')->name('submit-score');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [TriviaController::class, 'dashboard'])->name('dashboard');
});

Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.show');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.show');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});


