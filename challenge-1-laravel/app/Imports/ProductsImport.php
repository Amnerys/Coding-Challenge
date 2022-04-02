<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $product = new Product([
            'article_number'        => $row[0],
            'article_name'          => $row[1],
            'manufacturer'          => $row[2],
            'description'           => $row[3],
            'article_information'   => $row[4],
            'gender'                => $row[5],
            'product_type'          => $row[6],
            'sleeves'               => $row[7],
            'legs'                  => $row[8],
            'collar'                => $row[9],
            'manufacture'           => $row[10],
            'bag_type'              => $row[11],
            'grammage'              => $row[12],
            'material'              => $row[13],
            'country_of_origin'     => $row[14],
            'image_name'            => $row[15],
        ]);

        return $product;
    }

    //We have to establish the delimiter
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ","
        ];
    }

    public function uniqueBy()
    {
        return 'reference';
    }

}