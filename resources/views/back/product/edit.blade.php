@extends('layouts.back', ['web' => $web])
@section('title', 'Edit Product')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
  integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
  .dropify-wrapper {
    border: 1px solid #e2e7f1;
    border-radius: .3rem;
    height: 100% !important;
  }

  .card {
    border-radius: 10px;
  }

  .cke_chrome {
    border: 1px solid #e9e9e9;
    border-width: thin;
  }
</style>
@endsection
@section('container')
<section class="section">
  <div class="section-header">
    <h1>Product</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
      <div class="breadcrumb-item">Product</div>
    </div>
  </div>

  <div class="section-body">
    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <form method="post" action="{{ route('product-back.update', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-header">
                        <h4>Edit Product</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12 col-12">
                                <label>Nama</label>
                                <input type="text" class="form-control @error('edit_name') is-invalid @enderror" name="edit_name" value="{{ old('edit_name', $product->name) }}" placeholder="Nama Product"> 
                                @error('edit_name')
                                  <div class="mt-1">
                                      <span class="text-danger">{{ $message }}</span>
                                  </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 col-12">
                                <label>Harga</label>
                                <input type="text" class="form-control @error('edit_price') is-invalid @enderror" name="edit_price" id="price" value="{{ old('edit_price', $product->price) }}" placeholder="Harga"> 
                                @error('edit_price')
                                  <div class="mt-1">
                                      <span class="text-danger">{{ $message }}</span>
                                  </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 col-12">
                                <label>Kategori</label>
                                <select class="form-control" name="edit_category_id">
                                  @foreach($category as $categories)
                                    <option value="{{ $categories->id }}" {{ $categories->id == $product->category_id ? 'selected' : '' }}>{{ $categories->name }}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row"> 
                          <div class="form-group col-md-8 col-12">
                            <label>Deskripsi</label>
                            <textarea class="form-control @error('edit_description') is-invalid @enderror" name="edit_description" id="description" placeholder="Deskripsi">
                              {{ old('edit_description', $product->description) }}
                            </textarea>
                            @error('edit_description')
                              <style>
                                .cke_chrome {
                                  border: 1px solid #dc3545 !important;
                                  border-width: thin;
                                }
                              </style>
                              <div class="mt-1">
                                <span class="text-danger">{{ $message }}</span>
                              </div>
                            @enderror
                        </div>
                            <div class="form-group col-md-4 col-12">
                                <label>Gambar</label>
                                <input type="file" class="form-control dropify" name="edit_image"
                                    data-allowed-file-extensions="png jpg jpeg" data-show-remove="false" data-default-file="@if(!empty($product->image) &&
                                    Storage::exists($product->image)){{ Storage::url($product->image) }}@endif">
                                     @error('edit_image')
                                     <style>
                                         .dropify-wrapper {
                                             border: 1px solid #dc3545 !important;
                                             border-radius: .3rem !important;
                                             height: 100% !important;
                                         }
                                     </style>
                                     <div class="mt-1">
                                         <span class="text-danger">{{ $message }}</span>
                                     </div>
                                     @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('product-back.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>   
  </div>
</section>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
  integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ asset('assets/ckeditor_without_image/ckeditor.js')}}"></script>
  <script>
    CKEDITOR.replace('description');
  </script>
  <script>
    $('.dropify').dropify();
  </script>
  <script>
    var rupiah = document.getElementById("price");
      if(rupiah.value == '') {
        rupiah.addEventListener("keyup", function(e) {
          rupiah.value = formatRupiah(this.value, "Rp. ");
        });
      } else {
        rupiah.value = formatRupiah(rupiah.value, "Rp. ");
        rupiah.addEventListener("keyup", function(e) {
          rupiah.value = formatRupiah(this.value, "Rp. ");
        });
      }
      

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
      var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
      }

      rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
      return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }
  </script>
@endsection