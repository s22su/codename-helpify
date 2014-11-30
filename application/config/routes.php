<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';

$route['migrate/current'] = "migrate/current";
$route['migrate/latest'] = "migrate/latest";
$route['migrate/version/(:num)'] = "migrate/version/$1";

// Auth request
$route['auth/need-help'] = "facebook_controller/authentication";
// Callback
$route['facebook'] = 'facebook_controller/callback';

$route['auth/do-help'] = "facebook_controller/authentication";

$route['need-help'] = "helprequest/add";
$route['do-help'] = "do_help_controller/do_help";

$route['logout'] = 'facebook_controller/logout';

// functional routes
$route['about'] = "home/about";
$route['helprequest'] = "helprequest/index";
$route['my_helprequests'] = "helprequest/my_helprequests";
$route['helprequest/(:num)/notify'] = "helprequest/notify";

$route['helper/(:num)'] = 'helper_profile_controller/view';
$route['et'] = 'home/et';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
