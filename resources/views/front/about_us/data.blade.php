@extends('layouts.front', ['web' => $web])
@section('css')
<style>
    .bordered {
        border: solid 1px #EBEBEB;
    }
    .contact-item {
        padding: 25px;
    }
    .contact-item .icon {
        color: #FFF;
        float: left;
        border-radius: 10px;
        display: block;
        font-size: 20px;
        line-height: 45px;
        height: 45px;
        text-align: center;
        width: 45px;
        background: rgb(13, 30, 45);
    }

    a {
        text-decoration: none;
        color:rgb(13, 30, 45);
    }
    a:hover {
        color:rgb(13, 30, 45)
    }
</style>
@endsection
@section('container')
    <div class="row mt-5">
        <div class="col-sm-12">
            <h2 style="border-bottom: 1px solid rgb(13, 30, 45); padding-bottom: 20px; width:150px;">
                About Us
            </h2>
        </div>
    </div>
    @foreach($web as $webs)
    <div class="row">
        <div class="col-sm-12">
            <p>{!! $webs->description !!}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            @if(isset($webs->instagram))
            <a href="https://instagram.com/{{ $webs->instagram }}">
            @else
            <a href=""></a>
            @endif
                <div class="contact-item bordered rounded d-flex align-items-center mt-3">
                    <span class="icon fab fa-instagram"></span>
                    <div class="details" style="margin-left: 20px !important;">
                        <h5 class="mb-0 mt-0">Instagram</h5>
                        @if(isset($webs->instagram))
                        <p class="mb-0 text-muted">{{ $webs->instagram }}</p>
                        @else
                        <p class="mb-0 text-muted">-</p>
                        @endif
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6">
            @if(isset($webs->twitter))
            <a href="https://twitter.com/{{ $webs->twitter }}">
            @else
                <a href=""></a>
            @endif
                <div class="contact-item bordered rounded d-flex align-items-center mt-3">
                    <span class="icon fab fa-twitter"></span>
                    <div class="details" style="margin-left: 20px !important;">
                        <h5 class="mb-0 mt-0">Twitter</h5>
                        @if(isset($webs->twitter))
                        <p class="mb-0 text-muted">{{ $webs->twitter }}</p>
                        @else
                        <p class="mb-0 text-muted">-</p>
                        @endif
                    </div>
                </div>
            </a>
        </div>
        
    </div>
    <div class="row">
        <div class="col-sm-6">
            @if(isset($webs->email))
                <a href="mailto:{{ $webs->email }}">
            @else
                <a href=""></a>
            @endif
                <div class="contact-item bordered rounded d-flex align-items-center mt-3">
                    <span class="icon fa fa-envelope"></span>
                    <div class="details" style="margin-left: 20px !important;">
                        <h5 class="mb-0 mt-0">Email</h5>
                        @if(isset($webs->email))
                        <p class="mb-0 text-muted">{{ $webs->email }}</p>
                        @else
                        <p class="mb-0 text-muted">-</p>
                        @endif
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6">
            @if(isset($webs->facebook))
                <a href="https://facebook.com/{{ $webs->facebook }}">
            @else
                <a href=""></a>
            @endif
                <div class="contact-item bordered rounded d-flex align-items-center mt-3">
                    <span class="icon fab fa-facebook-square"></span>
                    <div class="details" style="margin-left: 20px !important;">
                        <h5 class="mb-0 mt-0">Facebook</h5>
                        @if(isset($webs->facebook))
                        <p class="mb-0 text-muted">{{ $webs->facebook }}</p>
                        @else
                        <p class="mb-0 text-muted">-</p>
                        @endif
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="contact-item bordered rounded d-flex align-items-center mt-3">
                <span class="icon fa fa-phone"></span>
                <div class="details" style="margin-left: 20px !important;">
                    <h5 class="mb-0 mt-0">Phone</h5>
                    <p class="mb-0 text-muted">{{ $webs->phone }}</p>
                </div>
            </div>
        </div>
   </div>
   @endforeach
@endsection

@section('js')

@endsection