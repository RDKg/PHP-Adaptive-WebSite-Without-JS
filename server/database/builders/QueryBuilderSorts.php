<?php

class QueryBuilderSorts {
    const UPDATE_SORT = [
        QuerySetValuesBuilder::class, 
        QueryConditionsBuilder::class
    ];
    const INSERT_SORT = [
        QuerySetValuesBuilder::class
    ];
    const SELECT_SORT = [
        QueryConditionsBuilder::class
    ];
}