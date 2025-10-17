<?php

namespace App\Controllers;

class Admin extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function dashboard()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login')->with('error', 'Please login first.');
        }

        // Check if user has admin role
        if (session()->get('user_role') !== 'admin') {
            return redirect()->to('/announcements')->with('error', 'Access Denied: Insufficient Permissions');
        }

        $data = [
            'title' => 'Admin Dashboard'
        ];

        return view('admin_dashboard', $data);
    }
}
