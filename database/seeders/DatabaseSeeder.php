<?php

namespace Database\Seeders;

use App\Models\Manga;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        $mangas = [
            ['titre' => 'One Piece', 'author' => 'Eiichiro Oda', 'nbr_volume' => '110'],
            ['titre' => 'Naruto', 'author' => 'Masashi Kishimoto', 'nbr_volume' => '72'],
            ['titre' => 'Beastars', 'author' => 'Paru Itagaki', 'nbr_volume' => '22'],
            ['titre' => 'Jujutsu Kaisen', 'author' => 'Gege Akutami', 'nbr_volume' => '30'],
            ['titre' => 'Demon Slayer', 'author' => 'Koyoharu Gotouge', 'nbr_volume' => '23'],
            ['titre' => 'My Hero Academia', 'author' => 'Kohei Horikoshi', 'nbr_volume' => '42'],
        ];

        foreach ($mangas as $manga) {
            Manga::firstOrCreate(
                ['titre' => $manga['titre']],
                [
                    'author' => $manga['author'],
                    'description' => null,
                    'nbr_volume' => $manga['nbr_volume'],
                    'image' => null,
                ]
            );
        }
    }
}
