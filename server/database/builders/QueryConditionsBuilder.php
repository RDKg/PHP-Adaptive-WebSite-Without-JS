<?php
class QueryConditionsBuilder {
    public array $conditions = [];
    public array $placeholders = [];
    public array $values = [];
    public array $fields = [];

    private bool $closedSeparate = true;

    public static function create() {
        return new self();
    }
    
    private function addCondition($prefix, $field, $operator, $value) {
        if ($value == "") {
            $value = "NULL";
        }
        
        if (end($this->conditions) === "(") {
            $position = count($this->conditions) - 1;

            array_splice($this->conditions, $position, 0, $prefix);
        }
        else {
            $this->conditions[] = $prefix;
        }
        
        $this->conditions[] = "$field $operator :$field";
        $this->placeholders[] = ":".$field;
        $this->values[] = $value;
        $this->fields[] = $field;

        return $this;
    }

    public function where($field, $operator, $value) {
        $this->addCondition("", $field, $operator, $value);
        
        return $this;
    }

    public function andWhere($field, $operator, $value) {
        $this->addCondition("AND", $field, $operator, $value);

        return $this;
    }

    public function orWhere($field, $operator, $value) {
        $this->addCondition("OR", $field, $operator, $value);

        return $this;
    }

    public function openSeparate() {
        $this->conditions[] = "(";
        $this->closedSeparate = false;

        return $this;
    }
    
    public function closeSeparate() {
        $this->conditions[] = ")";
        $this->closedSeparate = true;

        return $this;
    }

    public function getString() {
        if (!$this->closedSeparate) {
            $this->closeSeparate();
        }
        
        if (!empty($this->conditions)) {
            return "WHERE".implode(' ', $this->conditions);
        }
        
        return "";
    }
}