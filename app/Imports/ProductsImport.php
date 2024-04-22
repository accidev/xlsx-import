<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductField;
use App\Models\ProductImage;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        set_time_limit(0);
        //получаем доп поля
        $product_fields_headers = [];
        $main_fields = [
            'external_code' => 0,
            'name' => 0,
            'description' => 0,
            'price' => 0,
            'images' => 0,
        ];
        foreach ($rows->first() as $key => $column) {
            if (str_contains($column, "Доп. поле:")) {
                //удаляем пробел вначале
                $product_fields_headers[$key] = ltrim(str_replace("Доп. поле:", "", $column));
            }
            if (str_contains($column, "Наименование")) {
                $main_fields['name'] = $key;
            }
            if (str_contains($column, "Описание")) {
                $main_fields['description'] = $key;
            }
            if (str_contains($column, "Внешний код")) {
                $main_fields['external_code'] = $key;
            }
            if (str_contains($column, "Цена:")) {
                $main_fields['price'] = $key;
            }
            if (str_contains($column, "Ссылки на фото")) {
                $main_fields['images'] = $key;
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
            foreach ($product_fields_headers as $key => $table_header) {
                if ($row[$key]) {
                    $product_fields[] = [
                        'product_id' => $product->id,
                        'key' => $table_header,
                        'value' => $row[$key],
                    ];
                }
            }

            if ($row[$main_fields['images']]) {
                $product_images_urls = explode(", ", $row[$main_fields['images']]);
                $product_images = [];
                foreach ($product_images_urls as $url) {
                    $image = [
                        'product_id' => $product->id,
                        'url' => $url
                    ];

                    try {

                        $file = fopen($url, "r");

                        if ($file) {
                            $file_path = 'products/images/' . time() . '_' . basename($url);
                            Storage::disk('public')->put($file_path, $file);
                            $image['path'] = "/" . $file_path;

                            $product_images[] = $image;
                        }
                    } catch (Exception $ex) {
                    }
                }

                ProductImage::insert($product_images);
            }

            ProductField::insert($product_fields);
            set_time_limit(120);
        }
    }
}
