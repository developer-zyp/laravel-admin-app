<?php

namespace App\Http\Responses;
use Illuminate\Database\Eloquent\Model;
class ApiParameter
{
    public $isStoreProcedure;
    public $sqlQuery;
    public $parameters;


    // public function __construct($isStoreProcedure = true, $sqlQuery = '', $parameters = [])
    // {
    //     $this->isStoreProcedure = $isStoreProcedure;
    //     $this->sqlQuery = $sqlQuery;
    //     $this->parameters = $parameters;
    // }
}
