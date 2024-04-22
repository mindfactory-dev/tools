<?php

// declare(strict_type=1);

namespace Mindfactory\Tools;

trait FileVersionTrait
{
    public function getFileVersion(string $path, string|array $versions = ''): string
    {
        // Check so base file exists
        if (!file_exists($path)) {
            throw new \RuntimeException();
        }

        $pathParts = pathinfo($path);

        // If vesion is array
        if (is_array($versions)) {
            while (count($versions)) {
                $tmpVersions = '';
                foreach ($versions as $version) {
                    $tmpVersions .= '-' . $version;
                }
                $tmpPath = $pathParts['dirname'] . '/' . $pathParts['filename'] . $tmpVersions . '.' . $pathParts['extension'];

                if (file_exists($tmpPath)) {
                    return $tmpPath;
                }
                array_pop($versions);
            }
            return $path;
        }

        // If version is string
        $tmpPath = $pathParts['dirname'] . '/' . $pathParts['filename'] . '-' . $versions . '.' . $pathParts['extension'];
        if (file_exists($tmpPath)) {
            return $tmpPath;
        }

        // If no version submitted
        return $path;
    }
}
