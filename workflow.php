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
    require_once('demodata.php');    

    // TODO: PEAR ?
    $data = new DataContainer();

    do {

        $line = readline(date('H:i:s')." Enter command > ");        
        
        switch($line)
        {
            case 'init data':
                initializeDataContainer($data); 
                break;
            case 'show data':
                echo 'data:' . PHP_EOL . PHP_EOL;
                $outputX = $data->processData();
                echo $outputX . PHP_EOL;
                break;
            case 'clear data':
                unset($data);
                $data = new DataContainer();
                break; 
            case 'show issues':
                echo 'issues:' . PHP_EOL . PHP_EOL;
                $outputX = $data->printIssues();
                echo $outputX . PHP_EOL;
                break;
            case 'show states':
                echo 'states:' . PHP_EOL . PHP_EOL;
                $outputX = $data->printStates();
                echo $outputX . PHP_EOL;
                break;
            case 'show transitions':
                echo 'transitions:' . PHP_EOL . PHP_EOL;
                $outputX = $data->printTransitions(); 
                echo $outputX . PHP_EOL;
                break;
            case 'signal state event':
                break;
            case 'signal transition event':
                break; 
            case 'signal issue event':
                break;
            case 'test state add':
                try
                {
                    $stateX = $data->createState('teststate' . rand(1,100), rand(1,100));
                    $data->addState($stateX); 
                    $outputX = $data->printStates();
                    echo $outputX . PHP_EOL; 
                }
                catch (Exception $e)
                {
                    echo 'while processing an error occurred' . PHP_EOL; 
                    echo 'see details for more information: ' . $e->getMessage() . PHP_EOL; 
                }
                break;
            case 'test transition add':
                try
                {
                    $stateX = $data->createState('teststate' . rand(1,100), rand(1,100));
                    $data->addState($stateX);
                    $stateY = $data->createState('teststate' . rand(1,100), rand(1,100));
                    $data->addState($stateY);
                    
                    $transitionX = $data->createTransition($stateX, $stateY);
                    $data->addTransition($transitionX);
                }
                catch (Exception $e)
                {
                    echo 'while processing an error occurred' . PHP_EOL; 
                    echo 'see details for more information: ' . $e->getMessage() . PHP_EOL; 
                }
                break;
            case 'test issue add':
                try
                {
                    $stateX = $data->createState('teststate' . rand(1,100), rand(1,100));
                    $data->addState($stateX);

                    $issue = $data->createIssue('testissue', $stateX);
                    $data->addIssue($issue);
                }
                catch (Exception $e)
                {
                    echo 'while processing an error occurred' . PHP_EOL; 
                    echo 'see details for more information: ' . $e->getMessage() . PHP_EOL; 
                }
                break;
            case 'exit':
                $LASTERR = ERROR_CODE_OK;
                $RUNNING = FALSE;
                break;
            default;
                echo 'while processing an error occurred' . PHP_EOL;
                echo 'unknown command: ' . $line . PHP_EOL; 
                break;
        }

    } while($RUNNING);
    
    exit($LASTERR);

?>