<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductField;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        //получаем доп поля
        $product_fields_headers = [];
        $main_fields = [
            'external_code'=>0,
            'name'=>0,
            'description'=>0,
            'price'=>0,
        ];
        foreach ($rows->first() as $key=>$column) {
            if(str_contains($column, "Доп. поле:")){
                //удаляем пробел вначале
                $product_fields_headers[$key] = ltrim(str_replace("Доп. поле:","",$column));
            }
            if(str_contains($column, "Наименование")){
                $main_fields['name'] = $key;
            }
            if(str_contains($column, "Описание")){
                $main_fields['description'] = $key;
            }
            if(str_contains($column, "Внешний код")){
                $main_fields['external_code'] = $key;
            }
            if(str_contains($column, "Цена:")){
                $main_fields['price'] = $key;
            }
        }

        foreach ($rows->skip(1) as $row) {
            
            $product = Product::create([
                'external_code' => $row[$main_fields['external_code']],
                'name' => $row[$main_fields['name']],
                'description' => $row[$main_fields['description']],
                'price' => floatval($row[$main_fields['price']]),
            ]);


            $product_fields = [];
            foreach ($product_fields_headers as $key=>$table_header) {
                if($row[$key]){
                    $product_fields[] = [
                        'product_id' => $product->id,
                        'key' => $table_header,
                        'value' => $row[$key],
                    ];
                }
            }
            ProductField::insert($product_fields);
        }
    }
}
