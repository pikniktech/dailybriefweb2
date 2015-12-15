<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Traffic extends MY_Controller {

	public function index()
	{
		$view_data = array(
			'partial_view' => "view_traffic"
		);

		$this->load_view('view_master', $view_data);
	}
}
