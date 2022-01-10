@extends('layouts.back', ['web' => $web])
@section('title', 'Product')
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
  #buttonGroup {
    display: block;
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
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between w-100">
              <a href="{{ route('product-back.create') }}" class="btn btn-sm btn-primary"><i
                  class="fas fa-plus-circle" style="margin-top: 10px; font-size: 15px;"></i></a>
              <form action="{{ route('filter-bakery') }}" method="post" id="filterForm">
                  @csrf
                  <select class="form-control" name="category_id" onchange="filter()">
                      <option value="all">All</option>
                      @foreach($category as $categories)
                      <option value="{{ $categories->id }}" @isset($filter_value) {{ $categories->id == $filter_value ? 'selected' : null }} @endisset>{{ $categories->name }}</option>
                      @endforeach
                  </select>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
            <div class="row">
                @foreach ($product as $products)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-3">{{ Str::limit($products->name, 30) }}</h6>
                            <img src="{{ Storage::url($products->image) }}" class="img-fluid rounded mt-1"
                                style="width:100%; height:300px; object-fit:cover;">
                            <div class="btn-group text-center buttonGroup mt-3" id="buttonGroup">
                                <a href="{{ route('product-back.edit', $products->id) }}" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#deleteConfirm" onclick="deleteThisProduct({{$products}})"><i
                                        class="far fa-trash-alt"></i></button>
                                <button type="button" class="btn btn-sm btn-dark" data-toggle="modal"
                                    data-target="#more{{ $products->id }}">More</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        <div class="d-flex justify-content-center">
          {{ $product->links('vendor.pagination.custom_pagination') }}
      </div>
    </div>
  </div>
</section>


@foreach ($product as $products)
<div class="modal fade" tabindex="-1" role="dialog" id="more{{$products->id}}">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Rincian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card"> 
          <div class="card-body"> 
              <img src="{{ Storage::url($products->image) }}" class="card-img-top" alt="Placeholder" style="width: 300px;"> 
              <h6 class="card-title text-dark mt-5" style="font-size: 14px;">{{ $products->name }}</h6>
              <p class="card-text text-dark">{{ $products->price }}</p>
              <p>{!! $products->description !!}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach

<div class="modal fade" tabindex="-1" role="dialog" id="deleteConfirm">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('product-back.destroy', '') }}" method="post" id="deleteProductForm">
        @csrf
        @method('delete')
        <div class="modal-body">
          Apakah anda yakin untuk <b>menghapus</b> product ini ?
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
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
  integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
  $('.dropify').dropify();
</script>

<script>
const deleteProduct = $("#deleteProductForm").attr('action');
function deleteThisProduct(data) {
    $("#deleteProductForm").attr('action', `${deleteProduct}/${data.id}`);
}

function filter() {
    $("#filterForm").submit();
}
</script>
@endsection