<?php 

    function shutdown()
    {
        echo "PFIAT DI!" . PHP_EOL;   
    }

    register_shutdown_function('shutdown');

    $validCommands = array();
    $validCommands[] = 'init data';
    $validCommands[] = 'show data';
    $validCommands[] = 'clear data';
    $validCommands[] = 'show issues';
    $validCommands[] = 'show states';
    $validCommands[] = 'show transitions';    
    $validCommands[] = 'test state add';
    $validCommands[] = 'test transition add';
    $validCommands[] = 'test issue add';
    $validCommands[] = 'exit';

    echo PHP_EOL;
    echo "WELCOME TO THE DEMONSTRATIONAL WORKFLOW PROCESSING CLI CLIENT" . PHP_EOL;
    echo PHP_EOL;

    $commands = implode(" | ", $validCommands);
    echo "commands: " . $commands . PHP_EOL;
    echo PHP_EOL;

    function tab_complete ($partial) {
        global $validCommands;
        return $validCommands;
    };

    readline_completion_function('tab_complete');

?>