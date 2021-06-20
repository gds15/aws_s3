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

/*
$USAGE = "\n" .
    "To run this example, supply the name of an S3 bucket and object\n" .
    "name gds15/ to delete.\n" .
    "\n" .
    "Ex: php DeleteObject.php gds15 gds15/\n";

if (count($argv) <= 2) {
    echo $USAGE;
    exit();
}

//$bucket = $argv[1];
//$key = $argv[2];
*/
$key = 'gds15/php30F1.tmp';

try {
    $result = $s3->deleteObject([
        'Bucket' => $bucketName,
        'Key' => $key,
    ]);
   
    if (!$result['DeleteMarker'])
    {
        echo $key . ' deletado.' . PHP_EOL;
    } else {
        exit('Error: ' . $key . ' não foi possivel deletar.' . PHP_EOL);
    }
} catch (S3Exception $e) {
    echo $e->getMessage() . "\n";
}