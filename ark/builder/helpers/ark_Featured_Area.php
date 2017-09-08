<?php

/**
 *  ark_Featured_Area
 *
 *  @author freshface
 */

class ark_Featured_Area {

	private static $_ignore_first = false;
	private static $_gallery_is_slider = false;
	private static $last_featured_audio_html = '';

	private static $postID;
	/**
	 * @var null|WP_Query
	 */
	private static $customWPQuery = null;

	private static $_resize = 1;
	private static $_width  = 848;
	private static $_height = 477;

	/**
	 * @param int $resize
	 * @param int $width
	 * @param int $height
	 */
	public static function setSizes($resize, $width, $height){
		ark_Featured_Area::$_resize = absint( $resize );
		ark_Featured_Area::$_width  = absint( $width );
		ark_Featured_Area::$_height = absint( $height );
	}

	public static function setCustomWPQuery( WP_Query $query ){
		ark_Featured_Area::$customWPQuery = $query;
	}

	public static function get_the_ID(){
		if( empty( ark_Featured_Area::$customWPQuery ) ) {
			return get_the_ID();
		}else{
			return ark_Featured_Area::$customWPQuery->post->ID;
		}
	}

	/**
	 * @param int|object|null $postID Post ID or post object. Optional, default is the current post from the loop.
	 */
	public static function render( $postID = null, $getFeaturedImgIfEmpty = false ){
		echo ark_Featured_Area::getFeaturedArea( $postID, $getFeaturedImgIfEmpty );
	}

	/**
	 * @param int|object|null $postID Post ID or post object. Optional, default is the current post from the loop.
	 * @param bool $getFeaturedImgIfEmpty
	 *
	 * @return string The featured area string if successful. Empty string otherwise.
	 */
	public static function getFeaturedArea( $postID = null, $getFeaturedImgIfEmpty = false ){

		if( null == $postID ){
			$postID = ark_Featured_Area::get_the_ID();
			ark_Featured_Area::$postID = $postID;
		}
		ark_Featured_Area::addFeaturedAreasHooks( $postID );


		ark_Featured_Area::$_ignore_first = false;

		$html = '';
		switch ( get_post_format( $postID ) ) {
			case 'audio':
				$html = ark_Featured_Area::getFeaturedAudio( $postID );
				break;
			case 'video':
				$html = ark_Featured_Area::getFeaturedVideo( $postID );
				break;
			case 'gallery':
				ark_Featured_Area::$_gallery_is_slider = true;
				$html = get_post_gallery( $postID );
				ark_Featured_Area::$_gallery_is_slider = false;
				break;
		}

		if( ! empty( $html ) ){
			ark_Featured_Area::$_ignore_first = true;
			return
				'<div class="ff-block ff-block--blog-featured-area ff-block--blog-featured-area--'.get_post_format( $postID ).'">'
				. "\n\n"
					. $html
				. "\n\n"
				. '</div>'
			;
		}

		if ( $getFeaturedImgIfEmpty ){
			$img = ark_Featured_Area::getFeaturedImage( $postID );
			if( ! empty($img) ) {
				if( ark_Featured_Area::$_resize ) {
					if( !empty( ark_Featured_Area::$_width ) || ! empty( ark_Featured_Area::$_height ) ) {
						$img = fImg::resize($img, ark_Featured_Area::$_width, ark_Featured_Area::$_height, true);
					}
				}
				return '<img src="' . $img . '" class="img-responsive ff-post-featured-image" alt="">';
			}
		}

		return '';
	}

	public static function the_content_without_featured_area( $content = null ){
		echo ark_Featured_Area::get_the_content_without_featured_area($content);
	}

	public static function get_the_content_without_featured_area( $content = null ){

		ark_Featured_Area::$_ignore_first = true;

		if( null == $content ){
			$content = get_the_content();
		}

		$content = apply_filters( 'the_content', $content );
		$content = str_replace( ']]>', ']]&gt;', $content );

		ark_Featured_Area::$_ignore_first = false;

		if( 'audio' != get_post_format() ){
			ark_Featured_Area::$last_featured_audio_html = '';
			return $content;
		}else{
			if( '' == ark_Featured_Area::$last_featured_audio_html ){
				return $content;
			}else{
				$ret = str_replace(ark_Featured_Area::$last_featured_audio_html, '', $content);
				ark_Featured_Area::$last_featured_audio_html = '';
				return $ret;
			}
		}
	}

	public static function addFeaturedAreasHooks( $postID = null ) {
		remove_filter('wp_audio_shortcode_override', array('ark_Featured_Area', 'actionHijackFeaturedShortcode' ) );
		remove_filter('post_playlist', array('ark_Featured_Area', 'actionHijackFeaturedShortcode' ) );
		remove_filter('embed_oembed_html', array('ark_Featured_Area', 'actionHijackFeaturedShortcode' ) );
		remove_filter('wp_video_shortcode', array('ark_Featured_Area', 'actionHijackFeaturedShortcode' ) );
		remove_filter('post_gallery', array('ark_Featured_Area', 'actionHijackFeaturedShortcode' ) );

		add_filter('embed_oembed_html', array('ark_Featured_Area', 'wrapEmbeded' ) );

		if( null == $postID ){
			$postID = ark_Featured_Area::get_the_ID();
		}

		switch ( get_post_format( $postID ) ) {
			case 'audio':
				add_filter('embed_oembed_html', array('ark_Featured_Area', 'actionHijackFeaturedShortcode' ), 10, 2);
				add_filter('wp_audio_shortcode_override', array('ark_Featured_Area', 'actionHijackFeaturedShortcode' ), 10, 2);
				add_filter('post_playlist', array('ark_Featured_Area', 'actionHijackFeaturedShortcode' ), 10, 2);
				break;
			case 'video':
				add_filter('embed_oembed_html', array('ark_Featured_Area', 'actionHijackFeaturedShortcode' ), 10, 2);
				add_filter('wp_video_shortcode', array('ark_Featured_Area', 'actionHijackFeaturedShortcode' ), 10, 2);
				remove_filter('embed_oembed_html', array('ark_Featured_Area', 'wrapEmbeded' ) );
				break;
			case 'gallery':
				add_filter('post_gallery',  array('ark_Featured_Area', 'actionHijackFeaturedShortcode' ), 10, 2);
				break;
		}
	}

	/**
	 * @param int|object|null $postID Post ID or post object. Optional, default is the current post from the loop.
	 *
	 * @return string|false Featured image URL, otherwise false
	 */
	public static function getFeaturedImage( $postID = null ){
		if( null == $postID ){
			$postID = ark_Featured_Area::get_the_ID();
		}
		return wp_get_attachment_url( get_post_thumbnail_id( $postID ) );
	}

	public static function getFeaturedImageSizes(){
		$featured_size = wp_get_attachment_image_src( get_post_thumbnail_id( ark_Featured_Area::get_the_ID() ), 'full' );
		return $featured_size
			? array( $featured_size[1], $featured_size[2] )
			: array( null, null )
			;
	}

	/**
	 * @param int|object|null $postID Post ID or post object. Optional, default is the current post from the loop.
	 *
	 * @return string The featured area string if successful. Empty string otherwise.
	 */
	public static function getFeaturedAudio( $postID = null ){
		$content = get_post($postID);
		$post_content = $content->post_content;

		// Audio or playlist shortcode

		if( preg_match_all( '/' . get_shortcode_regex() . '/s', $post_content, $matches, PREG_SET_ORDER ) ) {
			foreach ( $matches as $shortcode ) {
				if( ( 'audio' === $shortcode[2] ) or ('playlist' === $shortcode[2] ) ) {
					$featured_audio = trim( do_shortcode_tag( $shortcode ) );
					if( $featured_audio ) {
						return $featured_audio;
					}
				}
			}
		}

		// Soundcloud

		$exploded_content = explode( "\n", $post_content );
		foreach( $exploded_content as $key => $value) {
			$trimmed_value = trim($value);
			if( FALSE === strpos($trimmed_value, '<ifr'.'ame') ){
				$trimmed_value = wp_oembed_get($trimmed_value);
			}

			if ( '<ifr'.'ame' == substr($trimmed_value, 0, 7) ){
				ark_Featured_Area::$last_featured_audio_html = $trimmed_value;
				return ark_Featured_Area::wrapEmbeded( $trimmed_value );
			}
		}

		return '';
	}

	/**
	 * @param int|object|null $postID Post ID or post object. Optional, default is the current post from the loop.
	 *
	 * @return string The featured area string if successful. Empty string otherwise.
	 */
	public static function getFeaturedVideo( $postID = null ){
		$featured_video = null;
		$content = get_post($postID);
		$post_content = $content->post_content;

		if ( ( FALSE !== stripos($post_content, '[video') ) and ( FALSE !== stripos($post_content, '[/video]') ) ) {
			$v = $post_content;
			$v = substr($v, stripos($v, '[video'));
			$end = stripos($v, '[/video]');
			if( FALSE !== $end ){
				$end = 8 + $end;
			}else{
				if( FALSE !== $end ) {
					$end = 1 + $end;
				}
			}
			if( FALSE !== $end ){
				$v = substr($v, 0, $end);
				$featured_video = do_shortcode($v);
				if (!empty($featured_video)) {
					return ark_Featured_Area::wrapEmbeded( $featured_video );
				}
			}
		}


		foreach ( explode( "\n", $post_content ) as $key => $value) {
			$value = trim($value);
			if (empty($value)) continue;
			if (FALSE !== strpos($value, 'http')) {
				if (FALSE !== strpos($value, '[embed]')) {
					if (FALSE !== strpos($value, '[/embed]')) {
						$value = str_replace( array('[embed]','[/embed]'), array('',''), $value );
					}
				}
				$featured_video = wp_oembed_get($value);
				if (!empty($featured_video)) break;
			}
		}
		if( empty($featured_video) ){
			return '';
		}
		return ark_Featured_Area::wrapEmbeded( $featured_video );
	}

	public static function wrapEmbeded( $html ){
		// Video fix

		if( FALSE === strpos( $html, '<ifr'.'ame ') ){
			if( FALSE === strpos( $html, '<embed ') ){
				if( FALSE === strpos( $html, '<video ') ){
					return $html;
				}
			}
		}

		$resize = absint( ark_Featured_Area::$_resize );
		$width  = absint( ark_Featured_Area::$_width  );
		$height = absint( ark_Featured_Area::$_height );

		if( ( $resize ) and ! empty( $width ) and ! empty( $height ) ){
			$ratio = 0.01 * absint( 10000 * $height / $width );
			$div = '<div class="embed-responsive" style="padding-bottom: '.  $ratio.'%">';
			$html = str_replace('<ifr'.'ame ', $div . '<ifr'.'ame'."\t".'class="embed-responsive-item" ', $html);
			$html = str_replace('<embed ', $div . '<embed'."\t".'class="embed-responsive-item" ', $html);
			$html = str_replace('<video ', $div . '<video'."\t".'class="embed-responsive-item" ', $html);
		}else{
			$div = '<div class="embed-responsive embed-responsive-16by9">';
			$html = str_replace('<ifr'.'ame ', $div . '<ifr'.'ame'."\t".'class="embed-responsive-item" ', $html);
			$html = str_replace('<embed ', $div . '<embed'."\t".'class="embed-responsive-item" ', $html);
			$html = str_replace('<video ', '<div class="video-responsive-wrapper">' . '<video'."\t".'class="video-responsive" ', $html);
		}
		$html = str_replace('</ifr'.'ame>', '</ifr'.'ame'."\t".'></div>', $html);
		$html = str_replace('</embed>', '</embed'."\t".'></div>', $html);
		$html = str_replace('</video>', '</video'."\t".'></div>', $html);

		if( FALSE === strpos($html, 'google.com/maps/') ) {
			$html = str_replace('"https://', '"//', $html);
			$html = str_replace('"http://', '"//', $html);
		}

		return $html;
	}

	public static function getSliderFromGallery($output, $attr) {

		static $instance = 0;
		$instance++;

		$postID = ark_Featured_Area::$postID;

		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if( !$attr['orderby'] ){
				unset( $attr['orderby'] );
			}
		}

		/**
		 * @type string       $order      Order of the images in the gallery. Default 'ASC'. Accepts 'ASC', 'DESC'.
		 * @type string       $orderby    The field to use when ordering the images. Default 'menu_order ID'.
		 *                                Accepts any valid SQL ORDERBY statement.
		 * @type int          $id         Post ID.
		 * @type string       $itemtag    HTML tag to use for each image in the gallery.
		 *                                Default 'dl', or 'figure' when the theme registers HTML5 gallery support.
		 * @type string       $icontag    HTML tag to use for each image's icon.
		 *                                Default 'dt', or 'div' when the theme registers HTML5 gallery support.
		 * @type string       $captiontag HTML tag to use for each image's caption.
		 *                                Default 'dd', or 'figcaption' when the theme registers HTML5 gallery support.
		 * @type int          $columns    Number of columns of images to display. Default 3.
		 * @type string|array $size       Size of the images to display. Accepts any valid image size, or an array of width
		 *                                and height values in pixels (in that order). Default 'thumbnail'.
		 * @type string       $ids        A comma-separated list of IDs of attachments to display. Default empty.
		 * @type string       $include    A comma-separated list of IDs of attachments to include. Default empty.
		 * @type string       $exclude    A comma-separated list of IDs of attachments to exclude. Default empty.
		 * @type string       $link       What to link each image to. Default empty (links to the attachment page).
		 *                                    Accepts 'file', 'none'.
		 */

		extract(shortcode_atts(array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $postID,
			'columns'    => 3,
			'size'       => 'thumbnail',
			'inc'.'lude' => '',
			'exclude'    => ''
		), $attr));

		$gallery_ID = $id = intval($id);

		if( 'RAND' == $order )
			$orderby = 'none';

		if( ! empty($include) ) {
			$include = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array('inc'.'lude' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( !empty($exclude) ) {
			$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		} else {
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}

		if( empty($attachments) )
			return '';

		$output = "";

		$resize = absint( ark_Featured_Area::$_resize );
		$width  = absint( ark_Featured_Area::$_width  );
		$height = absint( ark_Featured_Area::$_height );

		$output .= '<div id="blog-single-post-slider-'.$instance.'" class="carousel slide carousel-fade" data-ride="carousel">';
		$output .= '<div class="carousel-inner" role="listbox">';

		$active = ' active';
		foreach ( $attachments as $id => $attachment ) {
			$url = wp_get_attachment_url( $id );
			if( empty( $url ) ) continue;

			if( $resize ) {
				if( !empty( $width ) || ! empty( $height ) ) {
					$url = fImg::resize($url, $width, $height, true);
				}
			}
			$output .= '<div class="item'.$active.'">';
			$active = '';
			$output .= '<img src="'.esc_url( $url ). '" alt="" class="img-responsive">';
			$output .= '</div>'."\n";
		}

		$output .= '</div>';

		$output .= '<a class="left carousel-control theme-carousel-control-v1" href="#blog-single-post-slider-'.$instance.'" role="button" data-slide="prev">';
		$output .= '<span class="carousel-control-arrows-v1 radius-3 fa fa-angle-left" aria-hidden="true"></span></a>';

		$output .= '<a class="right carousel-control theme-carousel-control-v1" href="#blog-single-post-slider-'.$instance.'" role="button" data-slide="next">';
		$output .= '<span class="carousel-control-arrows-v1 radius-3 fa fa-angle-right" aria-hidden="true"></span></a>';

		$output .= '</div>';

		return $output;
	}

	public static function actionHijackFeaturedShortcode( $html, $attr = array() ) {
		if( ark_Featured_Area::$_ignore_first ){
			ark_Featured_Area::$_ignore_first = false;
			return ' ';
		}

		switch ( get_post_format( ark_Featured_Area::$postID ) ) {
			case 'audio':
			case 'video':
				return ark_Featured_Area::wrapEmbeded( $html );
			case 'gallery':
				if( ark_Featured_Area::$_gallery_is_slider ) {
					return ark_Featured_Area::getSliderFromGallery($html, $attr);
				}
		}

		return $html;
	}

}


