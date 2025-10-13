<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');

//$routes->get('home', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');

$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::register');

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login');

$routes->get('logout', 'Auth::logout');
$routes->get('/dashboard', 'Auth::dashboard');

$routes->get('admin/dashboard', 'Admin::dashboard');
$routes->get('teacher/dashboard', 'Teacher::dashboard');
$routes->get('student/dashboard', 'Student::dashboard');

// Course enrollment routes
$routes->post('course/enroll', 'Course::enroll');
$routes->get('course/myEnrollments', 'Course::myEnrollments');
$routes->get('course/available', 'Course::available');
$routes->post('course/cancelEnrollment', 'Course::cancelEnrollment');
$routes->get('course/enrollmentStats', 'Course::enrollmentStats');
