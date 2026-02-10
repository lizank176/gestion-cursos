<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Course;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Obtenemos los IDs de los cursos existentes
        $webId = Course::where('name', 'Desarrollo Web Fullstack')->first()->id;
        $aiId = Course::where('name', 'Inteligencia Artificial')->first()->id;

        Student::create([
            'name' => 'Lisa Simpson',
            'email' => 'lisa@springfield.com',
            'course_id' => $webId
        ]);

        Student::create([
            'name' => 'Bart Simpson',
            'email' => 'bart@springfield.com',
            'course_id' => $aiId
        ]);

        Student::create([
            'name' => 'Milhouse Van Houten',
            'email' => 'milhouse@springfield.com',
            'course_id' => $webId
        ]);
    }
}