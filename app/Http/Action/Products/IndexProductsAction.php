<?php

namespace App\Http\Action\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class IndexProductsAction
{
    public function handle($products)
    {
        $appUrl = config('app.url');


        foreach ($products as $key => $value) {
                $value->image_url = asset($value->image_url);
        }
       return $products;
    }
}
