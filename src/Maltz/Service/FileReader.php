<?php

trait FileReader
{
    public function setFile($path, $name)
    {
        $this->path = $path;
        $this->name = $name;
        $this->file = $path . '/' . $name;
    }

    public function getFile()
    {
        return file_get_contents($this->file);
    }

    public function readFile()
    {
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