<?php
namespace Dellysse\Utility;

class Cycle {
    public static function cycle ($lower, $upper, $step = 1) {
        static $cyclers;
        if (!$cyclers) {
            $cyclers = array();
        }

        if(!isset($cyclers[$lower][$upper][$step])) {
            $cyclers[$lower][$upper][$step] = new Cycle($lower, $upper, $step);
        }

        return $cyclers[$lower][$upper][$step]();
    }

    public function __construct ($lower, $upper, $step = 1) {
        $this->setLower($lower);
        $this->setUpper($upper);
        $this->setStep($step);
        $this->setCurrent($this->getLower());
    }

    protected $lower;
    public function getLower () {
        return $this->lower;
    }
    public function setLower ($lower) {
        $this->lower = $lower;
    }

    protected $upper;
    public function getUpper () {
        return $this->upper;
    }
    public function setUpper ($upper) {
        $this->upper = $upper;
    }

    protected $step;
    public function getStep () {
        return $this->step;
    }
    public function setStep ($step) {
        $this->step = $step;
    }

    protected $current;
    protected function getCurrent () {
        return $this->current;
    }
    protected function setCurrent ($current) {
        $current = $current % ($this->getUpper() + 1);
        if ($current < $this->getLower()) {
            $current = $this->getLower();
        }
        $this->current = $current;
    }

    public function __invoke () {
        $retval = $this->getCurrent();
        $this->setCurrent($retval + $this->getStep());
        return $retval;
    }
}
