<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 */

if( ! post_password_required() ) {
	if (comments_open() or (0 < get_comments_number())) {
		if( ! class_exists('ffBlComments') ) {
			echo '<div class="bg-color-white margin-b-30">';
			echo '<div class="blog-single-post-content">';
			echo '<div class="blog-single-post-comment-form">';
			echo '<div id="comments" class="comments-area">';

			if (comments_open()) {
				Ark_Comments::setTranslation('name', esc_attr( __('Full Name *', 'ark')) );
				Ark_Comments::setTranslation('email', esc_attr( __('E-mail *', 'ark')) );
				Ark_Comments::setTranslation('url', esc_attr( __('Website', 'ark')) );
				Ark_Comments::setTranslation('comment', esc_attr( __('Comment *', 'ark')) );
				Ark_Comments::setTranslation('cancel', esc_attr( __('Cancel reply', 'ark')) );
				Ark_Comments::setTranslation('logged-in', ark_wp_kses( __('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','ark')) );

				Ark_Comments::setTranslation('submit-button', esc_attr( __('Submit', 'ark')) );
				Ark_Comments::setTranslation('heading', ark_wp_kses( __('Leave a Reply', 'ark')) );

				Ark_Comments::ark_comment_form();
			}

			if (0 < get_comments_number()) {

				Ark_Comments::setTranslation('date-format', ark_wp_kses( __('%s ago', 'ark')) );
				Ark_Comments::setTranslation('reply', esc_attr( __('Reply', 'ark')) );
				Ark_Comments::setTranslation('moderation', ark_wp_kses( __('Your comment is awaiting moderation.', 'ark')) );

				Ark_Comments::ark_wp_list_comments();
			}

			echo '</div>';
			echo '</div>';
			echo '</div>';
			echo '</div>';

			Ark_Comments::setTranslation( 'prev-text', '' );
			Ark_Comments::setTranslation( 'prev-icon', 'ff-font-awesome4 icon-angle-double-left' );
			Ark_Comments::setTranslation( 'next-text', '' );
			Ark_Comments::setTranslation( 'next-icon', 'ff-font-awesome4 icon-angle-double-right');

			Ark_Comments::ark_paginate_comments_links();
		}
	}
}

Ark_Comments::$comment_template_state = Ark_Comments::PRINTED;
