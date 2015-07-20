<?php

namespace Maltz\Service;

trait FileWriter
{
    public function setFile()
    {
        $this->name = $name;
        $this->path = rtrim($path, '/');
        $this->file = rtrim($path, '/') . '/' . $name;
    }

    public function write($contents)
    {
        $fh = fopen($this->file, 'w');
        fwrite($fh, $contents);
        fclose($fh);
    }

    public function append($contents)
    {
        $fh = fopen($this->file, 'a');
        fwrite($fh, $contents);
        fclose($fh);
    }

    public function prepend($contents)
    {
        $fh = fopen($this->file, 'wr');
        $oldContents = fread($fh, filesize($this->file));
        fwrite($fh, $contents . "\n" . $oldContents);
        fclose($fh);
    }
}
