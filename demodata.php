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

        $issue1 = $data->createIssue('get new coffee machine', $state4);
        $issue2 = $data->createIssue('(re)fill beans', $state3);
        $issue3 = $data->createIssue('fill water tank', $state1);
        $issue4 = $data->createIssue('make coffee', $state2);
        $issue5 = $data->createIssue('make more coffee', $state1);
        $issue6 = $data->createIssue('turn old coffee machine off and on again', $state5);
        $issue7 = $data->createIssue('repair old coffee machine', $state5);

        $data->addIssue($issue1);
        $data->addIssue($issue2);
        $data->addIssue($issue3);
        $data->addIssue($issue4);
        $data->addIssue($issue5);
        $data->addIssue($issue6);
        $data->addIssue($issue7);
    }

?>