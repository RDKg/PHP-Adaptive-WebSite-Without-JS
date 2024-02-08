<?php
require_once SERVER_DIR."/utils.php";

class QueryBuilder {
    public array $builders = [];

    public string $tableName;

    public function __construct(string $tableName, array $builders) {
        $this->tableName = $tableName;
        $this->builders = $builders;
    }

    private function sortBuilders(array $sort) {
        foreach ($sort as $sortIndex => $sortValue) {
            foreach ($this->builders as $builderIndex => $builderValue) {
                if (get_class($builderValue) === $sortValue) {
                    $tempValue = $this->builders[$sortIndex];
                    $this->builders[$sortIndex] = $builderValue;
                    $this->builders[$builderIndex] = $tempValue;
                }
            }
        }
    }

    private function getPlaceholderValueData() {
        $result = [];

        foreach ($this->builders as $builderIndex => $builderValue) {
            $result[$builderIndex] = [
                "placeholders" => $builderValue->placeholders,
                "values" => $builderValue->values,
                "fields" => $builderValue->fields,
            ];
        }

        return $result;
    }

    public function getUpdateQueryString() {
        $this->sortBuilders(QueryBuilderSorts::UPDATE_SORT);
        
        return implode(" ", [
            "UPDATE $this->tableName",
            $this->builders[0]->getSetString(),
            $this->builders[1]->getString()
        ]).";";
    }

    public function getUpdatePlaceholderValueData() {
        $this->sortBuilders(QueryBuilderSorts::UPDATE_SORT);
        
        return $this->getPlaceholderValueData();
    }

    public function getInsertQueryString() {
        $this->sortBuilders(QueryBuilderSorts::INSERT_SORT);

        return implode(" ", [
            "INSERT INTO $this->tableName",
            $this->builders[0]->getValuesFieldsString(),
            $this->builders[0]->getValuesString()
        ]).";";
    }

    public function getInsertPlaceholderValueData() {
        $this->sortBuilders(QueryBuilderSorts::INSERT_SORT);
        
        return $this->getPlaceholderValueData();
    }

    public function getSelectQueryString($fields="*") {
        $this->sortBuilders(QueryBuilderSorts::SELECT_SORT);
        
        return implode(" ", [
            "SELECT $fields FROM $this->tableName",
            $this->builders[0]->getString(),
        ]).";";
    }

    public function getSelectPlaceholderValueData() {
        $this->sortBuilders(QueryBuilderSorts::SELECT_SORT);
        
        return $this->getPlaceholderValueData();
    }
}