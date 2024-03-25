<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'Kimi no Na Wa.',
            'author' => 'Makoto Shinkai',
            'publisher' => 'Gramedia',
            'release_date' =>  '2016-08-26',
            'cover' => 'cover_images/1710999306_Your_Name_poster.png',
            'synopsis' => "Two teenagers share a profound, magical connection upon discovering they are swapping bodies. Things manage to become even more complicated when the boy and girl decide to meet in person. Mitsuha is the daughter of the mayor of a small mountain town. She's a straightforward high school girl who lives with her sister and her grandmother and has no qualms about letting it be known that she's uninterested in Shinto rituals or helping her father's electoral campaign. Instead she dreams of leaving the boring town and trying her luck in Tokyo. Taki is a high school boy in Tokyo who works part-time in an Italian restaurant and aspires to become an architect or an artist. Every night he has a strange dream where he becomes...a high school girl in a small mountain town."
        ]);

        Book::create([
            'title' => 'Tenki no Ko.',
            'author' => 'Makoto Shinkai',
            'publisher' => 'Gramedia',
            'release_date' => '2019-07-19',
            'cover' => 'cover_images/1711001013_tenki_no_ko_weathering_with_you-616038056-large.jpg',
            'synopsis' => 'The story of Tenki no Ko: Weathering With You follows Hotaka Morishima, a high school boy who moves to Tokyo after running away from his home on an isolated island, and Akina Amano, a girl with the mysterious power to control the weather by "praying".'
        ]);
    }
}
