<?php
class QuerySetValuesBuilder {
    public array $assignments = [];
    public array $placeholders = [];
    public array $fields = [];
    public array $values = [];

    public static function create() {
        return new self();
    }

    public function addAssignment($field, $value) {
        if ($value == "") {
            $value = "NULL";
        }
        
        $this->fields[] = $field;
        $this->placeholders[] = ":".$field;
        $this->values[] = $value;
        $this->assignments[] = $field." = ".":".$field;

        return $this;
    }

    public function getSetString() {
        $fields = implode(', ', $this->assignments);

        return "SET ".$fields;
    }

    public function getValuesFieldsString() {
        return "(".implode(', ', $this->fields).")";
    }

    public function getValuesString() {
        $values = "(".implode(', ', $this->placeholders).")";

        return "VALUES ".$values;
    }
}