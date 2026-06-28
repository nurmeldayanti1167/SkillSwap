<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            ['skill_name' => 'PHP Programming', 'category' => 'Programming'],
            ['skill_name' => 'Laravel Development', 'category' => 'Programming'],
            ['skill_name' => 'JavaScript', 'category' => 'Programming'],
            ['skill_name' => 'React', 'category' => 'Programming'],
            ['skill_name' => 'Python', 'category' => 'Programming'],
            ['skill_name' => 'Java', 'category' => 'Programming'],
            ['skill_name' => 'UI/UX Design', 'category' => 'Design'],
            ['skill_name' => 'Graphic Design', 'category' => 'Design'],
            ['skill_name' => 'Adobe Photoshop', 'category' => 'Design'],
            ['skill_name' => 'Adobe Illustrator', 'category' => 'Design'],
            ['skill_name' => 'Figma', 'category' => 'Design'],
            ['skill_name' => 'Video Editing', 'category' => 'Multimedia'],
            ['skill_name' => 'Content Writing', 'category' => 'Writing'],
            ['skill_name' => 'Copywriting', 'category' => 'Writing'],
            ['skill_name' => 'Digital Marketing', 'category' => 'Marketing'],
            ['skill_name' => 'Social Media Management', 'category' => 'Marketing'],
            ['skill_name' => 'SEO', 'category' => 'Marketing'],
            ['skill_name' => 'English', 'category' => 'Language'],
            ['skill_name' => 'Japanese', 'category' => 'Language'],
            ['skill_name' => 'Korean', 'category' => 'Language'],
            ['skill_name' => 'Public Speaking', 'category' => 'Soft Skills'],
            ['skill_name' => 'Project Management', 'category' => 'Management'],
            ['skill_name' => 'Data Analysis', 'category' => 'Data'],
            ['skill_name' => 'Machine Learning', 'category' => 'Data'],
            ['skill_name' => 'Mobile Development', 'category' => 'Programming'],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
