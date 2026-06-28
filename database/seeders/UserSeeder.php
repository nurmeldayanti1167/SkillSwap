<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Skill;
use App\Models\UserSkill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $usersData = [
            [
                'name' => 'Arif Pratama',
                'email' => 'arif@example.com',
                'password' => bcrypt('secret'),
                'prodi' => 'Teknik Informatika',
                'semester' => 5,
                'whatsapp_number' => '081212345678',
                'offered' => ['PHP Programming', 'Laravel Development'],
                'sought' => ['UI/UX Design'],
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => bcrypt('secret'),
                'prodi' => 'Sistem Informasi',
                'semester' => 4,
                'whatsapp_number' => '081298765432',
                'offered' => ['JavaScript', 'React'],
                'sought' => ['Laravel Development', 'PHP Programming'],
            ],
            [
                'name' => 'Citra Lestari',
                'email' => 'citra@example.com',
                'password' => bcrypt('secret'),
                'prodi' => 'Desain Grafis',
                'semester' => 6,
                'whatsapp_number' => '081233344455',
                'offered' => ['Graphic Design', 'Adobe Photoshop'],
                'sought' => ['Content Writing'],
            ],
            [
                'name' => 'Deni Hartono',
                'email' => 'deni@example.com',
                'password' => bcrypt('secret'),
                'prodi' => 'Manajemen',
                'semester' => 3,
                'whatsapp_number' => '081255566677',
                'offered' => ['Public Speaking'],
                'sought' => ['Project Management'],
            ],
            [
                'name' => 'Eka Putri',
                'email' => 'eka@example.com',
                'password' => bcrypt('secret'),
                'prodi' => 'Ilmu Komunikasi',
                'semester' => 2,
                'whatsapp_number' => '081277788899',
                'offered' => ['Digital Marketing', 'SEO'],
                'sought' => ['Copywriting'],
            ],
            [
                'name' => 'Fajar Rahman',
                'email' => 'fajar@example.com',
                'password' => bcrypt('secret'),
                'prodi' => 'Teknik Informatika',
                'semester' => 7,
                'whatsapp_number' => '081299988877',
                'offered' => ['Python', 'Machine Learning'],
                'sought' => ['Data Analysis'],
            ],
            [
                'name' => 'Gina Sari',
                'email' => 'gina@example.com',
                'password' => bcrypt('secret'),
                'prodi' => 'Sistem Informasi',
                'semester' => 8,
                'whatsapp_number' => '081300112233',
                'offered' => ['Figma', 'UI/UX Design'],
                'sought' => ['JavaScript'],
            ],
            [
                'name' => 'Hadi Kurniawan',
                'email' => 'hadi@example.com',
                'password' => bcrypt('secret'),
                'prodi' => 'Desain Produk',
                'semester' => 5,
                'whatsapp_number' => '081322334455',
                'offered' => ['Industrial Design'],
                'sought' => ['Adobe Illustrator'],
            ],
            [
                'name' => 'Ika Santi',
                'email' => 'ika@example.com',
                'password' => bcrypt('secret'),
                'prodi' => 'Teknik Elektro',
                'semester' => 6,
                'whatsapp_number' => '081344556677',
                'offered' => ['Embedded C', 'IoT'],
                'sought' => ['Machine Learning', 'Python'],
            ],
            [
                'name' => 'Joko Widodo',
                'email' => 'joko@example.com',
                'password' => bcrypt('secret'),
                'prodi' => 'Teknik Sipil',
                'semester' => 4,
                'whatsapp_number' => '081366778899',
                'offered' => ['Project Management'],
                'sought' => ['Public Speaking'],
            ],
        ];

        foreach ($usersData as $data) {
            $offered = $data['offered'];
            $sought = $data['sought'];
            unset($data['offered'], $data['sought']);
            $user = User::create($data);

            foreach ($offered as $skillName) {
                $skill = Skill::firstOrCreate(['skill_name' => $skillName]);
                UserSkill::create([
                    'user_id' => $user->id,
                    'skill_id' => $skill->id,
                    'type' => 'offer',
                    'proficiency_level' => 'intermediate',
                ]);
            }
            foreach ($sought as $skillName) {
                $skill = Skill::firstOrCreate(['skill_name' => $skillName]);
                UserSkill::create([
                    'user_id' => $user->id,
                    'skill_id' => $skill->id,
                    'type' => 'seek',
                    'proficiency_level' => 'beginner',
                ]);
            }
        }
    }
}
