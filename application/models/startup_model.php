<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Startup_model extends My_Model {

	function get_startup()
	{
		$service_url = $this->config->item('api_server') . "/prod/startup";
		
		$json_content = file_get_contents($service_url);
		
		$json = json_decode($json_content);
	
		return $json->response;
	}

}
