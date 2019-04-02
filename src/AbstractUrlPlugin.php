<?php
namespace Mrubiosan\FlyUrlPlugin;

use League\Flysystem\AdapterInterface;
use League\Flysystem\FilesystemInterface;
use League\Flysystem\PluginInterface;
use Mrubiosan\FlyUrlPlugin\AdapterHandler\AdapterHandlerInterface;
use Mrubiosan\FlyUrlPlugin\AdapterHandler\AdapterHandlerRepository;
use Mrubiosan\FlyUrlPlugin\Exception\NoAdapterException;

abstract class AbstractUrlPlugin implements PluginInterface
{
    /**
     * @var FilesystemInterface
     */
    protected $filesystem;

    /**
     * @var AdapterHandlerRepository
     */
    private $adapterHandlerRepo;

    /**
     * HasUrlPlugin constructor.
     * @param AdapterHandlerRepository $adapterHandlerRepo
     */
    public function __construct(AdapterHandlerRepository $adapterHandlerRepo)
    {
        $this->adapterHandlerRepo = $adapterHandlerRepo;
    }

    /**
     * @param AdapterInterface $adapter
     * @return AdapterHandlerInterface|null
     */
    protected function findAdapterHandler(AdapterInterface $adapter)
    {
        return $this->adapterHandlerRepo->findFor($adapter);
    }

    public function setFilesystem(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @return AdapterInterface
     * @throws NoAdapterException
     */
    protected function getAdapter()
    {
        $adapterGetter = [$this->filesystem, 'getAdapter'];

        if (!is_callable($adapterGetter)) {
            throw new NoAdapterException("Could not retrieve adapter from ".get_class($this->filesystem));
        }

        try {
            return $adapterGetter();
        } catch (\Exception $e) {
            throw new NoAdapterException("Could not retrieve adapter from ".get_class($this->filesystem), 0, $e);
        }
    }

    abstract public function handle($path);
}
