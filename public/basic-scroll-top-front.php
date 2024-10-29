<?php
class Basic_scrolltop_public {
	public function __construct() {
	    add_action( 'wp_enqueue_scripts', array( $this, 'basic_scrolltop_scripts' ));
		add_action( 'wp_footer', array( $this, 'basic_scroll_top_button' ));
	}
	
  	public function basic_scrolltop_scripts() {
	    $scroll_enable = get_option('scroll_enable');
	    if($scroll_enable[0] == 'yes')
	    {
	    	wp_enqueue_script( 'basic_scroll_top', BASIC_SCROLLTOP_URL . 'public/js/basic-scroll-top.js', array('jquery'), BASIC_SCROLLTOP_VERSION, true );
		    // now the most interesting part
		    // we have to pass parameters to basic-scroll-top.js script but we can get the parameters values only in PHP
		    // you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
		    wp_localize_script( 'basic_scroll_top', 'basic_scrolltop_params', array(
		        'duration' => get_option('scroll_duration') ? get_option('scroll_duration') : '500',
		        'scroll_offset' => get_option('scroll_offset') ? get_option('scroll_offset') : '200',
		    	) );
		    wp_register_style( 'basic-scroll-css', BASIC_SCROLLTOP_URL . 'public/css/basic-scroll-top.css', array(), BASIC_SCROLLTOP_VERSION );
	        wp_enqueue_style( 'basic-scroll-css' );
        }
    }
	public function basic_scroll_top_button()
	{	
		 $scroll_enable = get_option('scroll_enable'); 
		if($scroll_enable[0] == 'yes')
		{
			$position = get_option('scroll_position');
			$position_margin = get_option('scroll_right_margin');
			$btm_margin = get_option('scroll_bottom_margin');
			$scroll_size_num = get_option('scroll_size');
			$scroll_bg = get_option('scroll_button_bgcolor');
			$scroll_color = get_option('scroll_button_color');
			$scroll_text = get_option('scroll_text');
			$scroll_type = get_option('scroll_type');
			$line_height = __('line-height: 45px;');
			$scroll_size = __(' width: 50px; height: 50px; ');
			if ($position_margin == '') {$position_margin = '10';}
			if($position[0] != ''){$position =  $position[0] .': ' . $position_margin .'px;';}
			if($btm_margin != ''){$btm_margin =  'bottom: ' . $btm_margin .'px;';}
			if($scroll_size_num != ''){$scroll_size =  'width: ' . $scroll_size_num .'px;' . 'height: ' . $scroll_size_num .'px;';}
			if($scroll_bg != ''){$scroll_bg =  'background: ' . $scroll_bg .';';}
			if($scroll_color != ''){$scroll_color =  'color: ' . $scroll_color .';';}
			if($scroll_text == '') {$scroll_text ="Top"; }
			if($scroll_size_num != ''){ 
				$count_lineheight = $scroll_size_num - 5; 
				$line_height = 'line-height: '.$count_lineheight.'px;'; 
			}
			if($scroll_type[0] == 'text' || $scroll_type[0] == '')
			{
				printf('<div id="basic-scrolltop-button" style="%1$s %2$s %3$s %4$s %5$s %7$s" title="Go to top">%6$s</div>', $position, $btm_margin, $scroll_size, $scroll_bg, $scroll_color, $scroll_text, $line_height );
			}
			else{
				$scroll_image = get_option('scroll_image');
				if($scroll_image == ''){
					$scroll_image = BASIC_SCROLLTOP_URL .'public/images/scroll-icon.png';
				}
				$scroll_bg = 'background: none;';
				printf('<div id="basic-scrolltop-button" style="%2$s %3$s %4$s %5$s"><img src="%1$s" alt="Go to top" title="Go to top"/></div>', $scroll_image, $scroll_bg, $scroll_size, $position, $btm_margin);
			}
				
		}
	}
}
new Basic_scrolltop_public();
?>