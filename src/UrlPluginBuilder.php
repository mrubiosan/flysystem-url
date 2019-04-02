<?php
namespace Mrubiosan\FlyUrlPlugin;

use League\Flysystem\FilesystemInterface;
use Mrubiosan\FlyUrlPlugin\AdapterHandler\AdapterHandlerInterface;
use Mrubiosan\FlyUrlPlugin\AdapterHandler\AdapterHandlerRepository;
use Mrubiosan\FlyUrlPlugin\AdapterHandler\AwsS3;
use Mrubiosan\FlyUrlPlugin\AdapterHandler\AzureBlobStorage;

class UrlPluginBuilder
{
    /**
     * @var FilesystemInterface
     */
    private $filesystem;

    /**
     * @var AdapterHandlerRepository
     */
    private $adapterHandlerRepo;

    public function __construct(FilesystemInterface $filesystem)
    {
        if (!is_callable([$filesystem, 'addPlugin'])) {
            throw new \LogicException("Filesystem object does not appear to support plugins");
        }
        $this->filesystem = $filesystem;
        $this->adapterHandlerRepo = new AdapterHandlerRepository();
    }

    public function addGetUrlPlugin()
    {
        $this->filesystem->addPlugin(new GetUrlPlugin($this->adapterHandlerRepo));
        return $this;
    }

    public function addHasUrlPlugin()
    {
        $this->filesystem->addPlugin(new HasUrlPlugin($this->adapterHandlerRepo));
        return $this;
    }

    public function withAwsS3()
    {
        $adapterHandler = new AwsS3();
        return $this->withAdapterHandler($adapterHandler);
    }

    public function withAzureBlob()
    {
        $adapterHandler = new AzureBlobStorage();
        return $this->withAdapterHandler($adapterHandler);
    }

    public function withAdapterHandler(AdapterHandlerInterface $adapterHandler)
    {
        $this->adapterHandlerRepo->add($adapterHandler);
        return $this;
    }
}
