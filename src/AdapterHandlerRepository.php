<?php
namespace Mrubiosan\FlyUrlPlugin;

use League\Flysystem\AdapterInterface;

class AdapterHandlerRepository
{
    private $adapterHandlers = [];

    public function add(AdapterHandlerInterface $adapterHandler)
    {
        $this->adapterHandlers[] = $adapterHandler;
    }

    /**
     * @param AdapterInterface $adapter
     * @return AdapterHandlerInterface|null
     */
    public function findFor(AdapterInterface $adapter)
    {
        foreach ($this->adapterHandlers as $adapterHandler) {
            if ($adapterHandler->supportsAdapter($adapter)) {
                return $adapterHandler;
            }
        }

        return null;
    }
}
