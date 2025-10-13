<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        /* Navbar with Instagram gradient */
        .navbar {
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
        }

        .navbar-brand,  
        .nav-link,
        .dropdown-item {
            color: white !important;
        }

        .nav-link:hover,
        .dropdown-item:hover {
            color: #ffd1dc !important;
        }

        .dropdown-menu {
            background-color: #cc2366;
            border: none;
        }

        .navbar-toggler {
            background-color: white;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.6rem;
        }

        .content-wrapper {
            margin-top: 30px;
            padding: 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h5 {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .stat-icon {
            font-size: 2rem;
            color: #dc2743;
        }

        .role-badge {
            border-radius: 999px;
            padding: 6px 12px;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .role-admin { background: #9b1b6f; }
        .role-teacher { background: #cc5a3c; }
        .role-student { background: #3b82f6; }

        /* Course Cards */
        .course-card {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: #fff;
        }

        .course-card:hover {
            border-color: #dc2743;
            box-shadow: 0 4px 15px rgba(220, 39, 67, 0.1);
            transform: translateY(-2px);
        }

        .course-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .course-description {
            color: #6c757d;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .enrollment-date {
            font-size: 0.8rem;
            color: #28a745;
            font-weight: 500;
        }

        .btn-enroll {
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743);
            border: none;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-enroll:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 39, 67, 0.3);
            color: white;
        }

        .btn-enroll:disabled {
            background: #6c757d;
            transform: none;
            box-shadow: none;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .alert {
            border-radius: 12px;
            border: none;
        }

        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1055;
        }
    </style>
</head>
<body>

<!-- Content -->
<div class="container">
  <div class="content-wrapper">
      <h2 class="fw-bold">Welcome, <?= esc($user_name ?? session('name')) ?> 🎉</h2>
      <p class="text-muted">
          Your role:
          <?php
            // display the incoming $role first; fall back to session('user_role')
            $displayRole = $role ?? session('user_role') ?? 'student';
          ?>
          <span class="role-badge <?= $displayRole === 'admin' ? 'role-admin' : ($displayRole === 'teacher' ? 'role-teacher' : 'role-student') ?>">
              <?= esc($displayRole) ?>
          </span>
      </p>

      <div class="row mt-4">
          <!-- Common cards -->
          <div class="col-md-4">
              <div class="card p-3 text-center">
                  <div class="stat-icon mb-2"><i class="bi bi-person-badge-fill"></i></div>
                  <h5>Profile</h5>
                  <p class="fs-6 text-muted">View or update profile details</p>
                  <a href="<?= site_url('profile') ?>" class="btn btn-sm btn-outline-primary">Open</a>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card p-3 text-center">
                  <div class="stat-icon mb-2"><i class="bi bi-clipboard-check-fill"></i></div>
                  <h5>Notifications</h5>
                  <p class="fs-6 text-muted">See recent notifications</p>
                  <a href="<?= site_url('notifications') ?>" class="btn btn-sm btn-outline-primary">Open</a>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card p-3 text-center">
                  <div class="stat-icon mb-2"><i class="bi bi-gear-fill"></i></div>
                  <h5>Settings</h5>
                  <p class="fs-6 text-muted">Account & app settings</p>
                  <a href="<?= site_url('settings') ?>" class="btn btn-sm btn-outline-primary">Open</a>
              </div>
          </div>
      </div>

      <!-- Role specific content -->
      <div class="row mt-4">
        <?php if ($role === 'admin'): ?>
            <!-- ADMIN SECTION -->
            <div class="col-12">
                <div class="card p-3 mb-3">
                    <h4><i class="bi bi-shield-lock-fill"></i> Admin Panel</h4>
                    <p class="text-muted">Site-wide management tools and user administration.</p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card p-3 text-center">
                                <div class="stat-icon mb-2"><i class="bi bi-people-fill"></i></div>
                                <h5>Users</h5>
                                <p class="fs-4 fw-bold">1,024</p>
                                <a href="<?= site_url('admin/users') ?>" class="btn btn-sm btn-primary">Manage</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3 text-center">
                                <div class="stat-icon mb-2"><i class="bi bi-layout-text-window-reverse"></i></div>
                                <h5>Courses</h5>
                                <p class="fs-4 fw-bold">230</p>
                                <a href="<?= site_url('admin/courses') ?>" class="btn btn-sm btn-primary">Manage</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3 text-center">
                                <div class="stat-icon mb-2"><i class="bi bi-bar-chart-line-fill"></i></div>
                                <h5>Reports</h5>
                                <p class="fs-6 text-muted">System analytics & logs</p>
                                <a href="<?= site_url('admin/reports') ?>" class="btn btn-sm btn-primary">Open</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ($role === 'teacher'): ?>
            <!-- TEACHER SECTION -->
            <div class="col-12">
                <div class="card p-3 mb-3">
                    <h4><i class="bi bi-person-workspace"></i> Teacher Panel</h4>
                    <p class="text-muted">Manage your classes, assignments and student progress.</p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card p-3 text-center">
                                <div class="stat-icon mb-2"><i class="bi bi-journal-check"></i></div>
                                <h5>My Classes</h5>
                                <p class="fs-4 fw-bold">5</p>
                                <a href="<?= site_url('teacher/classes') ?>" class="btn btn-sm btn-primary">Open</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3 text-center">
                                <div class="stat-icon mb-2"><i class="bi bi-pencil-square"></i></div>
                                <h5>Assignments</h5>
                                <p class="fs-4 fw-bold">12</p>
                                <a href="<?= site_url('teacher/assignments') ?>" class="btn btn-sm btn-primary">Manage</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3 text-center">
                                <div class="stat-icon mb-2"><i class="bi bi-people"></i></div>
                                <h5>Students</h5>
                                <p class="fs-6 text-muted">View enrolled students</p>
                                <a href="<?= site_url('teacher/students') ?>" class="btn btn-sm btn-primary">Open</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <!-- STUDENT SECTION -->
            <div class="col-12">
                <div class="card p-3 mb-3">
                    <h4><i class="bi bi-mortarboard-fill"></i> Student Panel</h4>
                    <p class="text-muted">Your courses, assignments and grades.</p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card p-3 text-center">
                                <div class="stat-icon mb-2"><i class="bi bi-book"></i></div>
                                <h5>Courses</h5>
                                <p class="fs-4 fw-bold">6</p>
                                <a href="<?= site_url('student/courses') ?>" class="btn btn-sm btn-primary">View</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3 text-center">
                                <div class="stat-icon mb-2"><i class="bi bi-file-earmark-text"></i></div>
                                <h5>Assignments</h5>
                                <p class="fs-4 fw-bold">8</p>
                                <a href="<?= site_url('student/assignments') ?>" class="btn btn-sm btn-primary">Open</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3 text-center">
                                <div class="stat-icon mb-2"><i class="bi bi-award-fill"></i></div>
                                <h5>Grades</h5>
                                <p class="fs-6 text-muted">Check your progress</p>
                                <a href="<?= site_url('student/grades') ?>" class="btn btn-sm btn-primary">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ENROLLED COURSES SECTION -->
            <div class="col-12">
                <div class="card p-3 mb-3">
                    <h4><i class="bi bi-bookmark-check-fill"></i> My Enrolled Courses</h4>
                    <p class="text-muted">Courses you are currently enrolled in.</p>
                    
                    <div id="enrolled-courses-container">
                        <div class="text-center py-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2 text-muted">Loading your courses...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- AVAILABLE COURSES SECTION -->
            <div class="col-12">
                <div class="card p-3 mb-3">
                    <h4><i class="bi bi-plus-circle-fill"></i> Available Courses</h4>
                    <p class="text-muted">Discover and enroll in new courses.</p>
                    
                    <div id="available-courses-container">
                        <div class="text-center py-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2 text-muted">Loading available courses...</p>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>
      </div>

  </div>
</div>

<!-- Toast Container -->
<div class="toast-container"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Only load course data for students
    <?php if ($displayRole === 'student'): ?>
    loadEnrolledCourses();
    loadAvailableCourses();
    <?php endif; ?>

    // jQuery event delegation for enroll buttons
    $(document).on('click', '.enroll-btn', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const courseId = $(this).data('course-id');
        const $button = $(this);
        
        if (courseId) {
            enrollInCourseWithJQuery(courseId, $button);
        }
    });
});

// Load enrolled courses
function loadEnrolledCourses() {
    fetch('<?= site_url('course/myEnrollments') ?>', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById('enrolled-courses-container');
        
        if (data.status && data.data.length > 0) {
            container.innerHTML = `
                <div class="row">
                    ${data.data.map(course => `
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="course-card p-3 h-100">
                                <div class="course-title">${escapeHtml(course.title)}</div>
                                <div class="course-description mb-2">${escapeHtml(course.description || 'No description available')}</div>
                                <div class="enrollment-date mb-3">
                                    <i class="bi bi-calendar-check"></i> 
                                    Enrolled: ${formatDate(course.enrollment_date)}
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="<?= site_url('course/view') ?>/${course.course_id}" class="btn btn-sm btn-outline-primary flex-fill">
                                        <i class="bi bi-eye"></i> View Course
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="cancelEnrollment(${course.course_id})">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `).join('')}
                </div>
            `;
        } else {
            container.innerHTML = `
                <div class="empty-state">
                    <i class="bi bi-book"></i>
                    <h5>No Enrolled Courses</h5>
                    <p>You haven't enrolled in any courses yet. Check out the available courses below!</p>
                </div>
            `;
        }
    })
    .catch(error => {
        console.error('Error loading enrolled courses:', error);
        document.getElementById('enrolled-courses-container').innerHTML = `
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle"></i>
                Failed to load enrolled courses. Please refresh the page.
            </div>
        `;
    });
}

// Load available courses
function loadAvailableCourses() {
    fetch('<?= site_url('course/available') ?>', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById('available-courses-container');
        
        if (data.status && data.data.length > 0) {
            container.innerHTML = `
                <div class="row">
                    ${data.data.map(course => `
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="course-card p-3 h-100">
                                <div class="course-title">${escapeHtml(course.title)}</div>
                                <div class="course-description mb-3">${escapeHtml(course.description || 'No description available')}</div>
                                <button class="btn btn-enroll w-100 enroll-btn" data-course-id="${course.id}" id="enroll-btn-${course.id}">
                                    <i class="bi bi-plus-circle"></i> Enroll Now
                                </button>
                            </div>
                        </div>
                    `).join('')}
                </div>
            `;
        } else {
            container.innerHTML = `
                <div class="empty-state">
                    <i class="bi bi-check-circle"></i>
                    <h5>All Caught Up!</h5>
                    <p>You're enrolled in all available courses. Great job!</p>
                </div>
            `;
        }
    })
    .catch(error => {
        console.error('Error loading available courses:', error);
        document.getElementById('available-courses-container').innerHTML = `
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle"></i>
                Failed to load available courses. Please refresh the page.
            </div>
        `;
    });
}

// jQuery-based enrollment function
function enrollInCourseWithJQuery(courseId, $button) {
    const originalText = $button.html();
    
    // Disable button and show loading
    $button.prop('disabled', true);
    $button.html('<i class="bi bi-hourglass-split"></i> Enrolling...');
    
    // Use jQuery $.post() as requested
    $.post('<?= site_url('course/enroll') ?>', {
        course_id: courseId,
        csrf_hash: getCSRFTokenValue()
    })
    .done(function(data) {
        if (data.status) {
            // Show Bootstrap alert message
            showBootstrapAlert('success', 'Success!', data.message);
            
            // Hide/disable the enroll button for this course
            $button.hide();
            
            // Update the Enrolled Courses list dynamically
            loadEnrolledCourses();
            loadAvailableCourses();
        } else {
            showBootstrapAlert('danger', 'Error', data.message);
            // Re-enable button
            $button.prop('disabled', false);
            $button.html(originalText);
        }
    })
    .fail(function(xhr, status, error) {
        console.error('Error enrolling in course:', error);
        showBootstrapAlert('danger', 'Error', 'Failed to enroll. Please try again.');
        // Re-enable button
        $button.prop('disabled', false);
        $button.html(originalText);
    });
}

// Original fetch-based enrollment function (kept for compatibility)
function enrollInCourse(courseId) {
    const button = document.getElementById(`enroll-btn-${courseId}`);
    const originalText = button.innerHTML;
    
    // Disable button and show loading
    button.disabled = true;
    button.innerHTML = '<i class="bi bi-hourglass-split"></i> Enrolling...';
    
    fetch('<?= site_url('course/enroll') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: `course_id=${courseId}&${getCSRFToken()}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            showToast('success', 'Success!', data.message);
            // Reload both sections
            loadEnrolledCourses();
            loadAvailableCourses();
        } else {
            showToast('error', 'Error', data.message);
            // Re-enable button
            button.disabled = false;
            button.innerHTML = originalText;
        }
    })
    .catch(error => {
        console.error('Error enrolling in course:', error);
        showToast('error', 'Error', 'Failed to enroll. Please try again.');
        // Re-enable button
        button.disabled = false;
        button.innerHTML = originalText;
    });
}

// Cancel enrollment
function cancelEnrollment(courseId) {
    if (!confirm('Are you sure you want to withdraw from this course?')) {
        return;
    }
    
    fetch('<?= site_url('course/cancelEnrollment') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: `course_id=${courseId}&${getCSRFToken()}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            showToast('success', 'Success!', data.message);
            // Reload both sections
            loadEnrolledCourses();
            loadAvailableCourses();
        } else {
            showToast('error', 'Error', data.message);
        }
    })
    .catch(error => {
        console.error('Error canceling enrollment:', error);
        showToast('error', 'Error', 'Failed to withdraw. Please try again.');
    });
}

// Show toast notification
function showToast(type, title, message) {
    const toastContainer = document.querySelector('.toast-container');
    const toastId = 'toast-' + Date.now();
    
    const toastHtml = `
        <div class="toast" id="${toastId}" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-${type === 'success' ? 'success' : 'danger'} text-white">
                <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                <strong class="me-auto">${title}</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                ${message}
            </div>
        </div>
    `;
    
    toastContainer.insertAdjacentHTML('beforeend', toastHtml);
    
    const toastElement = document.getElementById(toastId);
    const toast = new bootstrap.Toast(toastElement, { delay: 5000 });
    toast.show();
    
    // Remove toast element after it's hidden
    toastElement.addEventListener('hidden.bs.toast', function() {
        toastElement.remove();
    });
}

// Utility functions
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });
}

// Show Bootstrap alert message
function showBootstrapAlert(type, title, message) {
    const alertId = 'alert-' + Date.now();
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" id="${alertId}" role="alert">
            <strong>${title}:</strong> ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    
    // Add alert to the top of the content wrapper
    $('.content-wrapper').prepend(alertHtml);
    
    // Auto-remove alert after 5 seconds
    setTimeout(function() {
        $(`#${alertId}`).alert('close');
    }, 5000);
}

function getCSRFToken() {
    // Get CSRF token from meta tag or form
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                  document.querySelector('input[name="csrf_hash"]')?.value || '';
    return `csrf_hash=${token}`;
}

function getCSRFTokenValue() {
    // Get CSRF token value only (for jQuery)
    return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
           document.querySelector('input[name="csrf_hash"]')?.value || '';
}
</script>
</body>
</html>
