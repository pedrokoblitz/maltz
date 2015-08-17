<?php

namespace Maltz\Service;

trait FileReader
{
    public function setFile($path, $name)
    {
        $this->file = $path . '/' . $name;
    }

    public function getFile()
    {
        if (isset($this->file)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        return file_get_contents($this->file);
    }

    public function readFile()
    {
        if (isset($this->file)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $fh = fopen($this->file, 'r');
        $contents = fread($fh, filesize($this->file));
        fclose($fh);
        return $contents;
    }

    public function outputFile()
    {
        echo $this->getContents();
        return true;
    }

    public function searchFile($pattern)
    {
        $contents = $this->getFile();
        if (preg_match_all($pattern, $contents, $matches)) {
            return array('matches' => $matches, 'count' => count($matches));
        }
        return false;
    }
}
