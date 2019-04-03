<?php
namespace Mrubiosan\FlyUrl\Adapter;

use League\Flysystem\AzureBlobStorage\AzureBlobStorageAdapter;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;

class UrlAzureBlobStorageAdapter extends AzureBlobStorageAdapter implements UrlAdapterInterface
{
    /**
     * @var BlobRestProxy
     */
    private $client;

    /**
     * @var string
     */
    private $container;

    public function __construct(BlobRestProxy $client, $container, $prefix = null)
    {
        $this->client = $client;
        $this->container = $container;
        parent::__construct($client, $container, $prefix);
    }

    public function getUrl($path)
    {
        return $this->client->getBlobUrl($this->container, $this->applyPathPrefix($path));
    }
}
