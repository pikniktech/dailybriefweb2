<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

#require "predis/autoload.php";
require APPPATH.'libraries/predis/autoload.php';
# PredisAutoloader::register();
Predis\Autoloader::register();	

class MY_Controller extends CI_Controller
{
	protected $canonical = '',
		  $inapp = false,
		  $cache_server = null;

	protected function connect_cache() {
		if ($this->cache_server == null) {
			try {
				$client = $this->cache_server = new Predis\Client($this->config->item("redis"));
			} catch (Predis\Connection\ConnectionException $exception) {
			}
		}
	}
	
	protected function set_cache($k, $v) {
		if ($this->cache_server == null)
			$this->connect_cache();
		return $this->cache_server->set($k, $v);
	}

	protected function get_cache($k) {
		if ($this->cache_server == null) 
			$this->connect_cache();
		return $this->cache_server->get($k);
	}

	protected function debug($o, $exit=true) {
		echo '<pre>'; print_r($o); echo '</pre>';
		if ($exit) exit();
	}	

	// generate article url
	protected function article_url($id, $slug) {
		return join('/', array($id, $slug));
	}

	// lookup category object in startup by slug
	protected function category_lookup($categories, $category) {
		$_category = null;
		foreach ($categories as $cat) :
			if ($cat['slug'] == $category) :
				$_category = $cat;
				break;
			endif;
		endforeach;
		return $_category;
	}

	// need to cache 
	protected function startup() {
		$data = $this->get_cache('startup');
		if (empty($data) || $this->input->get('gencache') == 'startup') :
			$service_url = $this->config->item('api_server') . "/prod/startup";
			$json_content = file_get_contents($service_url);
			$json = json_decode($json_content, true);		
			$this->set_cache('startup', serialize($json['response']));
			return (array)$json['response'];
		else:
			return unserialize($data);
		endif;
	}

	protected function load_view($master_view_name, $view_data)
	{
		//$view_data['language'] = $this->language;

		//$view_data['error_list'] = $this->error_messages;
		//$view_data['message_list'] = $this->system_messages;
		$view_data['canonical'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$view_data['is_referral'] = $this->agent->is_referral();
		$view_data['is_mobile'] = $this->agent->is_mobile();
		//$view_data['is_webview'] = $this->input->get('inapp') == 1 ? true : false;
		$view_data['webview'] = $this->input->get('webview') == 1 ? true : false;
//agent->is_mobile();

		if($master_view_name == "")
			$this->load->view($view_data['partial_view'], $view_data);
		else
			$this->load->view($master_view_name, $view_data);
	}//load_view
	
	protected function response_success($data = null, $extra_headers = null)
	{

		$response = array(
			'response_code' => 0,
			'response_msg' => ''
		);

		if($data != null && count($data) > 0)
		{
			$response['data'] = $data;
		}

		if($extra_headers != null)
		{
			foreach($extra_headers as $key => $val)
			{
				$response[$key] = $val;
			}
		}

		echo json_encode($response);

	}//response_success()
	
	protected function response_error($error_msg, $error_code = 1, $exit_program = true)
	{
		$data = array(
			'response_code' => $error_code,
			'response_msg' => $error_msg,
		);

		//header('Content-type: text/html');
		echo json_encode($data);

		if($exit_program)
		{
			/*
			ob_end_flush();
			ob_flush();
			flush();
			ob_start();*/
			exit;
		}
	}//response_error()
}
