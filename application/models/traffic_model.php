<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Traffic_model extends My_Model {
	
	function get_cam_full_list()
	{
		$service_url = $this->config->item('api_server') . "/prod/traffic?action=list";
		
		$json_content = file_get_contents($service_url);
		
		$json = json_decode($json_content);
		
		return $json->features;
	}
	
	function get_district_list()
	{
		$cam_full_list = $this->get_cam_full_list();
		
		$district_list = array();
		foreach($cam_full_list as $cam)
		{
			$district_name = $cam->properties->district;
			
			if(!in_array($district_name, $district_list))
				$district_list[] = $district_name;
		}
		
		return $district_list;
	}
	
	function get_cam_by_lnglat($lng, $lat)
	{
		$service_url = $this->config->item('api_server') . "/prod/traffic?action=search&lnglat=" . $lng . "," . $lat;
		$json_content = file_get_contents($service_url);
		
		$json = json_decode($json_content);
		
		return $json;
	}
}