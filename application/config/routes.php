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
$route['default_controller'] = 'home';
$route['404_override'] = 'helptool/page_404';
$route['translate_uri_dashes'] = FALSE;

$route['404'] = 'helptool/page_404';

$route['sitemap\.xml'] = "sitemap";
$route['sitemap_board_([a-zA-Z0-9_-]+)\.xml'] = "sitemap/board/$1";
$route['sitemap_product_([a-zA-Z0-9_-]+)\.xml'] = "sitemap/product/$1";
$route['sitemap_about.xml'] = "sitemap/about";
$route['rss'] = "sitemap/rss";

$route['products/eur'] = "euro/lists/eur";
$route['products/eur/(:any)'] = "euro/lists/eur/$1";
$route['products/eur/(:any)/(:num)'] = "euro/view/eur/$1/$2";
$route['products/eur/(:any)/(:num)/(:num)'] = "euro/view/eur/$1/$2/$3";
$route['products/oth/duba'] = "euro/lists/oth/duba";
$route['products/oth/duba/(:num)'] = "euro/view/oth/duba/$1";
$route['products/oth/duba/(:num)/(:num)'] = "euro/view/oth/duba/$1/$2";

$route['products/mailform'] = 'products/mailform';
$route['products/gallery/(:num)']= 'products/gallery/$1';
$route['products/(:any)'] = 'products/lists/$1';
$route['products/(:any)/(:any)']= 'products/lists/$1/$2';
$route['products/(:any)/(:any)/(:num)']= 'products/view/$1/$2/$3';
$route['products/(:any)/(:any)/(:num)/(:num)']= 'products/view/$1/$2/$3/$4';

$route['recommend'] = 'products/recommend';

$route['counseling/(:any)'] = "counseling/form/$1";

$route['board/comment_delete'] = "board/comment_delete";
$route['board/(:any)'] = "board/lists/$1";
$route['board/(:any)/(:num)'] = "board/view/$1/$2";
$route['board/(:any)/write'] = "board/write/$1";
$route['board/(:any)/(:num)/edit'] = "board/write/$1/$2";
$route['board/(:any)/reply/(:num)'] = "board/reply/$1/$2";
$route['board/(:any)/password/(:num)'] = "board/password/$1/$2";
$route['board/(:any)/download/(:num)'] = "board/download/$1/$2";
$route['board/(:any)/delete/(:num)'] = "board/delete/$1/$2";
$route['board/(:any)/comment'] = "board/comment/$1";
