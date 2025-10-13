<?php namespace App\Models;

use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table      = 'enrollments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'course_id', 'enrollment_date', 'status'];
    protected $useTimestamps = true;
    protected $createdField  = 'enrollment_date';
    protected $updatedField  = 'updated_at';

    /**
     * Enroll a user in a course
     * 
     * @param array $data Must contain user_id, course_id, and optionally enrollment_date
     * @return int|false Returns the inserted ID on success, false on failure
     */
    public function enrollUser(array $data)
    {
        // Validate required fields
        if (!isset($data['user_id']) || !isset($data['course_id'])) {
            return false;
        }

        // Set default enrollment date if not provided
        if (!isset($data['enrollment_date'])) {
            $data['enrollment_date'] = date('Y-m-d H:i:s');
        }

        // Set default status if not provided
        if (!isset($data['status'])) {
            $data['status'] = 'active';
        }

        return $this->insert($data);
    }

    /**
     * Get all courses a user is enrolled in
     * 
     * @param int $user_id The user ID
     * @return array Array of enrollment records with course details
     */
    public function getUserEnrollments(int $user_id)
    {
        return $this
            ->select('enrollments.*, courses.id as course_id, courses.title, courses.description, courses.instructor_id')
            ->join('courses', 'courses.id = enrollments.course_id')
            ->where('enrollments.user_id', $user_id)
            ->where('enrollments.status', 'active')
            ->orderBy('enrollment_date', 'DESC')
            ->findAll();
    }

    /**
     * Check if a user is already enrolled in a specific course
     * 
     * @param int $user_id The user ID
     * @param int $course_id The course ID
     * @return bool True if already enrolled, false otherwise
     */
    public function isAlreadyEnrolled(int $user_id, int $course_id): bool
    {
        $result = $this->where([
            'user_id' => $user_id, 
            'course_id' => $course_id,
            'status' => 'active'
        ])->countAllResults(false);
        
        return $result > 0;
    }

    /**
     * Get enrollment count for a specific course
     * 
     * @param int $course_id The course ID
     * @return int Number of active enrollments
     */
    public function getCourseEnrollmentCount(int $course_id): int
    {
        return $this->where([
            'course_id' => $course_id,
            'status' => 'active'
        ])->countAllResults(false);
    }

    /**
     * Cancel/withdraw a user's enrollment
     * 
     * @param int $user_id The user ID
     * @param int $course_id The course ID
     * @return bool True on success, false on failure
     */
    public function cancelEnrollment(int $user_id, int $course_id): bool
    {
        return $this->where([
            'user_id' => $user_id,
            'course_id' => $course_id
        ])->set('status', 'cancelled')->update();
    }
}
