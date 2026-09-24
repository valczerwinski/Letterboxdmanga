<?php

use App\Models\Manga;
use App\Models\Manga_review;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\Manga_reviewController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $mangas = Manga::query()
        ->select('mangas.*')
        ->selectSub(
            Manga_review::selectRaw('AVG(notes)')
                ->whereColumn('manga_id', 'mangas.id')
                ->whereNotNull('volume_number'),
            'note_moyenne'
        )
        ->when(request('sort') === 'az', fn ($query) => $query->orderBy('titre'))
        ->get();

    $mangasLesMieuxNotes = $mangas
        ->filter(fn ($manga) => $manga->note_moyenne !== null)
        ->sortByDesc('note_moyenne')
        ->take(3);

    return view('manga.homepage', [
        'mangas' => $mangas,
        'mangasLesMieuxNotes' => $mangasLesMieuxNotes,
    ]);
});

Route :: get('/mangas', function () {
    $mangas = Manga::all();
    return view('mangas.index', ['mangas' => $mangas]);
});

Route::get('/create', function () {
    return view('manga.create');
})->name("view_create");
Route::post('/create', [MangaController::class, 'create'])->name("create");

Route::get('/mangas/{id}', [MangaController::class, 'show'])->name('manga.show');
Route::post('/mangas/{id}/review', [Manga_reviewController::class, 'create'])
    ->middleware('auth')
    ->name('manga.review');

Route::get('/delete', function () {
    $mangas = Manga::all();
    return view('manga.delete', ['mangas' => $mangas]);
})->name("view_delete");

Route::get('/{id}/delete', [MangaController::class, 'delete'])->name("delete");

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin', function(){
    $mangas = Manga::all();

    return view('dashboard', ['mangas' => $mangas]);
})->middleware('auth')->name('admin.dashboard');

Route::get('/admin/manga/edit/{id}', [MangaController::class, 'edit'])->middleware('auth')->name('admin.manga.edit');

Route::put('/admin/manga/update/{id}', [MangaController::class, 'update'])->middleware('auth')->name('manga.update');

Route::get('/admin/users', [AdminController::class, 'users'])->middleware('auth')->name('admin.users');

Route::get('/admin/users/{id}/delete', [AdminController::class, 'deleteUser'])->middleware('auth')->name('admin.users.delete');
