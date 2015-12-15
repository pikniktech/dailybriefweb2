<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	protected function load_view($master_view_name, $view_data)
	{
		//$view_data['language'] = $this->language;

		//$view_data['error_list'] = $this->error_messages;
		//$view_data['message_list'] = $this->system_messages;


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