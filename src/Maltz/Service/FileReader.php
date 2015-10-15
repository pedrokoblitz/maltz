<?php

namespace Maltz\Service;


trait FileReader
{
    /**
     * /
     * @param [type] $path [description]
     * @param [type] $name [description]
     */
    public function setFile($path, $name)
    {
        $this->file = $path . '/' . $name;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function getFile()
    {
        if (isset($this->file)) {
            throw new \Exception("File property not set", 1);
        }
        
        return file_get_contents($this->file);
    }

    /**
     * /
     * @return [type] [description]
     */
    public function readFile()
    {
        if (isset($this->file)) {
            throw new \Exception("File property not set", 1);
        }
        
        $fh = fopen($this->file, 'r');
        $contents = fread($fh, filesize($this->file));
        fclose($fh);
        return $contents;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function outputFile()
    {
        echo $this->getContents();
        return true;
    }

    /**
     * /
     * @param  [type] $pattern [description]
     * @return [type]          [description]
     */
    public function searchFile($pattern)
    {
        $contents = $this->getFile();
        if (preg_match_all($pattern, $contents, $matches)) {
            return array('matches' => $matches, 'count' => count($matches));
        }
        return false;
    }
}
