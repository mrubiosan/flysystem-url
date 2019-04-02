<?php
namespace Mrubiosan\FlyUrlPlugin\Adapter;

use League\Flysystem\AzureBlobStorage\AzureBlobStorageAdapter as BaseAdapter;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;


/**
 * Exposes getBlobUrl() that otherwise is inaccessible, as client and container properties are hidden
 * @package Mrubiosan\FlyUrlPlugin\Adapter
 */
class AzureBlobStorageAdapterWithUrl extends BaseAdapter
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

    /**
     * @param string $path
     * @return string
     */
    public function getBlobUrl($path)
    {
        return $this->client->getBlobUrl($this->container, $path);
    }
}
