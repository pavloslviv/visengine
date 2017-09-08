<?php

class Ark_Comments extends Walker_Comment {

	const PRINTED = 'printed';
	const OVERWRITTEN = 'overwritten';

	static public $comment_template_state = null;

	/**
	 * @var $translations array
	 */
	static protected $translations = array();

	public static function setTranslation( $name, $value ){
		Ark_Comments::$translations[$name] = $value;
	}

	public static function ark_comment_form(){

		$comment_form_settings =array(
			'comment_notes_after' => '',
			'fields' => array(
				'author' =>
					'<div class="col-xs-12 col-md-4 margin-b-30">'
					. '<input class="form-control blog-single-post-form radius-3" id="name" name="author" type="text" placeholder="'
					. esc_attr( Ark_Comments::$translations['name'] )
					. '" required>'
					. '</div>' ,
				'email' =>
					'<div class="col-xs-12 col-md-4 margin-b-30">'
					. '<input class="form-control blog-single-post-form radius-3" id="email" type="email" name="email" placeholder="'
					. esc_attr( Ark_Comments::$translations['email'] )
					. '" required>'
					.'</div>' ,
				'url' =>
					'<div class="col-xs-12 col-md-4 margin-b-30">'
					. '<input class="form-control blog-single-post-form radius-3" id="url" name="url" type="text" placeholder="'
					. esc_attr( Ark_Comments::$translations['url'] )
					. '" >'
					. '</div>' ,
			),
			'comment_field' =>
				'<div class="message col-xs-12 margin-b-30">'
				. '<textarea id="comment" name="comment" class="form-control blog-single-post-form radius-3" rows="6" placeholder="'
				. esc_attr( Ark_Comments::$translations['comment'] )
				. '"></textarea>'
				. '</div>' ,
			'comment_notes_before' => '',
			'cancel_reply_link' => Ark_Comments::$translations['cancel'],
			'class_form' => 'comment-form row',
		);

		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';

		$comment_form_settings['logged_in_as'] =
			'<p class="logged-in-as">' . sprintf(
				Ark_Comments::$translations['logged-in']
				, admin_url( 'profile.php' )
				, $user_identity
				, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
			) . '</p>';
		$comment_form_settings['label_submit'] = Ark_Comments::$translations['submit-button'];
		$comment_form_settings['title_reply']  = '<span>'.Ark_Comments::$translations['heading'].'</span>';

		ob_start();
		comment_form( $comment_form_settings );

		$comment_form = ob_get_clean();

		$comment_form = str_replace('logged-in-as', 'logged-in-as col-xs-12', $comment_form);
		$comment_form = str_replace('<p class="form-submit">', '<p class="form-submit col-xs-12">', $comment_form);
		$comment_form = str_replace('id="submit"', 'id="submit" class="btn-dark-brd btn-base-sm footer-v5-btn radius-3"', $comment_form);
		$comment_form = str_replace('</form>', '<div class="clearfix"><br /></div></form>', $comment_form);

		echo ( $comment_form );
		echo '<br/>';
	}

	protected function comment( $comment, $depth, $args ) {
		?>
	<div id="comment-<?php comment_ID(); ?>" class="blog-single-post-comment comment comment-reply-<?php echo absint( $depth ); ?>">
		<div class="blog-single-post-comment-media radius-circle">
			<?php echo get_avatar( $comment->comment_author_email, 50 ); ?>
		</div>
		<div class="blog-single-post-comment-content">
			<h4 class="blog-single-post-comment-username">
				<?php echo ark_wp_kses( get_comment_author( $comment->comment_ID ) ); ?>
			</h4>
			<small class="blog-single-post-comment-time">
				<?php echo ark_wp_kses( sprintf(
					Ark_Comments::$translations['date-format']
					, human_time_diff( get_comment_time( 'U' )
					, current_time( 'timestamp' ) )
				) ); ?>
			</small>

			<div class="comment-body">

				<p>
					<?php if ( '0' == $comment->comment_approved ) { ?>
						<em class="comment-awaiting-moderation">
							<?php echo ark_wp_kses( Ark_Comments::$translations['moderation'] ); ?>
						</em>
						<br />
						<br />
					<?php } ?>
				</p>

				<div class="blog-single-post-comment-text ff-richtext">
					<?php comment_text($comment->comment_ID); ?>
				</div>
			</div>
			<ul class="list-inline blog-single-post-comment-share">
				<li class="blog-single-post-comment-share-item reply">
					<?php

					$custom_args = array(
						'reply_text' => Ark_Comments::$translations['reply']
						, 'depth' => $depth
						, 'max_depth' => $args['max_depth']
					);
					$mergedArgs = array_merge( $args , $custom_args );
					echo get_comment_reply_link( $mergedArgs, $comment->comment_ID, get_the_ID() );

					?>
				</li>
			</ul>
		</div>
		<?php
	}

	public static function ark_wp_list_comments( $query = null ){

		echo '<div class="comment-list">';

		wp_list_comments( array(
			'walker' => new Ark_Comments() ,
			'style'  => 'div'
		) );
		echo '</div>';
	}

	public static function ark_paginate_comments_links(){
		$prev = get_previous_comments_link();
		$next = get_next_comments_link();

		if( !empty( $prev ) or !empty( $next ) ){

			$prev_text = '';
			if( ! empty( Ark_Comments::$translations['prev-icon'] ) ){
				$prev_text .= '<i class="'.Ark_Comments::$translations['prev-icon'].'"></i>';
			}
			if( ! empty( Ark_Comments::$translations['prev-text'] ) ){
				$prev_text .= ' ' . Ark_Comments::$translations['prev-text'];
			}

			$next_text = '';
			if( ! empty( Ark_Comments::$translations['next-text'] ) ){
				$next_text .= Ark_Comments::$translations['next-text'];
			}
			if( ! empty( Ark_Comments::$translations['next-icon'] ) ){
				$next_text .= ' <i class="'.Ark_Comments::$translations['next-icon'].'"></i>';
			}

			ob_start();
			paginate_comments_links(
				array(
					'prev_text' => $prev_text,
					'next_text' => $next_text,
				)
			);
			$pagin = ob_get_clean();

			$pagin = str_replace( '<a ','<li><a ', $pagin );
			$pagin = str_replace( '</a>','</a></li>', $pagin );

			$pagin = str_replace( '<span class="page-numbers current">','<li class="active"><a href="'.get_the_permalink().'">', $pagin );
			$pagin = str_replace( '<span class=\'page-numbers current\'>','<li class="active"><a href="'.get_the_permalink().'">', $pagin );
			$pagin = str_replace( '<span class="page-numbers dots">&hellip;</span>','<li><a href="#">&hellip;</a></li>', $pagin );
			$pagin = str_replace( '<span class=\'page-numbers dots\'>&hellip;</span>','<li><a href="#">&hellip;</a></li>', $pagin );
			$pagin = str_replace( '</span>','</a></li>', $pagin );

			$pagin = preg_replace('/>\s+</', '><', $pagin);

			echo '<div class="paginations-v3 text-center">';
			echo '<ul class="paginations-v3-list">';

			echo  $pagin;

			echo '</ul>';
			echo '</div>';
		}
	}
}



