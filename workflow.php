<?php

   /*
    * projectname:  sclable workflow php cli 
	* author:       erdincay
	* created on:   2018-02-18
	* filename:     workflow.php
	*
	* comments:     demonstrational workflow processing cli client
    */

    declare(strict_types=1);
    set_time_limit(0);    

    define('ERROR_CODE_OK', 0); // success, exiting without errors 
    define('ERROR_CODE_GE', 1); // general error
    define('ERROR_CODE_IU', 2); // incorrect/inproper usage
    define('SLEEP_TIME_MS', 9); // sleep time in miliseconds 

    // TODO: PHP CLI SAPI (?)    
    $RUNNING = TRUE;
    $LASTERR = ERROR_CODE_GE;

    // TODO: upgrade to auto-loader by using psr4 auto-loading feature 
    require_once('initializer.php');
    require_once('datacontainer.php');

    $data = new DataContainer();

    do {

        $line = readline(date('H:i:s')." Enter command > ");        
        
        switch($line)
        {
            case 'init data':
                break;
            case 'show':
                break;
            case 'sort':
                break;
            case 'group':
                break;
            case 'test state add':
                try 
                {
                    $stateX = $data->createState('teststate1', rand(1,100));
                    $data->addState($stateX); 
                    $outputX = $data->printStates();
                    echo $outputX . PHP_EOL; 
                }
                catch (Exception $e)
                {
                    echo 'while processing an eror occured' . PHP_EOL; 
                    echo 'see details for more information: ' . $e->getMessage() . PHP_EOL; 
                }
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