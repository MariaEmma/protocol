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
$route['backend/suser/store/(:any)/(:num)'] = "suserfiles/store/$1/$2";
$route['backend/suser/delete/(:num)'] = "suserfiles/delete/$1";
$route['backend/suser/output/(:num)'] = "suserfiles/output/$1";
$route['backend/suser/upload/(:num)'] = "suserfiles/upload/$1";
$route['backend/suser/input/(:num)'] = "suserfiles/input/$1";
$route['backend/suser/archive/(:num)'] = "suserfiles/archive/$1";

$route['backend/vicepresident/store/(:any)/(:num)'] = "vicepresfiles/store/$1/$2";
$route['backend/vicepresident/delete/(:num)'] = "vicepresfiles/delete/$1";
$route['backend/vicepresident/output/(:num)'] = "vicepresfiles/output/$1";
$route['backend/vicepresident/upload/(:num)'] = "vicepresfiles/upload/$1";
$route['backend/vicepresident/input/(:num)'] = "vicepresfiles/input/$1";
$route['backend/vicepresident/archive/(:num)'] = "vicepresfiles/archive/$1";

$route['backend/president/edit/(:num)'] = "presfiles/edit/$1";
$route['backend/president/output'] = "presfiles/output";
$route['backend/president/input'] = "presfiles/input";

$route['backend/protocol/delete/(:num)'] = "protfiles/delete/$1";
$route['backend/protocol/edit/(:num)'] = "protfiles/edit/$1";
$route['backend/protocol/output/(:num)'] = "protfiles/output/$1";
$route['backend/protocol/input/(:num)'] = "protfiles/input/$1";
$route['backend/protocol/send/(:any)/(:num)'] = "protfiles/send/$1/$2";

$route['backend/gram/delete/(:num)'] = "gramfiles/delete/$1";
$route['backend/gram/upload/(:num)'] = "gramfiles/upload/$1";
$route['backend/gram/certified/(:num)'] = "gramfiles/certified/$1";
$route['backend/gram/myown/(:num)'] = "gramfiles/myown/$1";

$route['backend/user/activate/(:num)'] = "users/activate/$1";
$route['backend/user/deactivate/(:num)'] = "users/deactivate/$1";
$route['backend/user/delete/(:num)'] = "users/delete/$1";
$route['backend/user/update/(:num)'] = "users/update/$1";
$route['backend/user/changepass/(:num)'] = "users/changepass/$1";
$route['backend/user/new'] = "users/addnew";
$route['backend/admin'] = "users/index";

$route['backend/category/delete/(:num)'] = "categories/delete/$1";
$route['backend/category/update/(:num)'] = "categories/update/$1";
$route['backend/category/new'] = "categories/addnew";
$route['backend/category'] = "categories/index";

$route['backend/logout'] = "admin/logout";
$route['backend'] = "admin/login";
$route['default_controller'] = "admin/login";
$route['404_override'] = 'admin/show404';

/* End of file routes.php */
/* Location: ./application/config/routes.php */