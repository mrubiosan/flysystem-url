<?php
namespace Mrubiosan\FlyUrlPlugin\Filesystem;

use League\Flysystem\Filesystem;
use Mrubiosan\FlyUrlPlugin\Adapter\UrlAdapterInterface;

class UrlFilesystem extends Filesystem implements UrlFilesystemInterface
{
    /**
     * @var UrlAdapterInterface
     */
    protected $adapter;

    public function __construct(UrlAdapterInterface $adapter, $config = null)
    {
        parent::__construct($adapter, $config);
    }


    public function getUrl($path)
    {
        return $this->adapter->getUrl($path);
    }
}
