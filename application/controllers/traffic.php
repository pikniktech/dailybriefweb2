<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Traffic extends MY_Controller {

	public function index()
	{
		$this->load->model("Traffic_model");
		$district_list = $this->Traffic_model->get_district_list();
		$cam_list = $this->Traffic_model->get_cam_full_list();
		
		$view_data = array(
			'partial_view' => "view_traffic",
			'district_list' => $district_list,
			'cam_list' => $cam_list,
		);

		$this->load_view('view_master', $view_data);
	}
	
	public function doGetCamByLngLat()
	{
		$lat = $this->input->get('lat');
		$lng = $this->input->get('lng');
		
		if($lat == "" || $lng == "")
			return $this->response_error("missing lat/lng");
		
		$lat = floatval($lat);
		$lng = floatval($lng);
		
		$this->load->model("Traffic_model");
		$cam = $this->Traffic_model->get_cam_by_lnglat($lng, $lat);
		
		$response = array(
			'name' => $cam->properties->name,
			'district' => $cam->properties->district,
			'image' => $cam->properties->image,
		);
		
		$this->response_success($response);
	}
}
