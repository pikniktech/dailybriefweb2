<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends MY_Controller {	

	private $scratch_card_counter = 0,
		$slider_counter = 0,
		$preview = false,
		$is_webview = false,
		$fullscreen = false; // if there is any fullscreen element, remove the title and tags 	

	public function frame($type, $article_id) {
		$index = (int)$this->input->get('index');
		$this->load->model("Article_model");
	
		if ($this->input->get('preview') == 1)
			$this->preview = true;
	
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

	public function preview2($article_id) {
		$this->preview = true;
		$this->view($article_id, '');
	}

	public function preview($article_id, $title) {
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
		if(substr($title, 0, 9)  == "_webview_" || $this->input->get('inapp') == 1)
			$is_webview = true;
		
		// check whether video_on_cover is ON
		$featured_video_gallery = '';
		if (@$article['data']['article.video_on_cover']['value'] == 'yes' && !$this->inapp) {
			$featured_video_gallery = $this->load->view('widgets/view_video_gallery_fullscreen', array('gallery' => @$article['data']['article.video_gallery']['value']), true);
		}
		
		$view_data = array(
			'partial_view' => "view_article_full", //$layout ? "view_article" : "view_article_full",
			'category' => $category,
			'featured_image' => ($this->inapp ? null : @$article['data']['article.featuredimage']['value']['main']['url']),
			'featured_video' => ($this->inapp ? null : str_replace('.mp4', '.gif', @$article['data']['article.featuredvideo']['value'][0]['text'])),
			'featured_video_gallery' => $featured_video_gallery,
			'article' => $article,
			'article_content' => $this->_render_content($article),
			'pub_date' => @$article['data']['article.date']['value'] ? date('F d, Y h:ma', strtotime($article['data']['article.date']['value'])) : '',
			'is_webview' => $this->is_webview ? $this->is_webview : $is_webview,
			'is_mobile' => $this->agent->is_mobile(),
			'fullscreen' => $this->fullscreen,
		);

		$this->load_view('view_master', $view_data);
	}

	// render article content 
	private function _render_content($article) {
		$prev = $rendered_content = '';
		foreach (@$article['data']['article.content']['value'] as $block) :
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
		$raw_text = strtolower($text);
		if (in_array($t, $headings)) :
			return str_replace('heading', 'h', $t);
		elseif (in_array($t, array('o-list-item', 'list-item'))) :
			return 'li';
		elseif (strpos($raw_text,'<iframe') !== false) :
			return '';
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
			case 'image': 
				$_rendered_content .= $this->load->view('widgets/view_ext_image', $block, true);			
			break;
			case 'video':
				$_rendered_content .= $this->load->view('widgets/view_ext_video', $block, true);			
			break;
			case 'instagram_quote':
				$_rendered_content .= $this->load->view('widgets/view_instagram_quote', $block, true);			
			break;
			case 'twitter_quote':
				$_rendered_content .= $this->load->view('widgets/view_twitter_quote', $block, true);			
			break;
			case 'fullscreen_image_gallery':
				$_rendered_content .= $this->load->view('widgets/view_image_gallery_fullscreen', array('gallery' => $article['data']['article.gallery']['value']), true);
				if ($_rendered_content)
					$this->fullscreen = true;
			break;
			case 'fullscreen_video_gallery':
				$_rendered_content .= $this->load->view('widgets/view_video_gallery_fullscreen', array('gallery' => $article['data']['article.video_gallery']['value']), true);
				if ($_rendered_content && $article['data']['article.video_on_cover']['value'] == 'yes')
					$this->fullscreen = true;
			break;
			case 'image_gallery':
				$_rendered_content .= $this->load->view('widgets/view_image_gallery', array('gallery' => $article['data']['article.gallery']['value']), true);
				break;
			case 'scratch_card':
				$scratch_card = $article['data']['article.scratchcards']['value'][$this->scratch_card_counter];
				if ($scratch_card)
					$_rendered_content .= $this->load->view('widgets/view_scratch_card', array('index' => $this->scratch_card_counter, 'scratch_card' => $scratch_card, 'article_id' => $article['id'], 'preview' => $this->preview), true);	
				$this->scratch_card_counter++;
			break;
			case 'slider':
				$slider = $article['data']['article.sliders']['value'][$this->slider_counter];
				if ($slider)
					$_rendered_content .= $this->load->view('widgets/view_slider', array('index' => $this->slider_counter, 'slider' => $slider, 'article_id' => $article['id'], 'preview' => $this->preview), true);	
				$this->slider_counter++;
			break;
			case 'caption':
			$_rendered_content .= '<p class="caption">'.$this->_spans($block).'</p>';
			break;
			default: 
			$html_tag = $this->_tag($block['type'], $block['text']);
			$_rendered_content .= $html_tag ?'<'.$html_tag.'>'.$this->_spans($block).'</'.$html_tag.'>' : $this->_spans($block);
			
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
			return preg_replace('/width="[0-9]+"/', 'width="100%"', preg_replace('/data-width="[0-9]+"/', 'data-width="100%"', $block['text']));
			//return $block['text'];
		endif;
	}
	
}
