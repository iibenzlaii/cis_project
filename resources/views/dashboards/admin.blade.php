@extends('layouts.admin')
@section('content')
<div id="page-content">
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <!-- Icon Cards-->
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-main shadow-sm h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-main mb-1"><a
                                                href="{{ route('manage_dogs.index') }}">จำนวนสุนัข</a>
                                        </div>
                                        <div class="mr-5">{{ $count_dog }} ตัว</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dog fa-3x text-black-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-main shadow-sm h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-main mb-1">
                                            <a href="{{ route('manage_microchips.index') }}">จำนวนไมโครชิพ</a>
                                        </div>
                                        <div class="mr-5">{{ $count_microchip }} ชิ้น</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-microchip fa-3x text-black-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-main shadow-sm h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-main mb-1"><a
                                                href="{{ route('manage_dog_farms.index') }}">จำนวนฟาร์มสุนัข</a></div>
                                        <div class="mr-5">{{ $count_dog_farm }} ฟาร์ม</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-warehouse fa-3x text-black-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-main shadow-sm h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-main mb-1"><a
                                                href="{{ route('manage_users.index') }}">ผู้ใช้งานระบบ</a></div>
                                        <div class="mr-5">{{ $count_user }} คน</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-3x text-black-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chart -->
                {{-- <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white border-0">
                        <div class="text-xs font-weight-bold text-main mb-1">
                            <i class="fas fa-chart-area"></i> Area Chart
                        </div>
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('image/charts/area_chart.png') }}" width="100%">
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card shadow-sm h-100 mb-4">
                            <div class="card-header bg-white border-0">
                                <div class="text-xs font-weight-bold text-main mb-1">
                                    <i class="fas fa-chart-bar"></i> จำนวนการขาย
                                </div>
                            </div>
                            <div class="card-body">
                                <div style="width:100%">
                                    {!! $sell_chart->container() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow-sm h-100 mb-4">
                            <div class="card-header bg-white border-0">
                                <div class="text-xs font-weight-bold text-main mb-1">
                                    <i class="fas fa-chart-pie"></i> สัดส่วนเพศ
                                </div>
                            </div>
                            <div class="card-body">
                                <div style="width:100%">
                                    {!! $dog_gender_chart->container() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{!! $sell_chart->script() !!}
{!! $dog_gender_chart->script() !!}
@endsection
