<?php

namespace jmucak\wpOptimizationPack\providers;

use jmucak\wpOptimizationPack\hooks\Comments;
use jmucak\wpOptimizationPack\hooks\Posts;
use jmucak\wpOptimizationPack\hooks\Scripts;
use jmucak\wpOptimizationPack\hooks\WPEmbeds;
use jmucak\wpOptimizationPack\hooks\WPEmoji;

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
	}
}