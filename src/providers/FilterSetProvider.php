<?php

namespace jmucak\wpCoreManagerPack\providers;

class FilterSetProvider {
	private array $config;
	public function __construct(array $config) {
		$this->config = $config;
	}
	public function set_data() : void {
		if(!empty($this->config['query_vars'])) {
			add_filter('query_vars', array($this, 'add_query_vars'));
		}

	}

	public function add_query_vars( array $query_vars ): array {
		return array_merge( $query_vars, $this->config['query_vars'] );
	}
}