<?php
namespace Mrubiosan\FlyUrlPlugin\Filesystem;

use League\Flysystem\FilesystemInterface;

interface UrlFilesystemInterface extends FilesystemInterface
{
    /**
     * @param $path
     * @return string
     */
    public function getUrl($path);
}
