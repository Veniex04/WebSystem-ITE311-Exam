<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
public function run()
{
    $data = [
        [
            'name' => 'Admin User',
            'email' => 'admin@lms.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role' => 'admin'
        ],
        [
            'name' => 'Josh Student',
            'email' => 'student@lms.com',
            'password' => password_hash('student123', PASSWORD_DEFAULT),
            'role' => 'student'
        ],
        [
            'name' => 'Jim Teacher',
            'email' => 'teacher@lms.com',
            'password' => password_hash('teacher123', PASSWORD_DEFAULT),
            'role' => 'teacher'
        ]
    ];

    $this->db->table('users')->insertBatch($data);
}

}
