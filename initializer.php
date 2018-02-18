<?php 

    function shutdown()
    {
        echo "PFIAT DI!" . PHP_EOL;   
    }

    register_shutdown_function('shutdown');

    $validCommands = array();
    $validCommands[] = 'init';
    $validCommands[] = 'show';
    $validCommands[] = 'sort';
    $validCommands[] = 'group';
    $validCommands[] = 'exit';

    function tab_complete ($partial) {
        global $validCommands;
        return $validCommands;
    };

    readline_completion_function('tab_complete');

?>