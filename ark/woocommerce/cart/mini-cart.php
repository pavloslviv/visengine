<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

do_action( 'woocommerce_before_mini_cart' );

echo '<div class="woocommerce-mini-cart-wrapper">';

echo '<div class="shopping-cart-menu ffb-cart-submenu">';
echo '<ul class="list-unstyled">';

echo '<li>';
echo '<span class="shopping-cart-menu-title">'.get_the_title( wc_get_page_id('cart') ).'<a href="javascript:void(0);" class="menu-cart-close">&times;</a></span>';
echo '</li>';

if ( ! WC()->cart->is_empty() ) {

	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

		if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
			$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
			$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
			$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
			$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

			echo '<li class="shopping-cart-menu-content ';
			echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) );
			echo '">';

			// Image

			echo '<div class="shopping-cart-menu-product-media">';
			if ( $_product->is_visible() ) {
				echo '<a href="' . esc_url($product_permalink) . '">';
			}
			echo str_replace(array('http:', 'https:'), '', $thumbnail);
			if ( $_product->is_visible() ) {
				echo '</a>';
			}
			echo '</div>';

			// Item name + price

			echo '<div class="shopping-cart-menu-product-wrap">';
			if ( $_product->is_visible() ) {
				echo '<a href="' . esc_url($product_permalink) . '">';
			}
			echo '<span class="shopping-cart-menu-product-name">'.$product_name.'</span>';
			if ( $_product->is_visible() ) {
				echo '</a>';
			}

			echo '<span class="shopping-cart-menu-product-price">';
			echo WC()->cart->get_item_data( $cart_item );
			echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key );
			echo '</span>';

			echo '</div>';

			// Delete X

			echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
				'<a href="%s" class="remove shopping-cart-close" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
				esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
				esc_html( __( 'Remove this item', 'ark' ) ),
				esc_attr( $product_id ),
				esc_attr( $_product->get_sku() )
			), $cart_item_key );

			echo '</li>';
		}
	}

	echo '<li class="shopping-cart-subtotal">';

	// Subtotal
	echo '<div class="shopping-cart-subtotal-content">';
	echo '<span class="shopping-cart-subtotal-title">' . ark_wp_kses( __( 'Subtotal', 'ark' ) ) . '</span>';
	echo '<span class="shopping-cart-subtotal-price">' .  WC()->cart->get_cart_subtotal() . '</span>';
	echo '</div>';

	echo '<a class="shopping-cart-subtotal-checkout-link btn-base-bg btn-base-sm btn-block radius-3 margin-b-10" href="' . wc_get_checkout_url() . '">'.get_the_title( wc_get_page_id('checkout') ).'</a>';

	echo '<p class="shopping-cart-subtotal-view">';
	echo '<a class="shopping-cart-subtotal-view-link" href="' . wc_get_cart_url() . '">'.get_the_title( wc_get_page_id('cart') ).'</a>';
	echo '</p>';

	echo '</li>';
} else {
	echo '<li class="shopping-cart-menu-content empty">';
	echo ark_wp_kses( __( 'No products in the cart.', 'ark' ) );
	echo '</li>';
}
echo '</ul>';
echo '</div>';

echo '</div>';

do_action( 'woocommerce_after_mini_cart' );
