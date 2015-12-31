<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends MY_Controller {	

	private $scratch_card_counter = 0,
		$slider_counter = 0,
		$preview = true;	

	public function frame($type, $article_id) {
		$index = (int)$this->input->get('index');
		$this->load->model("Article_model");
		
		$article_result = $this->Article_model->get_detail($article_id, true, $this->preview);

		if((!$this->preview && count($article_result['results']) == 0) || ($this->preview && empty($article_result)))
			return;

		$article = $this->preview ? $article_result['data'] : $article_result['results'][0]['data'];
		
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

	public function preview($article_id) {
		$this->preview = true;
		$this->view($article_id, '');
	}

	public function preview2($article_id) {
		$this->preview = true;
		$this->view($article_id, '', false);
	}

	public function view($article_id, $title, $layout=true)
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
	
		$article = (array)$article_result['results'][0];
		$category = $this->category_lookup($startup['categories'], @$article['data']['article.category']['value']);		

		$is_webview = false;
		if($title == "_webview_")
			$is_webview = true;
		
		$view_data = array(
			'partial_view' => $layout ? "view_article" : "view_article_test",
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
		$prev = $rendered_content = '';
		foreach ($article['data']['article.content']['value'] as $block) :
			if ($prev == 'o-list-item' && !in_array($block['type'], array('o-list-item')))
				$rendered_content .= '</ol>';
			elseif ($prev == 'list-item' && !in_array($block['type'], array('list-item')))
				$rendered_content .= '</ul>';
			if ($block['type'] == 'paragraph') :
				$rendered_content .= $this->_render_para($block, $article);
			elseif ($block['type'] == 'embed') :
				$rendered_content .= preg_replace('/width="[0-9]+"/', 'width="100%"', $block['oembed']['html']);
			elseif ($block['type'] == 'image') :
				$rendered_content .= $this->load->view('widgets/view_image', array('image' => $block['url'], 'image2x' => $block['url'], 'src' => $block), true);
			elseif ($block['type'] == 'o-list-item' || $block['type'] == 'list-item') :
				if ($prev != $block['type'] && $block['type'] == 'o-list-item'):
					$rendered_content .= '<ol>';
				elseif ($prev != $block['type'] && $block['type'] == 'list-item'):
					$rendered_content .= '<ul>';
				endif;
				$rendered_content .= $this->_render_para($block, $article);
			else:
				$rendered_content .= $this->_render_para($block, $article);
			endif;
			$prev = $block['type'];
		endforeach;
		return $rendered_content;
	}
	
	private function _tag($t, $text='') {
		$headings = array();
		for($i=1; $i<=6; $i++)
			$headings[] = 'heading'.$i;
		
		if (in_array($t, $headings)) :
			return str_replace('heading', 'h', $t);
		elseif (in_array($t, array('o-list-item', 'list-item'))) :
			return 'li';
		else:
			return 'p';
		endif;
		//return (in_array($t, $headings) ? str_replace('heading', 'h', $t) : 
		//	in_array($t, array('o-list-item', 'list-item')) ? 'li' : 'p');
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
				if ($scratch_card)
					$_rendered_content .= $this->load->view('widgets/view_scratch_card', array('index' => $this->scratch_card_counter, 'scratch_card' => $scratch_card, 'article_id' => $article['id']), true);	
				$this->scratch_card_counter++;
			break;
			case 'slider':
				$slider = $article['data']['article.sliders']['value'][$this->slider_counter];
				if ($slider)
					$_rendered_content .= $this->load->view('widgets/view_slider', array('index' => $this->slider_counter, 'slider' => $slider, 'article_id' => $article['id']), true);	
				$this->slider_counter++;
			break;
			case 'caption':
			$_rendered_content .= '<p class="caption">'.$this->_spans($block).'</p>';
			break;
			default: 
			$html_tag = $this->_tag($block['type'], $block['text']);
			$_rendered_content .= '<'.$html_tag.'>'.$this->_spans($block).'</'.$html_tag.'>';
			
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
