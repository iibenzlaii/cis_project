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
                        <li class="breadcrumb-item active" aria-current="page">แก้ไขข้อมูลเกี่ยวกับเรา</li>
                    </ol>
                </nav>

                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        {{-- Message --}}
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        {{-- Error Message --}}
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>เกิดข้อผิดพลาด!</strong><br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div
                            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                            <h1 class="h2">แก้ไขข้อมูลเกี่ยวกับเรา</h1>
                        </div>

                        <form action="{{ route('about_us.update',$about->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label>หัวข้อหลัก</label>
                                <input type="text" class="form-control" name="about_title"
                                    value="{{ $about->about_title }}" required>
                            </div>
                            <div class="form-group">
                                <label>หัวข้อรอง</label>
                                <input type="text" class="form-control" name="about_subtitle"
                                    value="{{ $about->about_subtitle }}" required>
                            </div>
                            <div class="form-group">
                                <label>เนื้อหา</label>
                                <textarea class="form-control" name="about_content" rows="5"
                                    required>{{ $about->about_content }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>รูปภาพ</label>
                                <div class="mb-2">
                                    <img src="{{ asset('image/manage_web/'.$about->about_image) }}" class="rounded"
                                        width="30%">
                                </div>
                                <label>เปลี่ยนรูปภาพ</label>
                                <input type="file" class="form-control" name="about_image">
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
