<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('PATH_APP', realpath(dirname(__FILE__)) . '/');
define('PATH_BIN', realpath(PATH_APP . 'bin') . '/');

class Node {
	private $host;
	private $port;
	private $options;
	private $is_started;
	private $requst_type;
	
	public function __construct($options) {
		$this->options = $options;
		$this->is_started = false;
		$this->request_type = 'path_info';
		$this->host = '127.0.0.1';
		$this->port = 8080;
	}
	
	public function set($options) {
		foreach($options as $key => $value) {
			$this->$key = $value;
		}
	}
	
	public function set_host($host) {
		$this->host = $host;
	}
	
	public function set_port($port) {
		$this->port = $port;
	}
	
	private function get_path() {
		$os = PHP_OS;
		
		if(stristr($os, 'linux'))
			return PATH_BIN . 'linux/node';
		else if(stristr($os, 'darwin'))
			return PATH_BIN . 'darwin/node';
		else if(stristr($os, 'win'))
			return PATH_BIN . 'windows/node.exe';
		
		throw new Exception("Bootstrap isn't doesn't know what operating system is running.");
	}

	public function npm() {
		$packages = func_get_args();
		
		foreach($packages as $package) {
			
		}
	}
	
	public function start() {
		$params = array(
			'options' => $this->options,
			'server' => $_SERVER
		);
	
		$command = $this->get_path() . ' ' . 'main.js ' . json_encode($params) . ' > /dev/null &';

		$proc = popen($command, 'r');
		
		pclose($proc);
		
		$this->is_started = true;
	}
	
	public function set_request_type($type) {
		$this->request_type = $type;
	}
	
	public function request() {
		switch($this->request_type) {
			case 'path_info':
				$path = $_SERVER['PATH_INFO'];
			break;
			
			case 'query':
				$path = $_GET['q'];
			break;
			
			case 'cli':
				$path = '/';
			break;
		}
		
		if(($response = $this->send($path)) === false) {
			$this->start();
			
			while(($response = $this->send($path)) === false)
				usleep(50000);
		}

		return $response;
	}
	
	private function send($path) {
		return @file_get_contents('http://' . $this->host . ':' . $this->port . '/' . $path);
	}
}