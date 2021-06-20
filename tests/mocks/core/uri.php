<?php

use CodeIgniter\Core\Config;
use CodeIgniter\Core\URI;
class Mock_Core_URI extends URI {

	public function __construct()
	{
		$test = CI_TestCase::instance();
		$cls = new Config;

		// set predictable config values
		$test->ci_set_config(array(
			'index_page'		=> 'index.php',
			'base_url'		=> 'http://example.com/',
			'subclass_prefix'	=> 'MY_',
			'enable_query_strings'	=> FALSE,
			'permitted_uri_chars'	=> 'a-z 0-9~%.:_\-'
		));

		$this->config = new $cls;

		if ($this->config->item('enable_query_strings') !== TRUE OR is_cli())
		{
			$this->_permitted_uri_chars = $this->config->item('permitted_uri_chars');
		}
	}

	public function _set_permitted_uri_chars($value)
	{
		$this->_permitted_uri_chars = $value;
	}

}