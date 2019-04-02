<?php
namespace Mrubiosan\FlyUrlPlugin\AdapterHandler;

use League\Flysystem\AdapterInterface;

interface AdapterHandlerInterface
{
    /**
     * @param AdapterInterface $adapter
     * @return bool
     */
    public function supportsAdapter(AdapterInterface $adapter);

    /**
     * @param $adapter
     * @param string $path
     * @return string
     */
    public function getUrl($adapter, $path);
}
