<?php

class Html_helper_test extends CI_TestCase {

	public function set_up()
	{
		$this->helper('html');
	}

	// ------------------------------------------------------------------------

	public function test_heading()
	{
		$this->assertEqualsWithSpeaceInSensitive('<h1>foobar</h1>', heading('foobar'));
		$this->assertEqualsWithSpeaceInSensitive('<h2 class="bar">foobar</h2>', heading('foobar', 2, 'class="bar"'));
	}

	public function test_heading_array_attributes()
	{
		// Test array of attributes
		$this->assertEqualsWithSpeaceInSensitive('<h2 class="bar" id="foo">foobar</h2>', heading('foobar', 2, array('class' => 'bar', 'id' => 'foo')));
	}

	public function test_heading_object_attributes()
	{
		// Test array of attributes
		$this->assertEqualsWithSpeaceInSensitive('<h2 class="bar" id="foo">foobar</h2>', heading('foobar', 2, array('class' => 'bar', 'id' => 'foo')));
		$test = new stdClass;
		$test->class = "bar";
		$test->id = "foo";
		$this->assertEqualsWithSpeaceInSensitive('<h2 class="bar" id="foo">foobar</h2>', heading('foobar', 2, $test));
	}

	// ------------------------------------------------------------------------

	public function test_img()
	{
		$this->ci_set_config('base_url', 'http://localhost/');
		$this->assertEqualsWithSpeaceInSensitive('<img src="http://localhost/test" alt="" />', img("test"));
		$this->assertEqualsWithSpeaceInSensitive('<img src="data:foo/bar,baz" alt="" />', img("data:foo/bar,baz"));
		$this->assertEqualsWithSpeaceInSensitive('<img src="http://localhost/data://foo" alt="" />', img("data://foo"));
		$this->assertEqualsWithSpeaceInSensitive('<img src="//foo.bar/baz" alt="" />', img("//foo.bar/baz"));
		$this->assertEqualsWithSpeaceInSensitive('<img src="http://foo.bar/baz" alt="" />', img("http://foo.bar/baz"));
		$this->assertEqualsWithSpeaceInSensitive('<img src="https://foo.bar/baz" alt="" />', img("https://foo.bar/baz"));
		$this->assertEqualsWithSpeaceInSensitive('<img src="ftp://foo.bar/baz" alt="" />', img("ftp://foo.bar/baz"));
	}

	// ------------------------------------------------------------------------

	public function test_Ul()
	{
		$expect = <<<EOH
<ul>
  <li>foo</li>
  <li>bar</li>
</ul>

EOH;

		$expect = ltrim($expect);
		$list = array('foo', 'bar');

		$this->assertEqualsWithSpeaceInSensitive(ltrim($expect), ul($list));

		$expect = <<<EOH
<ul class="test">
  <li>foo</li>
  <li>bar</li>
</ul>

EOH;

		$expect = ltrim($expect);

		$this->assertEqualsWithSpeaceInSensitive($expect, ul($list, 'class="test"'));

		$this->assertEqualsWithSpeaceInSensitive($expect, ul($list, array('class' => 'test')));
	}

	// ------------------------------------------------------------------------

	public function test_meta()
	{
		$this->assertEqualsWithSpeaceInSensitive(
			"<meta name=\"test\" content=\"foo\" />\n",
			meta('test', 'foo')
		);

		$this->assertEqualsWithSpeaceInSensitive(
			"<meta name=\"foo\" content=\"\" />\n",
			meta(array('name' => 'foo'))
		);

		$this->assertEqualsWithSpeaceInSensitive(
			"<meta charset=\"foo\" />\n",
			meta(array('name' => 'foo', 'type' => 'charset'))
		);

		$this->assertEqualsWithSpeaceInSensitive(
			"<meta charset=\"foo\" />\n",
			meta(array('name' => 'foo', 'type' => 'charset'))
		);
	}
}
