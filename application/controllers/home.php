<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		$this->load->model("Article_model");
		$this->load->model("Startup_model");
		$article_result = $this->Article_model->get_list();
		$startup_result = $this->Startup_model->get_startup();

		$article_list = array();
		foreach($article_result->results as $artobj)
		{
			$cover_image = "";
			if(isset($artobj->data->{'article.listfeaturedimage'}))
				$cover_image = $artobj->data->{'article.listfeaturedimage'}->value->main->url;

			$cover_video = "";
			if(isset($artobj->data->{'article.listfeaturedvideo'}))
				$cover_video = $artobj->data->{'article.listfeaturedvideo'}->value[0]->text;


			if($cover_image == "" && $cover_video == "")
				continue;

			$article = array(
				'id' => $artobj->id,
				'cover_image' => $cover_image,
				'cover_video' => $cover_video,
				'slug' => $artobj->slug,
			);

			$article_list[] = $article;
		}


		$insert_list = array();
		foreach($startup_result->categories as $cat)
		{
			if($cat->name == "WEATHER")
			{
				$article = array(
					'widget_url' => $cat->widget_url,
					'action_url' => $cat->action_url
				);

				$insert_list[] = $article;
			}
			else if($cat->name == "TRAFFIC")
			{
				$article = array(
					'widget_url' => $cat->widget_url,
					'action_url' => $cat->action_url
				);
				$insert_list[] = $article;
			}
		}

		//insert weather widget
		if(count($insert_list) > 0)
		{
			if(count($article_list) > 3)
				array_splice( $article_list, 2, 0, $insert_list);
			else
				$article_list = array_merge($article_list, $insert_list);
		}

		$view_data = array(
			'partial_view' => "view_home",
			'article_list' => $article_list,
		);

		$this->load_view('view_master', $view_data);
	}


}
