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
    //Listando todos os intervalos S3
    $buckets = $s3->listBuckets();
    foreach ($buckets['Buckets'] as $bucket) {
        echo $bucket['Name'] . "\n";
    }
    //exemplo 2
    $buckets = $s3->getIterator('ListBuckets', []);
    foreach($buckets as $bucket) {

        $objects = $s3->getIterator('ListObjects', [ 'Bucket' => $bucket['name'] ]);
        var_dump($bucket);
        foreach($objects as $object) {
            
        }

    }
 
