<?php
namespace Mrubiosan\FlyUrlPlugin;

use Mrubiosan\FlyUrlPlugin\Exception\NoAdapterException;
use Mrubiosan\FlyUrlPlugin\Exception\UnsupportedAdapterException;

class GetUrlPlugin extends AbstractUrlPlugin
{
    public function getMethod()
    {
        return 'getUrl';
    }

    /**
     * @param $path
     * @return string
     * @throws NoAdapterException
     * @throws UnsupportedAdapterException
     */
    public function handle($path)
    {
        $adapter = $this->getAdapter();
        $handler = $this->findAdapterHandler($adapter);

        if (!$handler) {
            throw new UnsupportedAdapterException("No adapter handler found for ".get_class($adapter));
        }

        return $handler->getUrl($adapter, $path);
    }
}
