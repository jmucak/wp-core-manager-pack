<?php

namespace jmucak\wpOptimizationPack\hooks;

class Scripts {
	public function deactivate(): void {
		add_action( 'wp_enqueue_scripts', array( $this, 'remove_wp_block_library_css' ), 100 );
	}

	public function remove_wp_block_library_css(): void {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
	}
}