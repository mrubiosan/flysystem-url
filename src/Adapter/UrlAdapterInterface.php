<?php
namespace Mrubiosan\FlyUrl\Adapter;

use League\Flysystem\AdapterInterface;

interface UrlAdapterInterface extends AdapterInterface
{
    /**
     * @param $path
     * @return string
     */
    public function getUrl($path);
}
