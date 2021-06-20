<?php

	require 'vendor/autoload.php';
	
	use Aws\S3\S3Client;
	use Aws\S3\Exception\S3Exception;

	$bucketName = '';
	$IAM_KEY = '';
	$IAM_SECRET = '';

	try {
		
		$s3 = S3Client::factory(
			array(
				'credentials' => array(
					'key' => $IAM_KEY,
					'secret' => $IAM_SECRET
				),
				'version' => 'latest',
				'region'  => 'sa-east-1',
				'http'    => ['verify' => false] 
			)
		);
	} catch (Exception $e) {
		die("Erro ao conectar: " . $e->getMessage());
	}
	
	$keyName = 'teste/'.basename($_FILES["fileToUpload"]['tmp_name']);	
	
	try {
		$file = $_FILES["fileToUpload"]['tmp_name'];

		$s3->putObject(
			array(
				'Bucket'=>$bucketName,
				'Key' =>  $keyName,
				'SourceFile' => $file,
				'StorageClass' => 'REDUCED_REDUNDANCY',
				'ACL'    => 'public-read',
			)
		);

	} catch (S3Exception $e) {
		die('Error 1:' . $e->getMessage());
	} catch (Exception $e) {
		die('Error 2:' . $e->getMessage());
	}

	echo 'Done';

?>