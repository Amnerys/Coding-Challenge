<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductPreview implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $importPreview = new Product([
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
        }
    }
}
