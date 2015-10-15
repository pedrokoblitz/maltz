<?php

namespace Maltz\Service;

trait FileWriter
{
    /**
     * /
     * @param [type] $name [description]
     * @param [type] $patj [description]
     */
    public function setFile($name, $patj)
    {
        $this->file = rtrim($path, '/') . '/' . $name;
    }

    /**
     * /
     * @param  [type] $contents [description]
     * @return [type]           [description]
     */
    public function write($contents)
    {
        if (!isset($this->file)) {
            throw new \Exception("File property not set", 1);
        }

        $fh = fopen($this->file, 'w');
        fwrite($fh, $contents);
        fclose($fh);
    }

    /**
     * /
     * @param  [type] $contents [description]
     * @return [type]           [description]
     */
    public function append($contents)
    {
        if (!isset($this->file)) {
            throw new \Exception("File property not set", 1);
        }
        
        $fh = fopen($this->file, 'a');
        fwrite($fh, $contents);
        fclose($fh);
    }

    /**
     * /
     * @param  [type] $contents [description]
     * @return [type]           [description]
     */
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
