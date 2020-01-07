<?php
/* PHP7+
   Write by hank9999
*/

/*
	codes' meaning

	10000 => Success
	10001 => No ID
	10002 => No Command
	10003 => Install Success
	10004 => Cannot Write File
	10005 => Wrong ID
*/

/*
	status's codes' meaning
	0 => nothing to do
	1 => wait power on
*/

// header's declaration
header('Content-Type:application/json; charset=utf-8');

$id = trim($_GET['id']);
$command = trim($_GET['command']);

if (file_exists("id.lock") == False) {
	$random_id = bin2hex(random_bytes(32));
	$id_file = fopen('id.lock','w');
	fwrite($id_file, $random_id);
	fclose($id_file);
	if (file_exists("id.lock")) {
		$message = array('code' => 10003, 'message' => 'Install Success. Please remember your id', 'id' => $random_id);
		exit(json_encode($message, JSON_UNESCAPED_UNICODE));
	} else {
		$message = array('code' => 10004, 'message' => 'Cannot Write File');
		exit(json_encode($message, JSON_UNESCAPED_UNICODE));
	}

} else {
	$id_file = fopen('id.lock','r');
	$right_id = trim(fread($id_file,filesize("id.lock")));
	fclose($id_file);
}

if (file_exists("status.lock") == False) {
	$status_file = fopen('status.lock','w');
	fwrite($status_file, 0);
	fclose($status_file);
} else {
	$status_file = fopen('status.lock','r');
	$status = trim(fread($status_file,filesize("status.lock")));
	fclose($status_file);
}

if ($id == '') {
	$message = array('code' => 10001, 'message' => 'No ID');
	exit(json_encode($message, JSON_UNESCAPED_UNICODE));
}

if ($command == '') {
	$message = array('code' => 10002, 'message' => 'No Command');
	exit(json_encode($message, JSON_UNESCAPED_UNICODE));
}

if ($id && $command) {
	if ($id == $right_id) {
		if ($command == 'send') {
			$status_file = fopen('status.lock','w');
			fwrite($status_file, 1);
			fclose($status_file);
			$message = array('code' => 10000, 'message' => 'Sned Success');
			exit(json_encode($message, JSON_UNESCAPED_UNICODE));
		} else if ($command == 'check') {
			$status_file = fopen('status.lock','r');
			$status = trim(fread($status_file,filesize("status.lock")));
			fclose($status_file);
			$message = array('code' => 10000, 'message' => 'Check Success', 'status' => $status);
			exit(json_encode($message, JSON_UNESCAPED_UNICODE));
		} else if ($command == 'boot_ok') {
			$status_file = fopen('status.lock','w');
			fwrite($status_file, 0);
			fclose($status_file);
			$message = array('code' => 10000, 'message' => 'Status Changed Success');
			exit(json_encode($message, JSON_UNESCAPED_UNICODE));
		}
	} else {
		$message = array('code' => 10005, 'message' => 'Wrong ID');
		exit(json_encode($message, JSON_UNESCAPED_UNICODE));
	}
}

?>