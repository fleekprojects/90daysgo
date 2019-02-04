<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'Home';
$route['track-your-order'] = 'Track';
$route['signup'] = 'Signup';
$route['verify/(:any)/(:any)'] = 'Signup/verify/$1/$2';
$route['change-password/(:any)'] = 'Login/changepassword/$1';
$route['change-password'] = 'ChangePassword';
$route['login'] = 'Login/login';
$route['forgot'] = 'Login/fpass';
$route['logout'] = 'Login/logout';
$route['dashboard'] = 'Dashboard';
$route['start-workout/(:any)/(:any)'] = 'StartWorkout/index/$1/$2';
$route['dashboard-workout/(:any)'] = 'DashboardWorkout/index/$1';
$route['thankyou'] = 'Dashboard/thankyou';
$route['thank-you'] = 'DashboardWorkout/endthankyou';
$route['workout/(:any)/(:any)'] = 'Products/index/$1/$2';
$route['cart'] = 'Cart';
$route['track-your-order/search'] = 'Track/search';
$route['how-it-works'] = 'Works';
$route['faqs'] = 'Faqs';
$route['blogs'] = 'Blogs';
$route['blog/(:any)'] = 'Blogs/detail/$1';
$route['contact-us'] = 'Contact';

/*----------------------------------- Admin Routes -----------------------------------*/
$route['admin/users'] = 'admin/Users';
$route['admin/posts'] = 'admin/Posts';
$route['admin/posts/(:any)'] = 'admin/Posts/$1';
$route['admin/posts/edit/(:any)'] = 'admin/Posts/Edit/$1';

$route['admin/faqs'] = 'admin/Faqs';
$route['admin/faqs/(:any)'] = 'admin/Faqs/$1';

$route['admin/contact-queries'] = 'admin/Contactus';

$route['admin/orders'] = 'admin/Orders';

$route['admin/promocode'] = 'admin/PromoCode';

$route['admin/parents'] = 'admin/Parents';
$route['admin/parents/(:any)'] = 'admin/Parents/$1';

$route['admin/courses'] = 'admin/Courses';
$route['admin/courses/(:any)'] = 'admin/Courses/$1';

$route['admin/courseimages/addimages'] = 'admin/CourseImage/addFeatureRow';
$route['admin/courseimages/(:any)'] = 'admin/CourseImage/index/$1';

$route['admin/courseweeks/(:any)'] = 'admin/CourseWeeks/index/$1';
$route['admin/add-course-week/(:any)'] = 'admin/CourseWeeks/AddCourseWeek/$1';

$route['admin/courseplans/(:any)'] = 'admin/CoursePlans/$1';
$route['admin/courseplans/(:any)/(:any)'] = 'admin/CoursePlans/index/$1/$2';

$route['admin'] = 'admin/Admin';
$route['admin/(:any)'] = 'admin/Admin/$1';
/*----------------------------------- Admin Routes -----------------------------------*/


$route['(:any)'] = 'Blogs/page/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
