<?php

use CodeIgniter\Core\Lang;

class Number_helper_test extends CI_TestCase {

	public function set_up()
	{
		$this->helper('number');

		// Mock away load, too much going on in there,
		// we'll just check for the expected parameter
		$this->lang = $this->getMockBuilder(Lang::class)->setMethods(['load', 'line'])->getMock();

		$this->lang->expects($this->once())
			 ->method('load')
			 ->with($this->equalTo('number'));

		app()->set(Lang::class, $this->lang);
	}

	public function test_byte_format()
	{
		$this->lang->method('line')->with('bytes')->willReturn('Bytes');

		$this->assertEquals('456 Bytes', byte_format(456));
	}

	public function test_kb_format()
	{
		$this->lang->method('line')->with('kilobyte_abbr')->willReturn('KB');

		$this->assertEquals('4.5 KB', byte_format(4567));
	}

	public function test_kb_format_medium()
	{
		$this->lang->method('line')->with('kilobyte_abbr')->willReturn('KB');

		$this->assertEquals('44.6 KB', byte_format(45678));
	}

	public function test_kb_format_large()
	{
		$this->lang->method('line')->with('kilobyte_abbr')->willReturn('KB');

		$this->assertEquals('446.1 KB', byte_format(456789));
	}

	public function test_mb_format()
	{
		$this->lang->method('line')->with('megabyte_abbr')->willReturn('MB');

		$this->assertEquals('3.3 MB', byte_format(3456789));
	}

	public function test_gb_format()
	{
		$this->lang->method('line')->with('gigabyte_abbr')->willReturn('GB');

		$this->assertEquals('1.8 GB', byte_format(1932735283.2));
	}

	public function test_tb_format()
	{
		$this->lang->method('line')->with('terabyte_abbr')->willReturn('TB');

		$this->assertEquals('112,283.3 TB', byte_format(123456789123456789));
	}

}
