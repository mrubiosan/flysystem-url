<?php
namespace Mrubiosan\FlyUrlPlugin;

use Mrubiosan\FlyUrlPlugin\Exception\NoAdapterException;

class HasUrlPlugin extends AbstractUrlPlugin
{
    public function getMethod()
    {
        return 'hasUrl';
    }

    public function handle($path)
    {
        try {
            $adapter = $this->getAdapter();
        } catch (NoAdapterException $e) {
            return false;
        }

        $adapterHandler = $this->findAdapterHandler($adapter);

        return $adapterHandler && $adapterHandler->hasUrl($adapter, $path);
    }
}
