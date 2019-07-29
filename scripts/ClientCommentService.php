<?php

namespace TestDrom;

class ClientCommentService
{
	private $address;

	function __construct($address)
	{
		$this->address = $address;
	}

	function getComments()
	{
		$connect_init = curl_init($this->address . "/comments");
		curl_setopt($connect_init, CURLOPT_HTTPGET, true);
		curl_setopt($connect_init, CURLOPT_RETURNTRANSFER, true);
		
		$result = curl_exec($connect_init);
		$http_code = curl_getinfo($connect_init, CURLINFO_HTTP_CODE);
		curl_close($connect_init);
		return array($http_code, $result);
	}

	function addComment($name, $text)
	{
		$data = array("name" => $name, "text" => $text);
		$data_string = json_encode($data);
		$connect_init = curl_init($this->address . "/comment");
		curl_setopt($connect_init, CURLOPT_POST, true);
		curl_setopt($connect_init, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($connect_init, CURLOPT_RETURNTRANSFER, true);


		curl_setopt($connect_init, CURLOPT_HTTPHEADER, array(
    		'Content-Type: application/json',
    		'Content-Length: '.strlen($data_string))
		);
		$result = curl_exec($connect_init);
		$http_code = curl_getinfo($connect_init, CURLINFO_HTTP_CODE);
		curl_close($connect_init);
		return array($http_code, $result);
	}

	function updateComment($id, $name, $comment)
	{
		$data = array("name" => $name, "text" => $comment);
		$data_string = json_encode($data);
		
	$connect_init = curl_init($this->address . "/comment/" . (string)$id);
		curl_setopt($connect_init, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($connect_init, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($connect_init, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($connect_init, CURLOPT_HTTPHEADER, array(
    		'Content-Type: application/json',
    		'Content-Length: '.strlen($data_string))
		);
		$result = curl_exec($connect_init);
		$http_code = curl_getinfo($connect_init, CURLINFO_HTTP_CODE);
		curl_close($connect_init);
		return array($http_code, $result);
	}
}

?>