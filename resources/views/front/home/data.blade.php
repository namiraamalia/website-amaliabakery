@extends('layouts.front', ['web' => $web])
@section('css')
<style>
    .content {
        position: relative;
        width: 100%;
        margin: auto;
        overflow: hidden;
        cursor: pointer;
    }

    .content .content-overlay {
        background: rgba(0, 0, 0, 0.3);
        position: absolute;
        height: 100%;
        width: 100%;
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
        opacity: 0;
        -webkit-transition: all 0.4s ease-in-out 0s;
        -moz-transition: all 0.4s ease-in-out 0s;
        transition: all 0.4s ease-in-out 0s
    }

    .content:hover .content-overlay {
        opacity: 1
    }

    .content-image {
        width: 100%
    }

    .content-details {
        position: absolute;
        text-align: center;
        padding-left: 2em;
        padding-right: 2em;
        width: 100%;
        top: 50%;
        left: 50%;
        opacity: 0;
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        -webkit-transition: all 0.3s ease-in-out 0s;
        -moz-transition: all 0.3s ease-in-out 0s;
        transition: all 0.3s ease-in-out 0s
    }

    .content:hover .content-details {
        top: 50%;
        left: 50%;
        opacity: 1
    }

    .content-details h4 {
        color: #fff;
        font-weight: 500;
        letter-spacing: 0.15em;
        margin-bottom: 0.5em;
        text-transform: uppercase
    }

    .content-details p {
        color: #fff;
        font-size: 0.8em
    }

    .fadeIn-bottom {
        top: 100%
    }

    .content-img {
    display: flex;
    margin: 0 auto !important;
    }

    #productCategoryMobile {
        display: none;
    }

    @media screen and (max-width: 455px) {
        h1 {
            font-size: 50px !important;
            margin-top: 40px;
        }

        #buttonHeader {
            display: none;
        }

        #productCategoryDesktop {
            display: none;
        }

        #productCategoryMobile {
            display: block;
        }
    }

    a {
        text-decoration: none;
        color: rgb(13, 30, 45);
    }
</style>
@endsection
@section('container')
    <div class="row">
        <div class="col-sm-6 d-flex align-items-center">
            <div>
                <h1 style="font-size: 80px; font-weight: bold;">Koleksi Roti Lezat</h1>
                <a href="#products" id="buttonHeader" class="btn btn-sm btn-dark mt-3">Produk Kita</a>
            </div>
        </div>
        <div class="col-sm-6">
            <img src="{{ asset('bakery.jpg') }}" class="img-fluid" alt="">
        </div>
    </div>

    <div class="" id="products"></div>

    <div class="row" style="margin-top: 100px;" id="products">
        <div class="col-sm-12">
            <h2 style="font-weight: bold;">Product</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <p class="text-muted">
                Ini merupakan produk yang kita punya
            </p>
        </div>
    </div>

    <div class="row" id="productCategoryDesktop">
        @foreach($category as $categories)
        <div class="col-sm-3" style="margin-top: 20px;">
            <a href="{{ route('products.data', $categories->id) }}">
                <div class="content">
                    <div class="content-overlay"></div> 
                    <img src="{{ Storage::url($categories->image) }}" class="img-fluid">
                    <div class="content-details fadeIn-bottom">
                        <h4 class="content-text fw-bold">{{ $categories->name }}</h4>
                    </div>
                </div>   
            </a>
        </div>
        @endforeach
    </div>

    <div class="row" id="productCategoryMobile">
        @foreach($category as $categories)
        <div class="col-sm-3">
            <a href="{{ route('products.data', $categories->id) }}">
                <img src="{{ Storage::url($categories->image) }}" class="img-fluid mt-3" style="height: 300px;width:100%; object-fit: cover;">
                <h4 class="mt-3 text-center">{{ $categories->name }}</h4>
            </a>
        </div>
        @endforeach
    </div>
    
    <div class="row" style="margin-top: 100px;">
        <div class="col-sm-4">
            <h3 class="fw-bold" style="border-bottom: 1px solid rgb(13, 30, 45); padding-bottom: 10px; width:180px; line-height: 40.2px;">Raja Pesanan</h3>
            <p style="font-size: 15px; line-height: 27.2px;">Amalia Bakery berpengalaman menangani pesanan roti dalam jumlah besar (hingga 35.000 item sehari) sejak 2010. Berapapun jumlah pesanan Anda, Kami layani.</p>
        </div>
        <div class="col-sm-4">
            <h3 class="fw-bold" style="border-bottom: 1px solid rgb(13, 30, 45); padding-bottom: 10px; width:200px; line-height: 40.2px;">Fresh from Oven</h3>
            <p style="font-size: 15px; line-height: 27.2px;">Seluruh produk pesanan selalu dibuat paling lama 24 jam sebelum waktu pengambilan pesanan. Roti kami tahan 2-3 hari dari pembelian Anda di outlet Laritta.</p>
        </div>
        <div class="col-sm-4">
            <h3 class="fw-bold" style="border-bottom: 1px solid rgb(13, 30, 45); padding-bottom: 10px; width:200px; line-height: 40.2px;">Varian Terbanyak</h3>
            <p style="font-size: 15px; line-height: 27.2px;">Amalia Bakery menyediakan lebih dari 243 varian produk. Kami juga secara rutin menambah varian produk baru kami tiap beberapa bulan.</p>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-sm-4">
            <h3 class="fw-bold" style="border-bottom: 1px solid rgb(13, 30, 45); padding-bottom: 10px; width:170px;">Gratis Antar</h3>
            <p style="font-size: 15px; line-height: 27.2px;">Amalia Bakery menyediakan layanan antar pesanan dalam kota (Surabaya & Sidoarjo), hingga ke luar kota kota (Malang, Batu, Gresik, Pasuruan, Mojokerto, Bangkalan, Sampang, Pamekasan, dan kota lain di Jawa Timur).</p>
        </div>
        <div class="col-sm-4">
            <h3 class="fw-bold" style="border-bottom: 1px solid rgb(13, 30, 45); padding-bottom: 10px; width:200px;">Membership</h3>
            <p style="font-size: 15px; line-height: 27.2px;">Program keanggotaan (membership) Amalia Bakery gratis dan menawarkan berbagai keuntungan khusus member, seperti: Promo Khusus Member Sepanjang Tahun dan Diskon 40% untuk Pembelian Kue Tart.</p>
        </div>
        <div class="col-sm-4">
            <h3 class="fw-bold" style="border-bottom: 1px solid rgb(13, 30, 45); padding-bottom: 10px; width:250px;">Jaminan Kualitas</h3>
            <p style="font-size: 15px; line-height: 27.2px;">Amalia Bakery senantiasa menjaga kualitas produk dan layanan untuk pelanggan setia kami. Kami memberi garansi uang kembali hingga 100% jika Anda tidak puas dengan produk atau layanan kami.</p>
        </div>
    </div>
@endsection