<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter { 
    protected $safeParams = [];

    protected $columnMap = [];

    protected $operatorMap = [];

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