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
                        <li class="breadcrumb-item"><a
                                href="{{ route('manage_dog_breeds.index') }}">จัดการสายพันธ์สุนัข</a></li>
                        <li class="breadcrumb-item active" aria-current="page">รายการสุนัข</li>
                    </ol>
                </nav>

                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <div
                            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                            <h1 class="h2">รายการสุนัขสายพันธ์ {{$dog_breed_id->dog_breed}}</h1>
                        </div>

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('manage_dog_breeds.show',[$dog_breed_id->id, $dog_breed_id->dog_breed]) }}">ทั้งหมด</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="true" aria-expanded="false">เพศ</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                        href="{{ route('manage_dog_breeds.show_male',[$dog_breed_id->id, $dog_breed_id->dog_breed]) }}">ตัวผู้</a>
                                    <a class="dropdown-item"
                                        href="{{ route('manage_dog_breeds.show_female',[$dog_breed_id->id, $dog_breed_id->dog_breed]) }}">ตัวเมีย</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="true" aria-expanded="false">ฟาร์ม</a>
                                <div class="dropdown-menu">
                                    @foreach ($dog_farms as $dog_farm)
                                    <a class="dropdown-item"
                                        href="{{ route('manage_dog_breeds.sort_farm',[$dog_breed_id->id, $dog_breed_id->dog_breed, $dog_farm->dog_farm_name]) }}">{{$dog_farm->dog_farm_name}}</a>
                                    @endforeach
                                </div>
                            </li>
                        </ul>

                        <div class="table-responsive">
                            <table class="table table-borderless table-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รหัส</th>
                                        <th>รูปภาพ</th>
                                        <th>สายพันธ์</th>
                                        <th>สี</th>
                                        <th>เพศ</th>
                                        <th>ฟาร์ม</th>
                                        <th>ราคาซื้อ</th>
                                        <th>ราคาขาย</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dogs as $dog)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $dog->id }}</td>
                                        <td>
                                            @if ($dog->dog_image == null)
                                            <p>ไม่มีรูปภาพ</p>
                                            @else
                                            <img class="img-fluid rounded" width="100"
                                                src="{{ asset('image/dogs/'.$dog->dog_image)}}">
                                            @endif
                                        </td>
                                        <td>{{ $dog->dog_breed }}</td>
                                        <td>{{ $dog->dog_color }}</td>
                                        <td>{{ $dog->dog_sex }}</td>
                                        <td>{{ $dog->dog_farm_name }}</td>
                                        <td>{{ number_format($dog->dog_buy_price, 2) }}</td>
                                        <td>{{ number_format($dog->dog_sell_price, 2) }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>ไม่มีข้อมูล</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            {{-- Pagination --}}
                            <div class="d-flex justify-content-center">
                                {!! $dogs->links() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
