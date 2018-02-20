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
            return $this->stateName; 
        }

        public function getOrderID()
        {
            return $this->orderID; 
        }

        public function toString()
        {
            return '[' . $this->orderID . '] ' . $this->stateName; 
        }

        public function isValid()
        {
            return !empty($this->stateName);
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
            return '' . $this->todo . ' | ' . ($this->state)->toString();
        }
    }

    class DataContainer
    {
        private $states;
        private $transitions;
        private $issues;

        public function __construct()
        {
            $this->states = array();
            $this->transitions = array();
            $this->issues = array();
        }

        // BEGIN -------- States ----------------------

        public function countStates()
        {
            return count($this->states);
        }

        public function createState(string $stateName, int $orderID)
        {
            if (empty($stateName))
            {
                throw new Exception('state name is invalid');
            }
            
            foreach ($this->states as &$s)
            {
                if ($s->getOrderID() == $orderID)
                {
                    // TODO: move in between and do not throw error here
                    throw new Exception('order id taken');
                }
            }
            $state = new State($stateName, $orderID);
            return $state; 
        }

        public function addState(State $state) 
        {
            if (empty($state) || !($state->isValid()))
            {
                throw new Exception('state is invalid');
            }

            // TODO: orderID issue, move in between 

            $this->states[] = $state;
        }

        public function removeState(State $stateA)
        {
            if (empty($state) || !$state->isValid())
            {
                throw new Exception('state is invalid');
            }

            for ($i = 0; $i < $this->countStates(); $i++)
            {
                $stateB = $this->states[$i];

                // TODO: object comparison ? 
                if (strcmp($stateA->getStateName(), $stateB->getStateName()) == 0
                   && ($stateA->getOrderID() == $stateB->getOrderID()))
                {
                    unset($this->states[$i]);
                    break;
                }
            }
        }

        public function sortStates()
        {
            uasort($this->states, array($this, 'sorterS'));
        }

        public function sorterS(State $stateA, State $stateB)
        {
            if (!empty($stateA) && !empty($stateB))
            {
                if ($stateA->getOrderID() < $stateB->getOrderID())
                {
                    return -1; 
                }
                else if ($stateA->getOrderID() > $stateB->getOrderID())
                {
                    return +1; 
                }
                return 0;
            }
            return 0;
        }

        public function printStates()
        {
            $output = '';
            $this->sortStates();

            for ($i = 0; $i < $this->countStates(); $i++)
            {
                $state = $this->states[$i];
                $output .= '(' . $i . ') ' . $state->toString() . PHP_EOL; 
            }

            return $output;
        }

        public function getNextStateOrderID()
        {
            return null; 
        }

        public function getNextState(State $currentState)
        {
            return null;
        }

        // END ---------- States ----------------------

        // BEGIN -------- Events ----------------------

        public function processEvent(Event $event)
        {
            // TODO: write processing logic 
        }

        // END ---------- Events ----------------------
    }

?>
