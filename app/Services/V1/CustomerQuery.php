<?php

namespace App\Services\V1;

use Illuminate\Http\Request;

class CustomerQuery{
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

    public function transform(Request $request): array
    {
        $eloQuery = [];
        foreach ($this->safeParams as $parm => $operators){
            $query = $request->query($parm);
            // query ['eq' => '20', 'lte' => '30']
            if (!isset($query)){
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach($operators as $operator){
                if (isset($query[$operator])){
                    // ['column', 'operator', 'value']
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
        return $eloQuery;
    }
}