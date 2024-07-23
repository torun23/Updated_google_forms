<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['forms'] = 'home/index4';

$route['responses/list/(:num)'] = 'Response_submit/list_responses/$1';
$route['responses/view/(:num)'] = 'Response_submit/viewresponse/$1';
$route['publish/(:num)'] = 'forms/preview/$1';
$route['default_controller'] = 'Form_controller/index_forms';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['start'] = 'Form_controller/index_forms';
// $route['new_form'] = 'home/create_form';
$route['title_desc'] = 'homepage/title';
$route['forms/delete/(:any)'] = 'Form_controller/delete/$1';
$route['home'] = 'Form_controller/index_forms';
$route['published_forms'] = 'Publish_controller/list_user_published_forms';
$route['drafts'] = 'Form_controller/index_forms_draft';

$route['edit/(:num)'] = 'Form_controller/edit_form/$1';

$route['form_preview/(:num)'] = 'forms/preview_back/$1';
$route['responses/(:num)'] = 'Response_submit/view_responses/$1';
$route['designform'] = 'homepage/design_form';
$route['response_preview/(:num)'] = 'forms/response_preview/$1';

$route['title'] = 'homepage/title';

