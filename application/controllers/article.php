<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends MY_Controller {	

	private $scratch_card_counter = 0, $slider_counter = 0;	

	public function frame($type, $article_id) {
		$index = (int)$this->input->get('index');
		$this->load->model("Article_model");
		
		$article_result = $this->Article_model->get_detail($article_id, true);
		
		if(count($article_result['results']) == 0)
			return;
		
		$article = $article_result['results'][0]['data'];
		
        switch ($type) {
			case 'slider':
				$slider = @$article['article.sliders']['value'][$index];
		
				if (empty($slider))
					return;

				$this->load->view('widgets/view_iframe', array('type' => $type, 'index' => $index, 'slider'=> $slider));	
			break;
			case 'scratch_card':
				$scratch_card = @$article['article.scratchcards']['value'][$index];
		
				if (empty($scratch_card))
					return;

				$this->load->view('widgets/view_iframe', array('type' => $type, 'index' => $index, 'scratch_card'=> $scratch_card));	
			break;
		}
	}

	public function view($article_id, $title)
	{
		$this->inapp = @($_GET['inapp']==1);
		$this->load->model("Article_model");
		
		$article_result = $this->Article_model->get_detail($article_id, true);
		
		$startup = $this->startup();

		if(count($article_result['results']) == 0)
		{
			show_404();
			die();
		}
	
		$article = (array)$article_result['results'][0];
		
		$category = $this->category_lookup($startup['categories'], @$article['data']['article.category']['value']);		

		$is_webview = false;
		if($title == "_webview_")
			$is_webview = true;
		
		$view_data = array(
			'partial_view' => "view_article",
			'category' => $category,
			'featured_image' => ($this->inapp ? null : @$article['data']['article.featuredimage']['value']['main']['url']),
			'featured_video' => ($this->inapp ? null : str_replace('.mp4', '.gif', @$article['data']['article.featuredvideo']['value'][0]['text'])),
			'article' => $article,
			'article_content' => $this->_render_content($article),
			'pub_date' => @$article['data']['article.date']['value'] ? date('F d, Y h:ma', strtotime($article['data']['article.date']['value'])) : '',
			'is_webview' => $is_webview,
		);

		$this->load_view('view_master', $view_data);
	}

	// render article content 
	private function _render_content($article) {
		$rendered_content = '';
		foreach ($article['data']['article.content']['value'] as $block) :
			if ($block['type'] == 'paragraph') :
				$rendered_content .= $this->_render_para($block, $article);
			elseif ($block['type'] == 'embed') :
				$rendered_content .= preg_replace('/width="[0-9]+"/', 'width="100%"', $block['oembed']['html']);
			elseif ($block['type'] == 'image') :
				$rendered_content .= $this->load->view('widgets/view_image', array('image' => $block['url'], 'image2x' => $block['url']), true);
			endif;
		endforeach;
		return $rendered_content;
	}

	// render paragraph 
	private function _render_para($block, $article) {
		$_rendered_content = '';
		switch (@$block['label']) {
			case 'instagram_quote':
				$_rendered_content .= $this->load->view('widgets/view_instagram_quote', $block, true);			
			break;
			case 'twitter_quote':
				$_rendered_content .= $this->load->view('widgets/view_twitter_quote', $block, true);			
			break;
			case 'image_gallery':
				$_rendered_content .= $this->load->view('widgets/view_image_gallery', array('gallery' => $article['data']['article.gallery']['value']), true);
				break;
			case 'scratch_card':
				$scratch_card = $article['data']['article.scratchcards']['value'][$this->scratch_card_counter];
				$_rendered_content .= $this->load->view('widgets/view_scratch_card', array('index' => $this->scratch_card_counter, 'scratch_card' => $scratch_card, 'article_id' => $article['id']), true);	
				$this->scratch_card_counter++;
			break;
			case 'slider':
				$slider = $article['data']['article.sliders']['value'][$this->slider_counter];
				$_rendered_content .= $this->load->view('widgets/view_slider', array('index' => $this->slider_counter, 'slider' => $slider, 'article_id' => $article['id']), true);	
				$this->slider_counter++;
			break;
			default: 
			$_rendered_content .= '<p>'.$this->_spans($block).'</p>';
		}
		return $_rendered_content;
	}

	private function u_substr_replace($str, $replace, $start, $length) {
		$len = mb_strlen($str, 'utf-8');
		$str1 = mb_substr($str, 0, $start, 'utf-8');
		$str2 = mb_substr($str, $start+$length, $len, 'utf-8');  	
		return $str1.$replace.$str2;
	}


	// add span to text 
	private function _spans($block) {
		if ($block['spans']) :
			$text = $block['text'];
			$replace = $placement = array();
			$offset = 0;
			foreach ($block['spans'] as $k => $span) :
				$replace[] = $r = '{{REPLACE'.$k.'}}';
				$text = $this->u_substr_replace($text, $r, $span['start']+$offset, ($span['end']-$span['start']));
				$offset += (strlen($r) - ($span['end']-$span['start']));
				if ($span['type'] == 'hyperlink' && $span['data']['type'] == 'Link.document') :
					$placement[] = 	'<a href="/'.$this->article_url($span['data']['value']['document']['id'], $span['data']['value']['document']['slug']).'" target="_blank">'.mb_substr($block['text'], $span['start'], $span['end']-$span['start'], 'utf-8').'</a>';
				elseif ($span['type'] == 'hyperlink' && $span['data']['type'] == 'Link.web'):
					$placement[] = 	'<a href="'.$span['data']['value']['url'].'" target="_blank">'.mb_substr($block['text'], $span['start'], $span['end']-$span['start'], 'utf-8').'</a>';
				else:
					$placement[] = '<'.$span['type'].'>'.mb_substr($block['text'], $span['start'], $span['end']-$span['start'], 'utf-8').'</'.$span['type'].'>';
				endif;
			endforeach;
			return str_replace($replace, $placement, $text);
		else:	
			return $block['text'];
		endif;
	}
	
}
