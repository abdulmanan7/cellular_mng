<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migrate extends CI_Controller {
  function __construct() {
      parent::__construct();
    if ( ! $this->input->is_cli_request() ) {
          echo 'Only access via command line.';
	      exit;    
	  }
    $this->load->library('migration');  
  }    
  public function index() {
	     if ( ! $this->migration->current())
        {
          show_error($this->migration->error_string());
        }
	}
  public function current() {    
  	if ( ! $this->migration->current()) {      
  		show_error($this->migration->error_string());    
  	}          
  }
  public function latest() {    
  	if ( ! $this->migration->latest()) {    
  		show_error($this->migration->error_string()). PHP_EOL;  
  	}        
  } 
  public function reset() {    
    if (!$this->migration->version(0)) {
    show_error($this->migration->error_string()). PHP_EOL;
    }
  	$this->migration->error_string() . PHP_EOL;     
  }    
  public function version($version = 0) {    
  $version = (int) $version;
  if ($version== 0) {
    die("You need to pass a version greater then zero. ") . PHP_EOL;
  }
  $this->migration->version($version);
  echo $this->migration->error_string() . PHP_EOL;
} 
}