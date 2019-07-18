@extends('layouts.admin')
@section('content')
<div id="page-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                {{-- Breadcrumb --}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white shadow-sm">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">แดชบอร์ด</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('manage_dogs.index') }}">จัดการสุนัข</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ข้อมูลสุนัข</li>
                    </ol>
                </nav>

                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5 text-center">
                                @if ($dog->dog_image == null)
                                <img src="{{ asset('image/no_img.jpg') }}" width="350">
                                @else
                                <img class="img-fluid rounded" width="350"
                                    src="{{ asset('image/dogs/'.$dog->dog_image)}}">
                                @endif
                            </div>
                            <div class="col-md-7">
                                <ul class="list-unstyled">
                                    <li>
                                        <h3 class="my-2">{{ $dog->dog_breed }} {{ $dog->dog_color }} {{ $dog->dog_sex }}
                                        </h3>
                                        <h5 class="my-2">ราคาซื้อ {{ number_format($dog->dog_buy_price, 2) }} บาท</h5>
                                        <h5 class="my-2">ราคาขาย {{ number_format($dog->dog_sell_price, 2) }} บาท</h5>
                                    </li>
                                    <li class="mb-2">
                                        @switch($dog->dog_status)
                                        @case(0)
                                        <span class="badge badge-pill badge-main">มีจำหน่าย</span>
                                        @break
                                        @case(1)
                                        <span class="badge badge-pill badge-primary">รอดำเนินการจัดส่ง</span>
                                        @break
                                        @case(2)
                                        <span class="badge badge-pill badge-dark">รอยืนยันข้อมูล</span>
                                        @break
                                        @case(3)
                                        <span class="badge badge-pill badge-success">ขายแล้ว</span>
                                        @break
                                        @case(4)
                                        <span class="badge badge-pill badge-success">ขายพร้อมติดตั้งไมโครชิพ</span>
                                        @break
                                        @endswitch

                                        @if ($dog->install_status == 1)
                                        <span class="badge badge-pill badge-success">ติดตั้งไมโครชิพแล้ว</span>
                                        @endif
                                    </li>
                                    <ul>
                                        <li><span class="text-main">รหัส</span> {{ $dog->id }}</li>
                                        <li><span class="text-main">วันเกิด</span> {{ $dog->dog_birth_date }}</li>
                                        <li><span class="text-main">ฟาร์มสุนัข</span> {{ $dog->dog_farm_name }}</li>
                                        @if ($dog->dog_status == 3)
                                        <li><span class="text-main">เจ้าของ</span> {{ $dog->dog_owner }}</li>
                                        @endif
                                    </ul>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
