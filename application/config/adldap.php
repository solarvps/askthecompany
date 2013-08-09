<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['account_suffix']	= '@mycompany.com';
$config['base_dn']		= 'DC=mycompany,DC=lan';
$config['domain_controllers']	= array ("ad01.mycompany.com");
$config['real_primarygroup']	= true;
$config['use_ssl']		= false;
$config['use_tls'] 		= false;
$config['recursive_groups']	= true;


/* End of file adldap.php */
/* Location: ./system/application/config/adldap.php */
