<?php

namespace Maltz\Service;

trait FileWriter
{
    public function setFile($name, $patj)
    {
        $this->file = rtrim($path, '/') . '/' . $name;
    }

    public function write($contents)
    {
        if (!isset($this->file)) {
            throw new \Exception("File property not set", 1);
        }

        $fh = fopen($this->file, 'w');
        fwrite($fh, $contents);
        fclose($fh);
    }

    public function append($contents)
    {
        if (!isset($this->file)) {
            throw new \Exception("File property not set", 1);
        }
        
        $fh = fopen($this->file, 'a');
        fwrite($fh, $contents);
        fclose($fh);
    }

    public function prepend($contents)
    {
        if (!isset($this->file)) {
            throw new \Exception("File property not set", 1);
        }
        
        $fh = fopen($this->file, 'wr');
        $oldContents = fread($fh, filesize($this->file));
        fwrite($fh, $contents . "\n" . $oldContents);
        fclose($fh);
    }
}
