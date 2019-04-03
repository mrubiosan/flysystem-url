<?php
namespace Mrubiosan\FlyUrlPlugin\Adapter;

use League\Flysystem\AdapterInterface;

interface UrlAdapterInterface extends AdapterInterface
{
    /**
     * @param $path
     * @return string
     */
    public function getUrl($path);
}
