<?php
    require_once __DIR__ . '/helpers.php';

    class Players 
    {
        /**
         * Main data from data.json
         * @var array|mixed
         */
        public $data = array();
        /**
         * Rules to apply goals bonus, readed from rules.json
         * @var array|mixed
         */
        public $rules = array();
        /**
         * Temporary array to get goals and productivity grouped by teams.
         * @var array
         */
        public $teamSummary = array();


        /**
         * Players constructor. Read *.json files.
         */
        public function __construct()
        {
            try {
                $json = file_get_contents(__DIR__ . "/data.json");
                $conf = file_get_contents(__DIR__ . "/config.json");

                if (!$json || !$conf)
                    throw new Exception('Invalid json file',500);

                $this->data = json_decode($json, true);
                $this->rules = json_decode($conf, true);

                $this->setGoalsToAchieve();

                $this->setTeamSummary();

                foreach ($this->data['jugadores'] as $item => $value)
                {

                    $productivity = $this->getIndividualProductivity($value['nivel'], $value['goles']);
                    $this->setIndividualProductivity($item, $productivity);
                    $mean =$this->getMeanProductivity($value['equipo'],$productivity);
                    $this->setMeanProductivity($item,$mean);
                    $this->setTotalSalary($item,$value['sueldo'],$value['bono'],$mean);
                }

                }
            catch(Exception $e) {
                ___($e->getMessage());
            }
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
         * Setup the goals to achieve by team;
         */
        public function setGoalsToAchieve()
        {
            try {
                if(empty($this->rules))
                    throw new \InvalidArgumentException('There are not rules to calculate the productivity');

                foreach ($this->rules['reglas'] as $item => $value){
                    $this->rules['total'] += $value['meta'];
                }

            }
            catch(Exception $e){
                ___($e->getMessage());
            }
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

        public function setIndividualProductivity($item,$productivity){
            $this->data['jugadores'][$item]['productivity'] = $productivity;
        }

        public function setTeamSummary(){
            foreach ($this->data['jugadores'] as $item => $value)
            {
                $this->setTeamGoals($value['equipo'], $value['goles']);
                $this->setTeamProductivity($value['equipo'], $value['goles']);
            }
        }

        /**
         * @param $team
         * @param $goals
         * @return mixed
         */
        public function setTeamGoals($team, $goals)
        {
            if (!isset($this->teamSummary[$team]))
                $this->teamSummary[$team] = [
                    'goals'         => 0,
                    'productivity'  => 0,
                    'scored'        => 0
                ];

            $this->teamSummary[$team]['scored'] += $goals;
            $this->teamSummary[$team]['goals']   = $this->rules['total'];
            return $this->teamSummary[$team];
        }

        /**
         * @param $level
         * @param $goals
         * @param string $team
         * @return float
         */
        public function setTeamProductivity($team)
        {
            try {
                if (!isset($this->teamSummary[$team]))
                    $this->teamSummary[$team] = [
                        'goals'         => 0,
                        'productivity'  => 0,
                        'scored'        => 0
                    ];

                if(empty($this->rules['total']))
                    throw new \InvalidArgumentException('There are not goals to calculate the productivity');

                $teamProductivity = round(($this->teamSummary[$team]['scored'] / $this->rules['total']) * 100,2);

                $this->teamSummary[$team]['productivity'] = $teamProductivity;
                $this->teamSummary[$team]['goals']        = $this->rules['total'];

                return $teamProductivity;
            }
            catch(Exception $e){
                ___($e->getMessage());
            }
        }

        public function getMeanProductivity($team,$productivity){
            try {

                return round(($productivity + $this->teamSummary[$team]['productivity']) / 2);
            }
            catch (LogicException $e){
                ___($e->getMessage());
            }
        }

        public function setMeanProductivity($item,$mean){
            try {
                $this->data['jugadores'][$item]['mean'] = $mean;
            }
            catch (LogicException $e){
                ___($e->getMessage());
            }
        }

        public function setTotalSalary($item,$salary,$bonus,$mean){
            $this->data['jugadores'][$item]['total'] = $salary + (($bonus * $mean) / 100);
        }
    }
?>
