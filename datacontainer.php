<?php

    class Event
    {
        private $issueID; 
        private $oldState;
        private $newState;

        public function __construct(int $issueID, State $oldState, State $newState)
        {
            $this->issueID = $issueID; 
            $this->oldState = $oldState; 
            $this->newState = $newState; 
        }
    }

    class State
    {
        private $orderID;
        private $stateName; 

        public function __construct(string $stateName, int $orderID)
        {
            $this->stateName = $stateName; 
            $this->orderID = $orderID;
        }

        public function getStateName()
        {
            return $stateName; 
        }

        public function getOrderID()
        {
            return $orderID; 
        }

        public function toString()
        {
            return $stateName; 
        }
    }

    class Issue
    {
        private $todo; 
        private $state;

        public function __construct(string $todo, State $state)
        {
            $this->todo = $todo; 
            $this->state = $state; 
        }

        public function updateState(State $state)
        {
            $this->state = $state; 
        }

        public function toString()
        {
            return '' . $todo . ' | ' . $state->toString();
        }
    }

    class DataContainer
    {
        private $states;
        private $transitions;
        private $issues;

        public function __construct()
        {
            $states = array();
            $transitions = array();
            $issues = array();
        }

        public function addState(string $stateName, int $orderID) 
        {
            if( $stateName == null)
            {
                throw new Exception('state name is invalid');
            }

            foreach ($states as $s)            
            {
                if ($s->getOrderID() == $orderID)
                {
                    // TODO: move in between and do not throw error here
                    throw new Exception('order id taken');
                }
            }

            $state = new State($stateName, $orderID);            
            $states[] = $state;
        }

        public function removeState()
        {

        }

        public function getNextStateOrderID()
        {
            return null; 
        }

        public function getNextState(State $currentState)
        {
            return null;
        }

        public function printStates()
        {
            
        }

        public function processEvent(Event $event)
        {

        }
    }

?>
