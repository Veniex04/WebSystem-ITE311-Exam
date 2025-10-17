<?php

namespace App\Controllers;

use App\Models\AnnouncementModel;

class Announcement extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function index()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login')->with('error', 'Please login first.');
        }

        $announcementModel = new AnnouncementModel();
        
        // Fetch all announcements ordered by created_at in descending order (newest first)
        $announcements = $announcementModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'title' => 'Announcements',
            'announcements' => $announcements
        ];

        return view('announcements', $data);
    }
}
