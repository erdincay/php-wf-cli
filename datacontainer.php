<?php

    class Event
    {
        // TODO: create base event and sub-classes
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

    class Transition
    {
        private $source;
        private $destination; 

        public function __construct(State $source, State $destination)
        {
            $this->source = $source;
            $this->destination = $destination;             
        }

        public function getSource()
        {
            return $this->source;
        }

        public function getDestination()
        {
            return $this->destination;
        }

        public function isValid()
        {
            if (($this->source !== $this->destination) && ($this->source != $this->destination))
            {
                if (($this->source)->getStateName() != ($this->destination)->getStateName()
                    && ($this->source)->getOrderID() != ($this->destination)->getOrderID())
                {
                    return true;
                }       
            }
            return false;
        }

        public function toString()
        {
            return '' . ($this->source)->toString() . ' -> ' . ($this->destination)->toString();
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

        public function getTodo()
        {
            return $this->todo; 
        }

        public function getState()
        {
            return $this->state;
        }

        public function isValid()
        {
            if (!empty($this->todo) && !empty($this->state) && ($this->state)->isValid())
            {
                return true; 
            }
            return false; 
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

            foreach ($this->states as &$s)
            {
                if ($this->compareS($state,$s))
                {
                    throw new Exception('state already exists');
                }
            }

            $this->states[] = $state;
        }

        public function removeState(State $state)
        {
            if (empty($state) || !$state->isValid())
            {
                throw new Exception('state is invalid');
            }

            for ($i = 0; $i < $this->countStates(); $i++)
            {
                $s = $this->states[$i];

                // TODO: object comparison ? 

                if (strcmp($state->getStateName(), $s->getStateName()) == 0
                    && ($state->getOrderID() == $s->getOrderID()))
                {
                    unset($this->states[$i]);
                    break;
                }
            }
        }

        public function sortStates()
        {
            usort($this->states, array($this, 'sortS'));
        }

        public function sortS(State $stateA, State $stateB)
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

        public function compareS(State $stateA, State $stateB)
        {
            if (!empty($stateA) && !empty($stateB))
            {
                if ($stateA->getStateName() == $stateB->getStateName())
                {
                    return true; 
                }
            }
            return false;
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

        // BEGIN -------- Transitions -----------------

        public function countTransitions() 
        {
            return count($this->transitions);
        }

        public function createTransition(State $source, State $destination)
        {
            if (empty($source) || empty($destination)
                || !($source->isValid()) || !($destination->isValid()))
            {
                throw new Exception('transition source or destination is invalid'); 
            }

            $transition = new Transition($source, $destination);

            if (!$transition->isValid())
            {
                throw new Exception('transition state constellation is invalid'); 
            }
            
            return $transition;
        }

        public function addTransition(Transition $transition)
        {
            if (empty($transition) || !($transition->isValid()))
            {
                throw new Exception('transition invalid');
            }

            $this->transitions[] = $transition;
        }

        public function removeTransition(Transition $transition)
        {
            if (empty($transition)) 
            {
                throw new Exception('transition invalid');
            }

            for ($i = 0; $i < $this->countTransitions(); $i++)
            {
                $t = $this->transitions[$i];

                if ($t === $transition || 
                   ($t->getSource() == $transition->getSource()
                   && $t->getDestination() == $transition->getDestination()))
                {
                    unset($this->transitions[$i]);
                    break;
                }
            }
        }

        public function printTransitions()
        {
            $output = '';
            // $this->sortTransitions();

            for ($i = 0; $i < $this->countTransitions(); $i++)
            {
                $transition = $this->transitions[$i];
                $output .= '(' . $i . ') ' . $transition->toString() . PHP_EOL; 
            }

            return $output;
        }

        // END ---------- Transitions -----------------

        // BEGIN -------- Issues ----------------------

        public function countIssues()
        {
            return count($this->issues);
        }

        public function createIssue(string $todo, State $state)
        {
            if (empty($todo) || empty($state) || !($state->isValid()))
            {
                throw new Exception('issue parameters are invalid');
            }

            $found = false;
            foreach ($this->states as &$s)
            {
                if ($this->compareS($state,$s))
                {
                    $found = true; 
                }
            }

            if (!$found)
            {
                throw new Exception('issue state is not in valid states list'); 
            }

            $issue = new Issue($todo, $state);            
            return $issue; 
        }

        public function addIssue(Issue $issue)
        {
            if (empty($issue) || !($issue->isValid()))
            {
                throw new Exception('issue is invalid');
            }

            $found = false;
            foreach ($this->issues as $i)
            {
                if ($i === $issue || ($i->getTodo() == $issue->getTodo()))
                {
                    $found = true; 
                }
            }

            if ($found)
            {
                throw new Exception('issue already exists');
            }

            $this->issues[] = $issue;
        }

        public function sortIssues()
        {
            usort($this->issues, array($this, 'sortI'));
        }

        public function sortI(Issue $issueA, Issue $issueB)
        {
            if (!empty($issueA) && !empty($issueB))
            {
                if ($issueA->getTodo() < $issueB->getTodo())
                {
                    return -1; 
                }
                else if ($issueA->getTodo() > $issueB->getTodo())
                {
                    return +1; 
                }
                return 0;
            }
            return 0;
        }

        public function printIssues()
        {
            $output = '';
            $this->sortIssues();

            for ($i = 0; $i < $this->countIssues(); $i++)
            {
                $issue = $this->issues[$i];
                $output .= '(' . $i . ') ' . $issue->toString() . PHP_EOL; 
            }

            return $output;
        }

        // END ---------- Issues ----------------------

        // BEGIN -------- Events ----------------------

        public function processEvent(Event $event)
        {
            // TODO: write processing logic for state/transition/issue changes
        }

        // END ---------- Events ----------------------
        
        // BEGIN -------- Data ------------------------

        public function processData()
        {
            $this->sortStates();
            $this->sortIssues();

            $output = '';
            for ($i = 0; $i < $this->countStates(); $i++)
            {
                $state = $this->states[$i];
                $output .= $state->toString() . PHP_EOL; 

                for ($k = 0; $k < $this->countIssues(); $k++)
                {
                    $issue = $this->issues[$k];
                    if (($issue->getState())->getStateName() == $state->getStateName())
                    {
                        $output .= ' - ' . '(' . $k . ') ' . $issue->getTodo() . PHP_EOL; 
                    }
                }
            }

            return $output;
        }

        // END ---------- Data ------------------------
    }

?>
