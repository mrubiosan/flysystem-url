<?php
namespace Mrubiosan\FlyUrlPlugin\AdapterHandler;

use League\Flysystem\AdapterInterface;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

class AwsS3 implements AdapterHandlerInterface
{
    public function supportsAdapter(AdapterInterface $adapter)
    {
        return $adapter instanceof AwsS3Adapter;
    }

    /**
     * @param AwsS3Adapter $adapter
     * @param string $path
     * @return string
     */
    public function getUrl($adapter, $path)
    {
        $client = $adapter->getClient();
        $bucket = $adapter->getBucket();

        return $client->getObjectUrl($bucket, $path);
    }
}
