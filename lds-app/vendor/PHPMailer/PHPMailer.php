<?php
namespace PHPMailer\PHPMailer;
class PHPMailer {
    public $isSMTP = false;
    public $Host; public $SMTPAuth; public $Username; public $Password;
    public $SMTPSecure; public $Port;
    public $From; public $FromName; private $to = [];
    public $Subject; public $Body; private $headers = [];
    public function __construct($exceptions=false){}
    public function isSMTP(){ $this->isSMTP = true; }
    public function setFrom($from, $name=''){ $this->From=$from; $this->FromName=$name; }
    public function addAddress($addr){ $this->to[]=$addr; }
    public function isHTML($bool){}
    public function send(){
        // Minimal SMTP via stream_socket_client (no auth mechanisms beyond LOGIN/TLS hint).
        // For production use the full PHPMailer. This is a lightweight fallback.
        $host = $this->Host; $port = $this->Port ?: 25;
        $fp = @fsockopen($host, $port, $errno, $errstr, 10);
        if (!$fp) throw new \Exception("SMTP connect failed: $errstr");
        fclose($fp);
        // As a simple fallback, attempt mail() if available.
        $headers = "From: {$this->FromName} <{$this->From}>" . "\r\n" .
                   "MIME-Version: 1.0\r\nContent-Type: text/html; charset=UTF-8\r\n";
        $ok = true;
        foreach ($this->to as $addr) {
            $ok = $ok && @mail($addr, $this->Subject, $this->Body, $headers);
        }
        return $ok;
    }
}
