<?php namespace App\Controllers;

use App\Models\EnrollmentModel;
use App\Models\CourseModel;
use CodeIgniter\Controller;

class Course extends Controller
{
    public function enroll()
    {
        $session = session();
        $user_id = $session->get('user_id'); // MUST be set during login

        // 1) Authorization check: must be logged in
        if (!$user_id) {
            return $this->response->setStatusCode(401)->setJSON([
                'status' => false,
                'message' => 'Unauthorized. Please log in.'
            ]);
        }

        // Optional: ensure only students can enroll
        $role = $session->get('role') ?: 'student';
        if ($role !== 'student') {
            return $this->response->setStatusCode(403)->setJSON([
                'status' => false,
                'message' => 'Forbidden: only students can enroll.'
            ]);
        }

        // 2) Validate input
        $course_id_raw = $this->request->getPost('course_id');
        if (!$course_id_raw || !ctype_digit((string)$course_id_raw)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'Invalid course_id.'
            ]);
        }
        $course_id = (int)$course_id_raw;

        // 3) Check course exists
        $courseModel = new CourseModel();
        $course = $courseModel->find($course_id);
        if (!$course) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => false,
                'message' => 'Course not found.'
            ]);
        }

        // 4) Check already enrolled
        $enrollModel = new EnrollmentModel();
        if ($enrollModel->isAlreadyEnrolled($user_id, $course_id)) {
            return $this->response->setStatusCode(409)->setJSON([
                'status' => false,
                'message' => 'You are already enrolled in this course.'
            ]);
        }

        // 5) Insert enrollment
        $data = [
            'user_id'         => $user_id,
            'course_id'       => $course_id,
            'enrollment_date' => date('Y-m-d H:i:s')
        ];

        try {
            $insertId = $enrollModel->insert($data);

            if ($insertId === false) {
                throw new \Exception('DB insert failed');
            }

            // Return success and new CSRF hash so front-end can refresh token if needed
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Enrolled successfully.',
                'course'  => [
                    'id' => $course_id,
                    'title' => $course['title']
                ],
                'csrfHash' => csrf_hash()
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'status' => false,
                'message' => 'Server error. Please try again later.',
            ]);
        }
    }
}
