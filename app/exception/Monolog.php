<?php 
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
class Monolog{
     private $log;
    public function __construct(){ // debug, info, notice, warning, error, critical, alert, emergency
        $this->log = new Logger('logger');
        $this->log->pushHandler(new StreamHandler(__DIR__  . '/logfile.log', Level::Warning));
        return $this->log;
    }

    public function warning(string $message) {
        return $this->log->warning($message);
    }

    public function error(string $message) {
        return $this->log->error($message);
    }

    public function notice(string $message) {
        return $this->log->notice($message);
    }

    public function info(string $message) {
        return $this->log->info($message);
    }

}

?>