<?php

namespace App\Controllers;

class Teacher extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function dashboard()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login')->with('error', 'Please login first.');
        }

        // Check if user has teacher role
        if (session()->get('user_role') !== 'teacher') {
            return redirect()->to('/announcements')->with('error', 'Access Denied: Insufficient Permissions');
        }

        $data = [
            'title' => 'Teacher Dashboard'
        ];

        return view('teacher_dashboard', $data);
    }
}
