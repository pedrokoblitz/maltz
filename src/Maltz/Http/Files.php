<?php

namespace Maltz\Http;

class Files extends Collection
{

    protected $uploadDirectory;

    protected $originalFiles;

    public function __construct(array $files, $uploadDirectory)
    {
        $this->uploadDirectory = $uploadDirectory;
        $this->originalFiles = $files;
        $files = $this->arrangeFilesArray($files);
        $this->map($files);
    }

    public function arrangeFilesArray($files)
    {
        foreach ($files as $key => $all) {
            foreach ($all as $i => $val) {
                $arrangedFiles[$i][$key] = $val;
            }
        }
        return $arrangedFiles;
    }

    public function uploadSuccesful()
    {
        $val = true;
        foreach ($item as $file) {
            if (is_uploaded_file($file['tmp_name'])) {
                $destination = $this->uploadDirectory . '/' . $file['name'];
                $val = move_uploaded_file($file['tmp_name'], $destination);
                if ($val === false) {
                    return $val;
                }
            }
        }
        return $val;
    }
}
