<?php

namespace App\Filters\V1;
use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CustomerFilter extends ApiFilter{ 
    protected $safeParams = [
            'name' => ['eq'],
            'type' => ['eq'],
            'email' =>['eq'],
            'address' => ['eq'],
            'city' => ['eq'],
            'state' => ['eq'],
            'postalCode' => ['eq','gt','lt'],
    ];

    protected $columnMap = [
        'name' => 'name',
        'type' => 'type',
        'email' => 'email',
        'address' => 'address',
        'city' => 'city',
        'state' => 'state',
        'postalCode' => 'postal_code',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'gt' => '>',
        'lt' => '<',
        'lte' => '<=',
        'gte' => '>=',
    ];


}