<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        Course::create([
            'name' => 'Desarrollo Web Fullstack',
            'description' => 'Aprende Laravel, Vue y MySQL desde cero.'
        ]);

        Course::create([
            'name' => 'Inteligencia Artificial',
            'description' => 'Introducción a Python y redes neuronales.'
        ]);

        Course::create([
            'name' => 'Diseño UI/UX',
            'description' => 'Principios de diseño visual y usabilidad.'
        ]);
    }
}