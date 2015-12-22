<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends MY_Controller {	

	private $_article = null;

	private $scratch_card_counter = 0,
		$slider_counter = 0,
		$preview = false;	

	public function frame($type) {
		$index = (int)$this->input->get('index');
		$this->_article = $this->session->userdata('current_article');
		if (empty($this->_article))
			return;
		
		$this->_article = unserialize($this->_article);
                switch ($type) {
			case 'slider':
				$slider = @$this->_article['article.sliders']['value'][$index];
		
				if (empty($slider))
					return;

				$this->load->view('widgets/view_iframe', array('type' => $type, 'index' => $index, 'slider'=> $slider));	
			break;
			case 'scratch_card':
				$scratch_card = @$this->_article['article.scratchcards']['value'][$index];
		
				if (empty($scratch_card))
					return;

				$this->load->view('widgets/view_iframe', array('type' => $type, 'index' => $index, 'scratch_card'=> $scratch_card));	
			break;
		}
	}

	public function preview($article_id) {
		$this->preview = true;
		$this->view($article_id, '');
	}

	public function view($article_id, $title)
	{
		$this->inapp = @($_GET['inapp']==1);
		$this->load->model("Article_model");

		$article_result = $this->Article_model->get_detail($article_id, true, $this->preview);
		
		if ($this->preview && $article_result)
			$article_result = array(
				'results' => array($article_result)
			);	

		$startup = $this->startup();

		if(count($article_result['results']) == 0)
		{
			show_404();
			die();
		}
	
		$this->_article = (array)$article_result['results'][0];
		$this->session->set_userdata('current_article', serialize(array(
			'id' => $this->_article['id'],
			'article.title' => @$this->_article['data']['article.title'],
			'article.sliders' => @$this->_article['data']['article.sliders'],
			'article.scratchcards' => @$this->_article['data']['article.scratchcards'],
		)));
		
		$category = $this->category_lookup($startup['categories'], @$this->_article['data']['article.category']['value']);		

		$view_data = array(
			'partial_view' => "view_article",
			'category' => $category,
			'featured_image' => ($this->inapp ? null : @$this->_article['data']['article.featuredimage']['value']['main']['url']),
			'featured_video' => ($this->inapp ? null : str_replace('.mp4', '.gif', @$this->_article['data']['article.featuredvideo']['value'][0]['text'])),
			'article' => $this->_article,
			'article_content' => $this->_render_content(),
			'pub_date' => @$this->_article['data']['article.date']['value'] ? date('F d, Y h:ma', strtotime($this->_article['data']['article.date']['value'])) : '',
		);

		$this->load_view('view_master', $view_data);
	}

	// render article content 
	private function _render_content() {
		$rendered_content = '';
		foreach ($this->_article['data']['article.content']['value'] as $block) :
			if ($block['type'] == 'paragraph') :
				$rendered_content .= $this->_render_para($block);
			elseif ($block['type'] == 'embed') :
				$rendered_content .= preg_replace('/width="[0-9]+"/', 'width="100%"', $block['oembed']['html']);
			elseif ($block['type'] == 'image') :
				$rendered_content .= $this->load->view('widgets/view_image', array('image' => $block['url'], 'image2x' => $block['url']), true);
			endif;
		endforeach;
		return $rendered_content;
	}

	// render paragraph 
	private function _render_para($block) {
		$_rendered_content = '';
		switch (@$block['label']) {
			case 'instagram_quote':
				$_rendered_content .= $this->load->view('widgets/view_instagram_quote', $block, true);			
			break;
			case 'twitter_quote':
				$_rendered_content .= $this->load->view('widgets/view_twitter_quote', $block, true);			
			break;
			case 'image_gallery':
				$_rendered_content .= $this->load->view('widgets/view_image_gallery', array('gallery' => $this->_article['data']['article.gallery']['value']), true);
				break;
			case 'scratch_card':
				$scratch_card = $this->_article['data']['article.scratchcards']['value'][$this->scratch_card_counter];
				if ($scratch_card)
					$_rendered_content .= $this->load->view('widgets/view_scratch_card', array('index' => $this->scratch_card_counter, 'scratch_card' => $scratch_card), true);	
				$this->scratch_card_counter++;
			break;
			case 'slider':
				$slider = @$this->_article['data']['article.sliders']['value'][$this->slider_counter];
				if ($slider) 
					$_rendered_content .= $this->load->view('widgets/view_slider', array('index' => $this->slider_counter, 'slider' => $slider), true);	
				
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
			return preg_replace('/data-width="[0-9]+"/', 'data-width="100%"', $block['text']);
			//return $block['text'];
		endif;
	}
	
}
