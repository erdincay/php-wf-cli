<?php

    function initializeDataContainer(DataContainer $data)
    {

        $state1 = $data->createState('to do', 1);
        $state2 = $data->createState('on hold', 2);
        $state3 = $data->createState('doing', 3);
        $state4 = $data->createState('done', 4);
        $state5 = $data->createState('failed', 5);

        $data->addState($state1);
        $data->addState($state2);
        $data->addState($state3);
        $data->addState($state4); 
        $data->addState($state5);

        $transition1 = $data->createTransition($state1, $state3);
        $transition2 = $data->createTransition($state1, $state2);
        $transition3 = $data->createTransition($state3, $state4);
        $transition4 = $data->createTransition($state3, $state5);
        $transition5 = $data->createTransition($state3, $state2);
        $transition6 = $data->createTransition($state2, $state3);

        $data->addTransition($transition1);
        $data->addTransition($transition2);
        $data->addTransition($transition3);
        $data->addTransition($transition4);
        $data->addTransition($transition5);
        $data->addTransition($transition6);

        // $issue1 = new Issue();
        // $issue2 = new Issue();
        // $issue3 = new Issue();
        // $issue4 = new Issue();
        // $issue5 = new Issue();
        // $issue6 = new Issue();

    }

?>