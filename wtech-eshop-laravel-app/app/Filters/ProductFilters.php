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

        if ($request->filled('cpu-cores')) {
            $cores = $request->input('cpu-cores');
            $query->whereHas('parameters', function ($query) use ($cores) {
                $query->where('name', 'Počet jadier')->where('value', $cores);
            });
        }

        if ($request->filled('min_mem')) {
            $min = $request->min_mem;
            $query->wherehas('parameters', function ($query) use ($min) {
                $query->where('name', 'Veľkosť pamäte')->whereRaw('CAST(value AS UNSIGNED) >= ?', $min);
            });
        }

        if ($request->filled('max_mem')) {
            $max = $request->max_mem;
            $query->wherehas('parameters', function ($query) use ($max) {
                $query->where('name', 'Veľkosť pamäte')->whereRaw('CAST(value AS UNSIGNED) <= ?', $max);
            });
        }
        
        if ($request->filled('ram-type')) {
            $type = $request->input('ram-type');
            $query->wherehas('parameters', function ($query) use ($type) {
                $query->where('name', 'Typ')->where('value', $type);
            });
        }

        if ($request->filled('format')){
            $format = $request->input('format');
            $query->wherehas('parameters', function ($query) use ($format) {
                $query->where('name', 'Formát')->where('value', $format);
            });
        }

        if ($request->filled('disk_type')){
            $disk_type = $request->input('disk_type');
            $query->wherehas('parameters', function ($query) use ($disk_type) {
                $query->where('name', 'Typ')->where('value', $disk_type);
            });
        }


        if ($request->filled('min_rpm')) {
            $min = $request->min_rpm;
            $query->wherehas('parameters', function ($query) use ($min) {
                $query->where('name', 'Rýchlosť')->whereRaw('CAST(value AS UNSIGNED) >= ?', $min);
            });
        }

        if ($request->filled('max_rpm')) {
            $max = $request->max_rpm;
            $query->wherehas('parameters', function ($query) use ($max) {
                $query->where('name', 'Rýchlosť')->whereRaw('CAST(value AS UNSIGNED) <= ?', $max);
            });
        }

        return $query;
    }
}