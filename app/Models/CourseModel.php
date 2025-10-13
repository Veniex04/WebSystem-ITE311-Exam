<?php namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table      = 'courses';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'description', 'instructor_id', 'status', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get all active courses
     * 
     * @return array Array of active courses
     */
    public function getActiveCourses()
    {
        return $this->where('status', 'active')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get all courses (including inactive)
     * 
     * @return array Array of all courses
     */
    public function getAllCourses()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    /**
     * Get courses by instructor
     * 
     * @param int $instructor_id The instructor ID
     * @return array Array of courses by the instructor
     */
    public function getCoursesByInstructor(int $instructor_id)
    {
        return $this->where('instructor_id', $instructor_id)
                    ->where('status', 'active')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get course details with instructor information
     * 
     * @param int $course_id The course ID
     * @return array|null Course details with instructor info or null if not found
     */
    public function getCourseWithInstructor(int $course_id)
    {
        return $this->select('courses.*, users.name as instructor_name, users.email as instructor_email')
                    ->join('users', 'users.id = courses.instructor_id', 'left')
                    ->where('courses.id', $course_id)
                    ->first();
    }

    /**
     * Get available courses for a user (excluding already enrolled ones)
     * 
     * @param int $user_id The user ID
     * @return array Array of available courses
     */
    public function getAvailableCourses(int $user_id)
    {
        // Get all active courses
        $allCourses = $this->getActiveCourses();
        
        // Get user's enrolled course IDs
        $enrollmentModel = new EnrollmentModel();
        $enrolledCourses = $enrollmentModel->getUserEnrollments($user_id);
        $enrolledCourseIds = array_column($enrolledCourses, 'course_id');
        
        // Filter out enrolled courses
        $availableCourses = array_filter($allCourses, function($course) use ($enrolledCourseIds) {
            return !in_array($course['id'], $enrolledCourseIds);
        });
        
        return array_values($availableCourses);
    }

    /**
     * Search courses by title or description
     * 
     * @param string $searchTerm The search term
     * @return array Array of matching courses
     */
    public function searchCourses(string $searchTerm)
    {
        return $this->groupStart()
                    ->like('title', $searchTerm)
                    ->orLike('description', $searchTerm)
                    ->groupEnd()
                    ->where('status', 'active')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get course statistics
     * 
     * @param int $course_id The course ID
     * @return array Course statistics
     */
    public function getCourseStats(int $course_id)
    {
        $enrollmentModel = new EnrollmentModel();
        
        return [
            'total_enrollments' => $enrollmentModel->getCourseEnrollmentCount($course_id),
            'course' => $this->find($course_id)
        ];
    }
}
