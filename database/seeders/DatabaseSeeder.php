<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use App\Models\Document;
use App\Models\Language;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         User::factory(3)->create();
         Language::factory(10)->create();
         Project::factory(10)
             ->has(
                 Document::factory(3)
             )
             ->create();
    }
}
