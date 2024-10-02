<?php

namespace jmucak\wpCoreManagerPack\providers;

use jmucak\wpCoreManagerPack\hooks\Comments;
use jmucak\wpCoreManagerPack\hooks\Posts;
use jmucak\wpCoreManagerPack\hooks\Scripts;
use jmucak\wpCoreManagerPack\hooks\WPEmbeds;
use jmucak\wpCoreManagerPack\hooks\WPEmoji;

class OptimizationProvider {
	public static function register( array $config ): void {
		if ( ! empty( $config['deactivate_comments'] ) ) {
			( new Comments() )->deactivate();
		}

		if ( ! empty( $config['deactivate_wp_embeds'] ) ) {
			( new WPEmbeds() )->deactivate();
		}

		if ( ! empty( $config['deactivate_wp_emoji'] ) ) {
			( new WPEmoji() )->deactivate();
		}

		if ( ! empty( $config['deactivate_posts'] ) ) {
			( new Posts() )->deactivate();
		}

		if ( ! empty( $config['deactivate_scripts'] ) ) {
			( new Scripts() )->deactivate();
		}

		if(!empty($config['deactivate_short_links'])) {
			// Remove shortlink from head
			remove_action('wp_head', 'wp_shortlink_wp_head');

			// Disable shortlink header
			remove_action('template_redirect', 'wp_shortlink_header', 10, 0);
		}
	}
}