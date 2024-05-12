<?php


namespace App\Http\Controllers;

use App\Models\Parameter;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'count' => $request->input('count'),
            'category' => $request->input('category'),
            'brand' => $request->input('brand'),
        ]);

        $images = $request->file('images');
        foreach ($images as $image)
        {
            $image_filename = basename(Storage::disk('public')->put('dbimages', $image));
            Image::create([
                'product_id' => $product->id,
                'image' => $image_filename,
            ]);
        }

        $parameters = json_decode($request->input('parameters'));
        foreach ($parameters as $key => $value)
        {
            Parameter::create([
                'product_id' => $product->id,
                'name' => $key,
                'value' => $value,
            ]);
        }

        return redirect()->back();
    }

    public function parameters(): HasMany
    {
        return $this->hasMany(Parameter::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function update_product(Request $request)
    {
        $product = Product::find($request->input('id'));
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->count = $request->input('count');
        $product->category = $request->input('category');
        $product->brand = $request->input('brand');
        $product->save();

        $local_dbimages = $product->images->toArray();
        $request_dbimages = json_decode($request->input('dbimages'));
        $local_dbimages_to_be_removed_ids = [];
        foreach ($local_dbimages as $local_dbimage)
        {
            $local_dbimage_id = $local_dbimage["id"];

            $should_be_removed = true;
            foreach ($request_dbimages as $request_dbimage)
            {
                $request_dbimage_id = $request_dbimage->id;

                if ($local_dbimage_id == $request_dbimage_id)
                {
                    $should_be_removed = false;
                    break;
                }
            }
            if ($should_be_removed)
            {
                array_push($local_dbimages_to_be_removed_ids,  $local_dbimage_id);
            }
        }
        foreach ($local_dbimages_to_be_removed_ids as $id)
        {
            $image = Image::find($id);
            $instances = Image::where('image', $image->image)->get()->count();
            if ($instances == 1)
            {
                Storage::disk('public')->delete('dbimages/'.$image->image);
            }
            $image->delete();
        }

        $images = $request->file('images');
        if (isset($images))
        {
            foreach ($images as $image)
            {
                $image_filename = basename(Storage::disk('public')->put('dbimages', $image));
                Image::create([
                    'product_id' => $product->id,
                    'image' => $image_filename,
                ]);
            }
        }

        $parameters = json_decode($request->input('parameters'));
        Parameter::where('product_id', $request->input('id'))->delete();
        foreach ($parameters as $key => $value)
        {
            Parameter::create([
                'product_id' => $request->input('id'),
                'name' => $key,
                'value' => $value,
            ]);
        }

        return redirect()->back();
    }

    public function fetch($id)
    {
        $product = Product::with(['parameters', 'images'])->find($id);
        return response()->json($product);
    }

    public function remove($id)
    {
        $product = Product::find($id);

        Parameter::where('product_id', $id)->delete();

        foreach ($product->images as $image)
        {
            $instances = Image::where('image', $image->image)->get()->count();
            if ($instances == 1)
            {
                Storage::disk('public')->delete('dbimages/'.$image->image);
            }
            $image->delete();
        }

        $product->delete();

        return redirect()->back();
    }
}
