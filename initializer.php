<?php 

    function shutdown()
    {
        // TODO: persist data 
        echo PHP_EOL . "PFIAT DI!" . PHP_EOL;
    }

    register_shutdown_function('shutdown');

    $validCommands = array();
    $validCommands[] = 'init data';
    $validCommands[] = 'show data';
    $validCommands[] = 'clear data';
    $validCommands[] = 'show issues';
    $validCommands[] = 'show states';
    $validCommands[] = 'show transitions';
    $validCommands[] = 'signal state event';
    $validCommands[] = 'signal transition event';
    $validCommands[] = 'signal issue event';
    $validCommands[] = 'test state add';
    $validCommands[] = 'test transition add';
    $validCommands[] = 'test issue add';
    $validCommands[] = 'exit';

    echo PHP_EOL;
    echo "WELCOME TO THE WORKFLOW-BASED ISSUE-MANAGEMENT CLI" . PHP_EOL;
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