<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_model extends My_Model {

	function get_list() {
		$this->get_landing_list();
	}
	
	function get_landing_list()
	{
		$service_url = $this->config->item('api_server') . "/prod/list";
		
		$json_content = file_get_contents($service_url);
		
		$json = json_decode($json_content);
		
		return $json->response;
	}
	
	function get_detail($article_id, $return_array=false, $preview=false)
	{
		$service_url = $preview ? $this->config->item('preview_api_server') . $article_id : $this->config->item('api_server') . "/prod/article/" . $article_id;
		
		$json_content = file_get_contents($service_url);
		
		$json = json_decode($json_content, $return_array);
		
		return $return_array ? ($preview ? $json : $json['response']) : $json->response;
	}
}
