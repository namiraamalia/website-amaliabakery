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
        border-radius: 10px;
        transition: transform .2s;
        cursor: pointer;
    }

    .img-fluid:hover {
        transform: scale(1.2); 
        border-radius: 10px;
    }

    .wrap {
        border-radius: 10px;
    }
</style>
@endsection
@section('container')
<div class="row mt-5">
    <div class="col-sm-12 text-center">
        <h2 style="border-bottom: 1px solid rgb(13, 30, 45); padding-bottom: 20px; width:100px;">
            Category
        </h2>
    </div>
</div>
    <div class="row" style="margin-top: 60px;">
        @foreach($category as $categories)
            <div class="col-sm-3 d-flex justify-content-center">
                <a href="{{ route('products.data', $categories->id) }}">
                    <div class="wrap" style="overflow: hidden;">
                        <img src="{{ Storage::url($categories->image) }}" class="img-fluid">
                    </div>
                    <h4 class="content-text text-dark">{{ $categories->name }}</h4>
                </a>
            </div>
        @endforeach
    </div>
@endsection

@section('js')

@endsection