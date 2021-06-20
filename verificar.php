<?php

require 'vendor/autoload.php';

use Aws\S3\S3Client;  
use Aws\Exception\AwsException;

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

$filename = 'b1.jpeg';
$bucket = getenv($bucketName)?: die('Nenhuma var de configuração "S3_BUCKET" encontrada ');
$s3->registerStreamWrapper();
$keyExists = file_exists("s3://".$bucket."/".$filename);
if ($keyExists) {
    echo 'File exists!';
}
