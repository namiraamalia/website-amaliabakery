<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Web;
use Alert;
use Str;
use Storage;

class CategoryBackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['category'] = Category::paginate(6);
        $data['web'] = Web::all();
        return view('back.category.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['web'] = Web::all();
        return view('back.category.create', $data);
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
            'name' => 'required|unique:categories',
        ],
        [
            'name.required' => 'Nama Category harus di isi.',
            'name.unique' => 'Nama Category sudah tersedia.'
        ]);

        $image = ($request->image) ? $request->file('image')->store("/public/input/categories") : null;

        $data = [
            'name' => $request->name,
            'image' => $image
        ];

        Category::create($data)
        ? Alert::success('Berhasil', 'Category telah berhasil ditambahkan!')
        : Alert::error('Error', 'Category gagal ditambahkan!');

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['category'] = Category::find($id);
        $data['web'] = Web::all();
        return view('back.category.edit', $data);
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
        $category = Category::findOrFail($id);
        
        $request->validate([
            'edit_name' => "required|unique:categories,name,$category->id",
        ],
        [
            'edit_name.required' => 'Nama Category harus di isi.',
            'edit_name.unique' => 'Nama Category sudah tersedia.',
        ]);

        if($request->hasFile('edit_image')) {
            if(Storage::exists($category->image) && !empty($category->image)) {
                Storage::delete($category->image);
            }

            $edit_image = $request->file("edit_image")->store("/public/input/categories");
        }

        $data = [
            'name' => $request->edit_name ? $request->edit_name : $category->name,
            'image' => $request->hasFile('edit_image') ? $edit_image : $category->image,
        ];

        $category->update($data)
        ? Alert::success('Berhasil', "Category telah berhasil diubah!")
        : Alert::error('Error', "Category gagal diubah!");

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        Storage::delete($category->image);
        $category->delete()
            ? Alert::success('Berhasil', "Category telah berhasil dihapus.")
            : Alert::error('Error', "Category gagal dihapus!");

        return redirect()->back();
    }
}
