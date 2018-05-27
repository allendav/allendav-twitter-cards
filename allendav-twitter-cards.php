<?php
/*
Plugin Name: Twitter Cards by Allendav
Plugin URI: http://www.allendav.com/
Description: Adds meta to the page to make tweets richer
Version: 1.0.0
Author: allendav
Author URI: http://www.allendav.com
License: GPL2
*/

class Allendav_Twitter_Cards {
	private static $instance;

	public static function getInstance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __clone() {
	}

	private function __wakeup() {
	}

	protected function __construct() {
		add_action( 'wp_head', array( $this, 'wp_head' ) );
	}

	function wp_head() {
		global $wp_query;
		if ( ! $wp_query->is_singular( 'post' ) ) {
			return;
		}

		global $post;
		?>
			<meta name="twitter:card" content="summary_large_image" />
			<meta name="twitter:title" content="<?php echo esc_attr( get_the_title() ); ?>" />
			<meta name="twitter:url" content="<?php echo esc_attr( get_the_permalink() ); ?>" />
			<meta name="twitter:description" content="<?php echo esc_attr( get_the_excerpt( $post->ID ) ); ?>" />
		<?php

		if ( has_post_thumbnail( $post->ID ) ) {
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			?>
				<meta name="twitter:image" content="<?php echo esc_attr( $image[0] ); ?>" />
			<?php
		}
	}
}

Allendav_Twitter_Cards::getInstance();
