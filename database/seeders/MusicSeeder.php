<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Music;
use Carbon\Carbon;

class MusicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Music::truncate();

        $data = [
            [
                'name' => 'Perfect',
                'singer' => 'Ed Sheeran',
                'genre' => 'Ballad',
            ],
            [
                'name' => 'You belong with me',
                'singer' => 'Taylor Swift',
                'genre' => 'Pop',
            ],
            [
                'name' => 'Shake It Off',
                'singer' => 'Taylor Swift',
                'genre' => 'Pop',
            ],
            [
                'name' => 'Nothing Else Matters',
                'singer' => 'Metallica',
                'genre' => 'Rock',
            ],
            [
                'name' => 'Master Of Puppets',
                'singer' => 'Metallica',
                'genre' => 'Rock',
            ],
            [
                'name' => 'Stay',
                'singer' => 'Justin Bieber',
                'genre' => 'Pop',
            ],
            [
                'name' => 'Love Yourself',
                'singer' => 'Justin Bieber',
                'genre' => 'Pop',
            ],
            [
                'name' => '7 rings',
                'singer' => 'Ariana Grande',
                'genre' => 'Pop',
            ],
            [
                'name' => 'In The End',
                'singer' => 'Linkin Park',
                'genre' => 'Metal',
            ],
            [
                'name' => 'Numb',
                'singer' => 'Linkin Park',
                'genre' => 'Metal',
            ],
        ];
        
        foreach ($data as $item) {
            Music::insert([
                'name' => $item['name'],
                'singer' => $item['singer'],
                'genre' => $item['genre'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
