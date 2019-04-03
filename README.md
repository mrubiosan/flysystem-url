# Flysystem URL
[![Build Status](https://travis-ci.org/mrubiosan/flysystem-url.svg?branch=master)](https://travis-ci.org/mrubiosan/flysystem-url)  [![Maintainability](https://api.codeclimate.com/v1/badges/b52601b922a2579d5fbc/maintainability)](https://codeclimate.com/github/mrubiosan/flysystem-url/maintainability) [![Test Coverage](https://api.codeclimate.com/v1/badges/b52601b922a2579d5fbc/test_coverage)](https://codeclimate.com/github/mrubiosan/flysystem-url/test_coverage)
 
 Extends Flysystem adapters to include a URL generating method.

Supports:
* AWS S3 (and providers with S3 compatible APIs)
* Azure Blob Storage
* Google Cloud Storage

# Usage

```php
$s3Client = new \Aws\S3\S3Client([//AWS client config...]);
$urlS3Adapter = new \Mrubiosan\FlyUrl\Adapter\UrlAwsS3Adapter($s3Client, 'mybucket');
$urlFilesystem = new \Mrubiosan\FlyUrl\Filesystem\UrlFilesystem($urlS3Adapter);

echo $urlFilesystem->getUrl('my/s3/file');
``` 

Available adapters:
* Mrubiosan\FlyUrl\Adapter\UrlAwsS3Adapter
* Mrubiosan\FlyUrl\Adapter\UrlAzureBlobStorageAdapter
* Mrubiosan\FlyUrl\Adapter\UrlGoogleStorageAdapter
