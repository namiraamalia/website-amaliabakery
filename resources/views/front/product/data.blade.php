@extends('layouts.front', ['web' => $web])
@section('css')
<style>
    a { 
        text-decoration: none;
        text-align: center;
    }

    a h4 {
        margin-top: 30px;
    }

    .img-fluid {
        transition: transform .2s;
        cursor: pointer;
    }

    .img-fluid:hover {
        transform: scale(1.2); 
    }
</style>
@endsection
@section('container')
<div class="row mt-5">
    <div class="col-sm-12 text-center">
        <h2 style="border-bottom: 1px solid rgb(13, 30, 45); padding-bottom: 20px; width:100px;">
                @php
                    $category_id =  \App\Models\Category::where('id', $product_id->id)->first();
                @endphp

            {{ $category_id->name }}
        </h2>
    </div>
</div>
    <div class="row" style="margin-top: 60px;">
        @foreach($product as $products)
            <div class="col-sm-3 d-flex justify-content-center">
                <a href="{{ route('products.show', $products->slug) }}">
                    <div class="wrap" style="overflow: hidden;">
                        <img src="{{ Storage::url($products->image) }}" class="img-fluid">
                    </div>
                    <h4 class="content-text text-dark">{{ $products->name }}</h4>
                </a>
            </div>
        @endforeach
    </div>
@endsection

@section('js')

@endsection