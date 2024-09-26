<?php

namespace jmucak\wpOptimizationPack\hooks;

class WPEmbeds {
	public function deactivate(): void {
		add_action( 'init', array( $this, 'disable_embeds_code_init' ) );
	}

	public function disable_embeds_code_init(): void {
		// Remove the REST API endpoint.
		remove_action( 'rest_api_init', 'wp_oembed_register_route' );

		// Turn off oEmbed auto discovery.
		add_filter( 'embed_oembed_discover', '__return_false' );

		// Don't filter oEmbed results.
		remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

		// Remove oEmbed discovery links.
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

		// Remove oEmbed-specific JavaScript from the front-end and back-end.
		remove_action( 'wp_head', 'wp_oembed_add_host_js' );
		add_filter( 'tiny_mce_plugins', array( $this, 'disable_embeds_tiny_mce_plugin' ) );

		// Remove all embeds rewrite rules.
		add_filter( 'rewrite_rules_array', array( $this, 'disable_embeds_rewrites' ) );

		// Remove filter of the oEmbed result before any HTTP requests are made.
		remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );
	}

	public function disable_embeds_tiny_mce_plugin( $plugins ): array {
		return array_diff( $plugins, array( 'wpembed' ) );
	}

	public function disable_embeds_rewrites( array $rules ): array {
		foreach ( $rules as $rule => $rewrite ) {
			if ( str_contains( $rewrite, 'embed=true' ) ) {
				unset( $rules[ $rule ] );
			}
		}

		return $rules;
	}
}