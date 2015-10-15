<?php

namespace Maltz\Http;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

class Files extends Collection
{
    /**
     * [$path description]
     * @var [type]
     */
    protected $path;

    public function __construct(array $files, $path)
    {
        $this->path = $path;
        $files = $this->arrangeFilesArray($files);
        $this->map($files);
    }

    /**
     * /
     * @param  [type] $files [description]
     * @return [type]        [description]
     */
    protected function arrangeFilesArray($files)
    {
        foreach ($files as $key => $all) {
            foreach ($all as $i => $val) {
                $arrangedFiles[$i][$key] = $val;
            }
        }
        return $arrangedFiles;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function getUploadedFiles()
    {
        $destination = array();
        foreach ($this->items as $file) {
            $destination[] = $this->path . '/' . $file['name'];
        }
        return $destination;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function uploadSuccesful()
    {
        $val = true;
        foreach ($this->items as $file) {
            if (is_uploaded_file($file['tmp_name'])) {
                $destination = $this->path . '/' . $file['name'];
                $val = move_uploaded_file($file['tmp_name'], $destination);
                if ($val === false) {
                    return $val;
                }
            }
        }
        return $val;
    }
}
