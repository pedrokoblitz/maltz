<?php

namespace Maltz\Http;

use Deck\Security\Encryption;

final class SessionHandler
{
    /**
     * Path to save the sessions to
     * @var string
     */
    private $savePathRoot = '/tmp';

    /**
     * Save path of the saved path
     * @var string
     */
    private $savePath = '';

    private $encryption;

    /**
     * Init the object, set up the session config handling
     *
     * @return null
     */
    public function __construct(Encryption $encryption)
    {
        $this->encryption = $encryption;

        session_set_save_handler(

            array($this, "open"), 
            array($this, "close"),  
            array($this, "read"),
            array($this, "write"), 
            array($this, "destroy"), 
            array($this, "gc")
        );

        $this->savePathRoot = ini_get('session.save_path');
    }

    /**
     * Write to the session
     *
     * @param integer $id   Session ID
     * @param mixed   $data Data to write to the log
     * @return null
     */
    public function write($id, $data)
    {
        $path = $this->savePathRoot.'/'.$id;
        $data = $this->encryption->encrypt($data);

        file_put_contents($path, $data);
    }

    /**
     * Read in the session
     *
     * @param string $id Session ID
     * @return null
     */
    public function read($id)
    {
        $path = $this->savePathRoot.'/'.$id;
        $data = null;

        if (is_file($path)) {

            $data = file_get_contents($path);
            $data = $this->encryption->decrypt($data);
        }

        return $data;
    }

    /**
     * Open the session
     *
     * @param string $savePath  Path to save the session file locally
     * @param string $sessionId Session ID
     * @return null
     */
    public function open($savePath, $sessionId)
    {
        // open session, do nothing by default
    }

    /**
     * Close the session
     *
     * @return boolean Default return (true)
     */
    public function close()
    {
        return true;
    }

    /**
     * Perform garbage collection on the session
     *
     * @param int $maxlifetime Lifetime in seconds
     * @return null
     */
    public function gc($maxlifetime)
    {
        $path = $this->savePathRoot . '/*';

        foreach (glob($path) as $file) {

            if (filemtime($file) + $maxlifetime < time() && file_exists($file)) {
            
                unlink($file);
            }
        }

        return true;
    }

    /**
     * Destroy the session
     *
     * @param string $id Session ID
     * @return null
     */
    public function destroy($id)
    {
        $path = $this->savePathRoot.'/'.$id;

        if (is_file($path)) {
        
            unlink($path);
        }
        
        return true;
    }
}
