<?php

// Generate unique id-like CLASS for section

if( !class_exists('Ark_Section_ID')) {
	class Ark_Section_ID{
		static $id = 0;

		static public function getNewID(){
			Ark_Section_ID::$id ++;
			return Ark_Section_ID::$id;
		}

		static public function getActualID(){
			return Ark_Section_ID::$id;
		}
	}
}


// Generate unique ID for youtube videos

if( !function_exists('Ark_create_unique_ID')) {
	/**
	 * @return int
	 */
	function Ark_create_unique_ID() {
		static $id = 0;
		$id ++;
		return (int) $id;
	}
}


// Static Class for getting / setting Featured area width and height

if( !class_exists('Ark_Featured_Area_Size')) {
	class Ark_Featured_Area_Size{
		static $width = null;
		static $height = null;

		static public function getWidth(){  return Ark_Featured_Area_Size::$width;  }
		static public function getHeight(){ return Ark_Featured_Area_Size::$height; }

		static public function setWidth($w){  return Ark_Featured_Area_Size::$width  = $w; }
		static public function setHeight($h){ return Ark_Featured_Area_Size::$height = $h; }

	}
}



if( !function_exists('Ark_get_post_data')) {
	function Ark_get_post_data() {
		global $post;
		return $post;
	}
}