<?php

namespace App\Imports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\ToModel;

class OrderImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Order([
            "order_number" => $row[0],
            "customer_name" => $row[1],
            "customer_email" => $row[2],
            "customer_phone" => $row[3],
            "delivery_date" => $row[4],
            "adresse" => $row[6],
            "category" => $row[7],
            "subCategory" => $row[8],
            "product" => $row[9],
            "qty" => $row[10],
            "payement" => $row[11],
            "branch" => $row[12],
        ]);
    }
}
