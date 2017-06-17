<?php

interface iSalary
{
    public function salary(float $zp, int $hours):float;
}

class TimeSalary implements iSalary
{
    public function salary(float $zp, int $hours):float
    {
        return $zp*$hours;
    }
}

class FixSalary implements iSalary
{
    public function salary(float $zp, int $hours=1):float
    {
        return $zp;
    }
}

class Worker
{
    protected $name;
    protected $surname;
    protected $patronymic;
    protected $strategy;
    protected $position;
    protected $zp;
    protected $hours;

    function __construct(
        string $name,
        string $surname,
        string $patronymic,
        string $position,
        iSalary $strategy,
        float $zp,
        int $hours=1
        ){
        $this->$name=$name;
        $this->$surname=$surname;
        $this->$patronymic=$patronymic;
        $this->$position=$position;
        $this->strategy=$strategy;
        $this->zp=$zp;
        $this->hours=$hours;
        }

    function getZP():float 
    {
        return $this->strategy->salary( $this->zp, $this->hours);
    }
}

class Designer extends Worker
{
}

class Imposer extends Worker
{
}

class Developer extends Worker
{
}

class DreamTeam
{
    private $nameTeam;
    private $arrayZP=array();
    function __construct(string $nameTeam)
    {
        $this->$nameTeam=$nameTeam;
    }

    public function getTeamZP(float $zp)
    { 
        array_push($this->arrayZP,$zp);
    }

    public function getTeamSalary():float {
        return array_sum($this->arrayZP);
    }
}

$worker1=new Designer('Кирилл','Романенко','Александрович','Дизайнер',new FixSalary(),3000);
$worker2=new Developer('Кирилл','Романенко','Александрович','Senior Developer',new TimeSalary(),10,60);
$worker3=new Developer('Кирилл','Романенко','Александрович','Middle Developer',new FixSalary(),1000);
$worker4=new Developer('Кирилл','Романенко','Александрович','Middle Developer',new FixSalary(),3000);
$worker5=new Imposer('Кирилл','Романенко','Александрович','Верстальщик',new FixSalary(),5,120);
$teamX = new DreamTeam('X');

$teamX->getTeamZP( $worker1->getZP());
$teamX->getTeamZP( $worker2->getZP());
$teamX->getTeamZP( $worker3->getZP());
$teamX->getTeamZP( $worker4->getZP());
$teamX->getTeamZP( $worker5->getZP());

echo $teamX->getTeamSalary( $worker1->getZP());


