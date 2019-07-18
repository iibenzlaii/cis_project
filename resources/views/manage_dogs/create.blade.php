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
                        <li class="breadcrumb-item active" aria-current="page">เพิ่มสุนัข</li>
                    </ol>
                </nav>

                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        {{-- Message --}}
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>เกิดข้อผิดพลาด!</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div
                            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                            <h1 class="h2">เพิ่มสุนัข</h1>
                        </div>

                        <form action="{{ route('manage_dogs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="dog_status" value="0">
                            <input type="hidden" name="install_status" value="0">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>ฟาร์มสุนัข</label>
                                    <select name="dog_farm_name" class="form-control" required>
                                        <option value="">เลือกฟาร์มสุนัข...</option>
                                        @foreach ($dog_farms as $dog_farm)
                                        <option value="{{ $dog_farm->dog_farm_name }}">{{ $dog_farm->dog_farm_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>สายพันธ์</label>
                                    <select name="dog_breed" class="form-control" required>
                                        <option value="">เลือกสายพันธ์...</option>
                                        @foreach ($dog_breeds as $dog_breed)
                                        <option value="{{ $dog_breed->dog_breed }}">{{ $dog_breed->dog_breed }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>สี</label>
                                    <input type="text" class="form-control" name="dog_color" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="dog_birth_date">วันเกิด</label>
                                    <input type="date" class="form-control" name="dog_birth_date" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="dog_sex">เพศ</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="dog_sex" id="inlineRadio1"
                                            value="ตัวผู้" checked>
                                        <label class="form-check-label" for="inlineRadio1">ตัวผู้</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="dog_sex" id="inlineRadio2"
                                            value="ตัวเมีย">
                                        <label class="form-check-label" for="inlineRadio2">ตัวเมีย</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>ราคาซื้อ</label>
                                    <input type="number" class="form-control" name="dog_buy_price" required/>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>ราคาขาย</label>
                                    <input type="number" class="form-control" name="dog_sell_price" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>รูปภาพ</label>
                                    <input type="file" class="form-control" name="dog_image">
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-main">บันทึกข้อมูล</button>
                                <button type="reset" class="btn btn-secondary">ยกเลิก</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
