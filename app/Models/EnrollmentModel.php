<?php namespace App\Models;

use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table      = 'enrollments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'course_id', 'enrollment_date'];
    protected $useTimestamps = false;

    public function enrollUser(array $data)
    {
        // $data must contain user_id, course_id, enrollment_date
        return $this->insert($data); // returns inserted id or false
    }

    public function getUserEnrollments(int $user_id)
    {
        return $this
            ->select('enrollments.*, courses.id as course_id, courses.title, courses.description')
            ->join('courses', 'courses.id = enrollments.course_id')
            ->where('enrollments.user_id', $user_id)
            ->orderBy('enrollment_date', 'DESC')
            ->findAll();
    }

    public function isAlreadyEnrolled(int $user_id, int $course_id): bool
    {
        return $this->where(['user_id' => $user_id, 'course_id' => $course_id])->countAllResults(false) > 0;
    }
}
