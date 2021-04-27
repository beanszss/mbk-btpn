<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');

/**
 *  Get notifications by per page item
 */
 $config['per_page'] = 2;

 /**
  * For By default Value specifier
  */
  $config['default_token']      = "";
  $config['default_comment']    = "";
  $config['default_type']       = "";
  $config['default_sender']     = "";
  $config['default_target']     = "";

  /**
   * Database table name
   */
  $config['notifications_table']                = "notifications";
  $config['notifications_read_tracking_table']  = "user_notifications";