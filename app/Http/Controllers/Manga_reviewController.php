<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\Manga_review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Manga_reviewController extends Controller
{
    public function create(Request $request, $id)
    {
        // Le nombre de champs de note dépend du nombre de volumes du manga.
        $manga = Manga::findOrFail($id);
        $volumeCount = (int) $manga->nbr_volume;

        $rules = [
            'notes' => ['required', 'array', 'size:' . $volumeCount],
            'Commentaire' => ['nullable', 'string', 'max:1000'],
        ];

        for ($volumeNumber = 1; $volumeNumber <= $volumeCount; $volumeNumber++) {
            $rules["notes.{$volumeNumber}"] = [
                'required',
                'numeric',
                'min:0.5',
                'max:5',
            ];
        }

        $validatedData = $request->validate($rules);

        // Une seule review générale par utilisateur et par manga.
        Manga_review::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'manga_id' => $id,
                'volume_number' => null,
            ],
            [
                'notes' => null,
                'Commentaire' => $validatedData['Commentaire'] ?? null,
            ]
        );

        // Une ligne séparée est conservée pour la note de chaque volume.
        foreach ($validatedData['notes'] as $volumeNumber => $note) {
            Manga_review::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'manga_id' => $id,
                    'volume_number' => $volumeNumber,
                ],
                [
                    'notes' => $note,
                    'Commentaire' => null,
                ]
            );
        }

        return redirect()->route('manga.show', ['id' => $id]);
    }
}
