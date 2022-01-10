<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Web;
use Storage;
use Alert;
use Str;

class ProductBackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['product'] = Product::paginate(8);
        $data['category'] = Category::all();
        $data['web'] = Web::all();
        return view('back.product.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function filter(Request $request)
    {
        if($request->category_id && $request->category_id != 'all') {
            $data['product'] = Product::where('category_id', '=', $request->category_id)->paginate(8);
            $data['category'] = Category::all();
            $data['web'] = Web::all();

            $filter_value = $request->category_id;

            return view('back.product.data', $data, ['filter_value' => $filter_value]);

        } else if ($request->category_id == 'all') {
            return redirect()->route('products.index');
        }
    }
    public function create()
    {
        $data['web'] = Web::all();
        $data['category'] = Category::all();
        return view('back.product.create', $data);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required',
        ],
        [
            'name.required' => 'Nama Product harus di isi.',
            'name.unique' => 'Nama Product sudah tersedia.',
            'price.required' => 'Harga harus di isi.',
            'description.required' => 'Deskripsi harus di isi.',
            'image.required' => 'Gambar harus di isi.',
        ]);

        $image = ($request->image) ? $request->file('image')->store("/public/input/products") : null;
        
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'description' => $request->description,
            'image' => $image,
            'category_id' => $request->category_id,
        ];

        Product::create($data)
        ? Alert::success('Berhasil', 'Product telah berhasil ditambahkan!')
        : Alert::error('Error', 'Product gagal ditambahkan!');

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['product'] = Product::find($id);
        $data['web'] = Web::all();
        $data['category'] = Category::all();
        return view('back.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'edit_name' => "required|unique:products,name,$product->id",
            'edit_price' => 'required',
            'edit_description' => 'required',
        ],
        [
            'edit_name.required' => 'Nama Product harus di isi.',
            'edit_name.unique' => 'Nama Product sudah tersedia.',
            'edit_price.required' => 'Harga harus di isi.',
            'edit_description.required' => 'Deskripsi harus di isi.',
        ]);


        if($request->hasFile('edit_image')) {
            if(Storage::exists($product->image) && !empty($product->image)) {
                Storage::delete($product->image);
            }

            $edit_image = $request->file("edit_image")->store("/public/input/products");
        }
        $data = [
            'name' => $request->edit_name ? $request->edit_name : $product->name,
            'slug' => Str::slug($request->edit_slug) ? Str::slug($request->edit_slug) : $product->slug,
            'price' => $request->edit_price ? $request->edit_price : $product->price,
            'description' => $request->edit_description ? $request->edit_description : $product->description,
            'image' => $request->hasFile('edit_image') ? $edit_image : $product->image,
            'category_id' => $request->edit_category_id ? $request->edit_category_id : $product->category_id,
        ];

        $product->update($data)
        ? Alert::success('Berhasil', "Product telah berhasil diubah!")
        : Alert::error('Error', "Product gagal diubah!");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        Storage::delete($product->image);
        $product->delete()
            ? Alert::success('Berhasil', "Product telah berhasil dihapus.")
            : Alert::error('Error', "Product gagal dihapus!");

        return redirect()->back();
    }
}
