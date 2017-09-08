<?php

if( !function_exists('ff_comment_form') ) {
	function ff_comment_form()
	{
		// See /templates/onePage/blocks/comments-form/comments-form.php
		comment_form();
	}
}

if( !function_exists('ff_the_tags') ) {
	function ff_the_tags()
	{
		// See /templates/onePage/blocks/blog-basic-meta-icons/blog-basic-meta-icons.php
		the_tags();
	}
}

if( !function_exists('ff_the_post_thumbnail') ) {
	function ff_the_post_thumbnail()
	{
		// See /templates/onePage/blocks/blog-featured-area/blog-featured-area.php
		// And maybe /templates/helpers/ark_Featured_Area.php
		// And maybe /templates/helpers/func.ff_Gallery.php
		the_post_thumbnail();
	}
}

if( !function_exists('ff_paginate_links') ) {
	function ff_paginate_links()
	{
		// See /templates/onePage/blocks/pagination/pagination.php
		paginate_links();
	}
}

if( !function_exists('ff_paginate_comments_links') ) {
	function ff_paginate_comments_links()
	{
		// See /templates/onePage/blocks/pagination/pagination.php
		paginate_comments_links();
	}
}

if( !function_exists('ff_next_comments_link') ) {
	function ff_next_comments_link()
	{
		// See /templates/onePage/blocks/pagination/pagination.php
		next_comments_link();
	}
}

if( !function_exists('ff_previous_comments_link') ) {
	function ff_previous_comments_link()
	{
		// See /templates/onePage/blocks/pagination/pagination.php
		previous_comments_link();
	}
}
