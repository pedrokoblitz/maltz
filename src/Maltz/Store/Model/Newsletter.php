<?php

class Newsletter {

    private $db;
    private $recipients;
    private $postman;

    public function __construct($db, $postman) {
        $this->db = $db;
        $this->postman = $postman;
    }

    public function findRecipientes() {
        $sql = "SELECT email,name FROM customers;";
        $this->recipients = $this->db->run($sql);
    }

    public function send($assunto, $body) {
        foreach ($this->recipients as $email => $name) {
            $this->postman->($email, $name);
        }
    }
}

?>
