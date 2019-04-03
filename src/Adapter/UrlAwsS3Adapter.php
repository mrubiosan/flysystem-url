<?php
namespace Mrubiosan\FlyUrlPlugin\Adapter;

use League\Flysystem\AwsS3v3\AwsS3Adapter;

class UrlAwsS3Adapter extends AwsS3Adapter implements UrlAdapterInterface
{
    public function getUrl($path)
    {
        $bucket = $this->getBucket();
        return $this->getClient()->getObjectUrl($bucket, $this->applyPathPrefix($path));
    }
}
