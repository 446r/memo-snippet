<?php
class wkhtmltoimage
{
	static $stdout;
	static $stderr;
	static $errno;

	static function render($html, $option = null)
	{
		$cmd = '/usr/local/bin/wkhtmltomage';
		$cmd = $cmd . ' ' . $option . ' - - ';

		$proc = proc_open($cmd, array(0 => array('pipe', 'r'), 1 => array('pipe', 'w'), 2 => array('pipe', 'w')), $pipes);
		fwrite($pipes[0], $html);
		fclose($pipes[0]);
		self::$stdout = stream_get_contents($pipes[1]);
		fclose($pipes[1]);
		self::$stderr = stream_get_contents($pipes[2]);
		fclose($pipes[2]);
		self::$errno = proc_close($proc);

		return self::$stdout;
	}
}
