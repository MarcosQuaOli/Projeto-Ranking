<?php

if(session_status() !== PHP_SESSION_ACTIVE) {	
    session_start();
}

(require __DIR__ . '/config/bootstrap.php')->run();