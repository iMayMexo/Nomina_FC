<?php
    require_once __DIR__ . '/helpers.php';

    class Players 
    {

        public $data = array();

        public $goals = array();

        public $rules = array();

        private $teamGoals = array();

        private $teamGoal = 0;

        /**
         * Players constructor. Read *.json files.
         */
        public function __construct()
        {
            $json           = file_get_contents(__DIR__ . "/data.json");
            $conf           = file_get_contents(__DIR__ . "/config.json");

            $this->data     = json_decode($json, true);
            $this->rules    = json_decode($conf, true);

            $this->setTeamGoal();

            //___($this->data);
        }


        /**
         * @param $name
         * @param $value
         */
        public function __set($name, $value)
        {
            //->TODO: Implement __set() method.
            if (property_exists($this, $name)) {
                unset($this->$name);
                $this->$name = $value;
            }
        }

        /**
         * @param $name
         * @return mixed
         */
        public function __get($name)
        {
            // TODO: Implement __get() method.
            if (property_exists($this, $name)) {
                return $this->$name;
            } else {
                return false;
            }
        }

        /**
         * @param $team
         * @param $goals
         * @return mixed
         */
        public function getGoals($team,$goals)
        {
            if (!isset($this->goals[$team]))
                $this->goals[$team] = [
                    'goals'         => 0,
                    'productivity'  => 0
                ];

            $this->goals[$team]['goals'] += $goals;

            return $this->goals[$team];
        }

        /**
         * @param $level
         * @param $goals
         * @return float
         */
        public function getIndividualProductivity($level,$goals)
        {
            try {
                if(empty($this->rules))
                    throw new \InvalidArgumentException('There are not rules to calculate the productivity');
            
                foreach ($this->rules['reglas'] as $item => $value){
                    if((string)$value['nivel'] == (string)$level)
                    {
                        //___($nivel);
                        return round(($goals / $value['meta']) * 100,2);
                    }
                }
            
            }
            catch(Exception $e){
                ___($e->getMessage());
            }
        }

        /**
         * Setup the goals to achieve by team;
         */
        public function setTeamGoal()
        {
            try {
                if(empty($this->rules))
                    throw new \InvalidArgumentException('There are not rules to calculate the productivity');
            
                foreach ($this->rules['reglas'] as $item => $value){
                    $this->teamGoal += $value['meta'];
                }
            
            }
            catch(Exception $e){
                ___($e->getMessage());
            }
        }

        /**
         * @param $level
         * @param $goals
         * @param string $team
         * @return float
        */
        public function getTeamProductivity($goals,$team = '')
        {
            try {
                if(empty($this->teamGoal))
                    throw new \InvalidArgumentException('There are not goals to calculate the productivity');

                $teamProductivity = round(($goals / $this->__get('teamGoal')) * 100,2);

                $this->goals[$team]['productivity'] = $teamProductivity;

                return $teamProductivity;

            }
            catch(Exception $e){
                ___($e->getMessage());
            }
        }
    }
?>
