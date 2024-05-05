<?php
namespace App\Filters;

use Illuminate\Http\Request;

class ProductFilters
{
    public function apply($query, Request $request)
    {
        if ($request->filled('min_price')) {
            $min = $request->min_price;
            $query->where('price', '>=', $min);
        }

        if ($request->filled('max_price')) {
            $max = $request->max_price;
            $query->where('price', '<=', $max);
        }

        if ($request->filled('znacka')) {
            $brand = $request->znacka;

            $query->where('brand', $brand);
        }

        return $query;
    }
}