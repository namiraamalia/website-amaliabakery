@extends('layouts.front', ['web' => $web])
@section('css')
<style>
    a {
        text-decoration: none;
        color: black;
    }

    a:hover {
        color: #acacac;
    }

    #mobile {
        display: none;
    }

    @media screen and (max-width: 455px) {
        #desktop {
            display: none !important;
        }

        #mobile {
            display: block;
        }
    }
</style>
@endsection
@section('container')
    <div class="row mt-5">
        <div class="col-sm-12">
            <h2>
                {{ $product->name }}
            </h2>
        </div>
    </div>
    <div class="d-flex mt-3" id="desktop">
        <img src="{{ Storage::url($product->image) }}" width="250">
        <div class="d-flex flex-column" style="margin-left: 50px;width: 500px;">
            <p>{{ $product->description }}</p>
            <p>{{ $product->price }}</p>
            <span>Category :</span><a href="{{ route('products.data', $product->categories->id) }}">{{ $product->categories->name }}</a>
        </div>
    </div>

    <div class="row" id="mobile">
        <div class="col-12">
            <img src="{{ Storage::url($product->image) }}" class="img-fluid mt-3">
            <p class="mt-4">{{ $product->description }}</p>
            <p>{{ $product->price }}</p>
            <span>Category :</span><a href="{{ route('products.data', $product->categories->id) }}">{{ $product->categories->name }}</a>
        </div>
        
    </div>
@endsection

@section('js')

@endsection