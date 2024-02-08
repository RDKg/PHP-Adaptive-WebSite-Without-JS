<?php
function consoleLog($message, $tabs=1) {
    $stream = fopen('php://stdout', 'w');
    $tabsStr = str_repeat("    ", $tabs);
    
    fwrite($stream, $tabsStr.$message."\n");
}