<?php

namespace App\Imports;

use App\Requisition;
use Maatwebsite\Excel\Concerns\ToModel;

class RequisitionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
     protected $id;

    public function __construct($id) {
        $this->id = $id;
     }
    // constructor
    public function model(array $row)
    {
        return new Requisition([
            'department' => $this->id,
            'submitted_By' => $row[1],
            'approvedBy' => $row[2],
            'delivery_status' => $row[3],
            'delivered_by' => $row[4]
        ]);
    }
}
