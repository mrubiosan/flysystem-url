<?php
namespace Mrubiosan\FlyUrlPlugin\AdapterHandler;

use League\Flysystem\AdapterInterface;
use Mrubiosan\FlyUrlPlugin\Adapter\AzureBlobStorageAdapterWithUrl;

class AzureBlobStorage implements AdapterHandlerInterface
{
    public function supportsAdapter(AdapterInterface $adapter)
    {
        return $adapter instanceof AzureBlobStorageAdapterWithUrl;
    }

    /**
     * @param AzureBlobStorageAdapterWithUrl $adapter
     * @param string $path
     * @return string
     */
    public function getUrl($adapter, $path)
    {
        return $adapter->getBlobUrl($path);
    }
}
