<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['forms'] = 'home/index4';

$route['responses/list/(:num)'] = 'Response_submit/list_responses/$1';
$route['responses/view/(:num)'] = 'Response_submit/viewresponse/$1';

$route['default_controller'] = 'Form_controller/index_forms';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['start'] = 'Form_controller/index_forms';
$route['new_form'] = 'home/create_form';
$route['title_desc'] = 'home/title';
$route['default_page'] = 'Form_controller/index_forms';
$route['forms/delete/(:any)'] = 'Form_controller/delete/$1';
// $route['froms_home'] = 'Form_controller/index_forms';

