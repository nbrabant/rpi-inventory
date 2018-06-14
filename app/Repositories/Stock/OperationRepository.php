<?php

namespace App\Repositories\Stock;

use Carbon\Carbon;
use App\Repositories\Repository;

class OperationRepository extends Repository
{
    public function model() {
        return \App\Models\Operation::class;
    }

    public function initialize()
    {
        return new $this->model([
            'detail' => ''
        ]);
    }
}
