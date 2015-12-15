<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends MY_Controller {

	public function view($article_id)
	{

		$this->load->model("Article_model");
		$article_result = $this->Article_model->get_detail($article_id);
		
		if(count($article_result->results) == 0)
		{
			show_404();
			die();
		}
		
		$view_data = array(
			'partial_view' => "view_article",
			'article' => $article_result->results[0],
		);

		$this->load_view('view_master', $view_data);
	}
}
