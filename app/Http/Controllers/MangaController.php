<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\Manga_review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MangaController extends Controller
{

public function create(Request $request){
        $validatedData = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'nbr_volume' => ['required', 'integer', 'min:1'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')
                ->store('mangas', 'public');
        }

        Manga::create($validatedData);

        return redirect('/');
    }

    public function delete($id)
    {
        Manga_review::where('manga_id', $id)->delete();

        $manga = Manga::findOrFail($id);
        $manga->delete();

        return redirect('/admin');
    }

    public function show($id)
    {
        $manga = Manga::findOrFail($id);
        $noteMoyenne = Manga_review::where('manga_id', $id)
            ->whereNotNull('volume_number')
            ->avg('notes');
        $volumeReviews = Manga_review::where('manga_id', $id)
            ->whereNotNull('volume_number')
            ->get()
            ->keyBy('volume_number');
        $reviews = Manga_review::with('user')
            ->where('manga_id', $id)
            ->whereNull('volume_number')
            ->whereNotNull('Commentaire')
            ->latest()
            ->get();

        return view('manga.show', [
            'manga' => $manga,
            'noteMoyenne' => $noteMoyenne,
            'volumeReviews' => $volumeReviews,
            'reviews' => $reviews,
        ]);
    }

//Pour modifier un manga, on a besoin de deux méthodes : edit et update. 
// La méthode edit récupère le manga à modifier et affiche le formulaire de modification, 
// tandis que la méthode update met à jour les informations du manga dans la base de données.
public function edit($id)
{
    $manga = Manga::findOrFail($id);

    return view('manga.edit', ['manga' => $manga]);
}
public function update(Request $request, $id)
{
    $manga = Manga::findOrFail($id);

    $validatedData = $request->validate([
        'titre' => ['required', 'string', 'max:255'],
        'author' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string', 'max:255'],
        'nbr_volume' => ['required', 'integer', 'min:1'],
        'image' => ['nullable', 'image', 'max:2048'],
    ]);

    if ($request->hasFile('image')) {
        if ($manga->image) {
            Storage::disk('public')->delete($manga->image);
        }

        $validatedData['image'] = $request->file('image')->store('mangas', 'public');
    }

    $manga->update($validatedData);

    return redirect('/admin');
}

}