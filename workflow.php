<?php

   /*
    * projectname:  sclable workflow php cli 
	* author:       erdincay
	* created on:   2018-02-18
	* filename:     workflow.php
	*
	* comments:     demonstrational workflow processing cli client
    */

    set_time_limit(0);

    define('ERROR_CODE_OK', 0); // success, exiting without errors 
    define('ERROR_CODE_GE', 1); // general error
    define('ERROR_CODE_IU', 2); // incorrect/inproper usage
    define('SLEEP_TIME_MS', 9); // sleep time in miliseconds 

    // TODO: PHP CLI SAPI (?)    
    $RUNNING = TRUE;
    $LASTERR = ERROR_CODE_GE;

    // TODO: upgrade to auto-loader by using psr4 auto-loading feature 
    include_once('initializer.php');
    require_once('datacontainer.php');

    echo PHP_EOL;
    echo "WELCOME TO THE DEMONSTRATIONAL WORKFLOW PROCESSING CLI CLIENT" . PHP_EOL;
    echo PHP_EOL;
    echo "commands: | [init] data | [show] data | [sort] data |" . PHP_EOL;
    echo "commands: | [group] by state | [exit] application |" . PHP_EOL;
    echo PHP_EOL;

    do {
        
        $line = readline(date('H:i:s')." Enter command > ");        
        
        switch($line)
        {
            case 'init':
                break;
            case 'show':
                break;
            case 'sort':
                break;
            case 'group':
                break;
            case 'exit':
                $LASTERR = ERROR_CODE_OK;
                $RUNNING = FALSE;
                break;
            default;
                echo "unknown command" . PHP_EOL;
                break;
        }

    } while($RUNNING);
    
    exit($LASTERR);

?>