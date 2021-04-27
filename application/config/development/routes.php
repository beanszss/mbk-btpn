<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(in_array($_SERVER['REMOTE_ADDR'], $this->config->item('maintenance_ips')) || $this->config->item('maintenance_mode')){
    $route['default_controller'] = "mode/maintenance";
    $route['(:any)(.*)'] = "mode/maintenance";
}else{
    $route['default_controller'] = 'admin';
    // $route['admin'] = 'auth';
    $route['404_override'] = '';
    $route['translate_uri_dashes'] = FALSE;
}
