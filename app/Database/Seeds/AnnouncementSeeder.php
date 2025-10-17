<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title'   => 'Welcome to the New Academic Year',
                'content' => 'We are excited to welcome all students, teachers, and staff to the new academic year. This year brings many new opportunities for learning and growth. Please make sure to check your schedules and familiarize yourself with the updated policies and procedures.',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'title'   => 'Library Hours Update',
                'content' => 'The university library will now be open from 7:00 AM to 10:00 PM on weekdays and 9:00 AM to 6:00 PM on weekends. Extended hours during exam periods will be announced separately. Please make use of our extensive digital resources available 24/7 through the online portal.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day'))
            ],
            [
                'title'   => 'Student Portal Maintenance',
                'content' => 'Scheduled maintenance for the student portal will occur this Sunday from 2:00 AM to 6:00 AM. During this time, some features may be temporarily unavailable. We apologize for any inconvenience and appreciate your patience.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days'))
            ]
        ];

        // Insert the data
        $this->db->table('announcements')->insertBatch($data);
    }
}
