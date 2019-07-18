@extends('layouts.app')
@section('title','แก้ไขข้อมูลส่วนตัว -')
@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="text-center">
        <h1 class="my-4">แก้ไขข้อมูลส่วนตัว</h1>
    </div>

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

            <form action="{{ route('change_personal_info.update', Auth::user()->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>อีเมล</label>
                        <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label>ชื่อผู้ใช้</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label>เปลี่ยนรหัสผ่าน (ตัวเลือก)</label>
                        <input type="password" class="form-control" name="password" placeholder="กรอกรหัสผ่านใหม่">
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
@endsection
