<?php

namespace dnj\phpvmomi\ManagedObjects\actions;

use dnj\phpvmomi\DataObjects\FileInfo;
use dnj\phpvmomi\DataObjects\FileQueryFlags;
use dnj\phpvmomi\DataObjects\HostDatastoreBrowserSearchSpec;
use dnj\phpvmomi\Utils\Path;

trait HostDatastoreBrowserTrait
{
    public function search(string $datastorePath, ?HostDatastoreBrowserSearchSpec $searchSpec = null): array
    {
        if (null === $searchSpec) {
            $searchSpec = new HostDatastoreBrowserSearchSpec();
            $searchSpec->details = new FileQueryFlags(true, true, true, true);
            $searchSpec->sortFoldersFirst = true;
        }
        $task = $this->_SearchDatastore_Task($datastorePath, $searchSpec);
        $task->waitFor(60);
        $files = $task->info->result->file ?? [];
        if (!is_array($files)) {
            $files = [$files];
        }

        return $files;
    }

    public function getFileByPath(string $datastorePath): ?FileInfo
    {
        $path = Path::fromStr($datastorePath);
        $parts = explode('/', '/'.ltrim($path->path, '/'));

        /**
         * @var FileInfo|null
         */
        $found = null;
        for ($x = 0, $l = count($parts); $x < $l - 1; ++$x) {
            $pathPart = clone $path;
            $pathPart->path = implode('/', array_slice($parts, 0, $x + 1));
            $items = $this->search($pathPart->toDSPath());
            $found = null;
            foreach ($items as $item) {
                if ($item->path === $parts[$x + 1]) {
                    $found = $item;
                    break;
                }
            }
            if (!$found) {
                return null;
            }
        }

        return $found;
    }
}
