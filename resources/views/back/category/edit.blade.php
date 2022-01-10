@extends('layouts.back', ['web' => $web])
@section('title', 'Edit Category')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
  integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
  .dropify-wrapper {
    border: 1px solid #e2e7f1;
    border-radius: .3rem;
    height: 150px;
  }

  .card {
    border-radius: 10px;
  }

  label.error {
    color: #f1556c;
    font-size: 13px;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.5;
    margin-top: 5px;
    padding: 0;
  }

  input.error {
    color: #f1556c;
    border: 1px solid #f1556c;
  }
</style>
@endsection
@section('container')
<section class="section">
  <div class="section-header">
    <h1>Category</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
      <div class="breadcrumb-item">Category</div>
    </div>
  </div>

  <div class="section-body">
    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <form method="post" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-header">
                        <h4>Edit Category</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                              <div class="form-group col-md-6 col-12">
                                  <label>Nama</label>
                                  <input type="text" class="form-control @error('edit_name') is-invalid @enderror" name="edit_name" value="{{ old('edit_name', $category->name) }}" placeholder="Nama Kategori"> 
                                  @error('edit_name')
                                    <div class="mt-1">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                  @enderror
                              </div>
                              <div class="form-group col-md-6 col-12">
                                <label>Gambar</label>
                                <input type="file" class="form-control dropify" name="edit_image"
                                    data-allowed-file-extensions="png jpg jpeg" data-show-remove="false" data-default-file="@if(!empty($category->image) &&
                                    Storage::exists($category->image)){{ Storage::url($category->image) }}@endif">
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
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>   
  </div>
</section>

<div class="modal fade" tabindex="-1" role="dialog" id="deleteConfirm">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('categories.destroy', '') }}" method="post" id="deleteCategoryForm">
        @csrf
        @method('delete')
        <div class="modal-body">
          Apakah anda yakin untuk <b>menghapus</b> Category ini ?
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
          <button type="submit" class="btn btn-primary" id="deleteModalButton">Ya, Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
  integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    $('.dropify').dropify();
  </script>
<script>
    const deleteCategory = $("#deleteCategoryForm").attr('action');

    function deleteThisCategory(data) {
      $("#deleteCategoryForm").attr('action', `${deleteCategory}/${data.id}`);
    }
</script>
@endsection