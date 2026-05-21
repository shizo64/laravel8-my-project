<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            ['code' => 'ru', 'name' => 'Русский'],
            ['code' => 'en', 'name' => 'Английский'],
            ['code' => 'cn', 'name' => 'Китайский'],
        ];

        foreach ($languages as $lang) {
            Language::firstOrCreate(
                ['code' => $lang['code']],
                ['name' => $lang['name']]
            );
        }
    }
}
