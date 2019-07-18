@extends('layouts.admin')
@section('title','จัดการสุนัข')
@section('content')
<div id="page-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                {{-- Breadcrumb --}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white shadow-sm">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">แดชบอร์ด</a></li>
                        <li class="breadcrumb-item active" aria-current="page">จัดการสุนัข</li>
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

                        <div
                            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                            <h1 class="h2">จัดการสุนัข</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group mr-2">
                                    <a class="btn btn-main" href="{{ route('manage_dogs.create') }}"
                                        role="button">เพิ่มสุนัข</a>
                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('manage_dogs.index') }}">ทั้งหมด</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="true" aria-expanded="false">สายพันธ์</a>
                                <div class="dropdown-menu">
                                    @foreach ($dog_breeds as $dog_breed)
                                    <a class="dropdown-item"
                                        href="{{ route('manage_dogs.index_sort_breed',$dog_breed->dog_breed) }}">{{$dog_breed->dog_breed}}</a>
                                    @endforeach
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="true" aria-expanded="false">ฟาร์ม</a>
                                <div class="dropdown-menu">
                                    @foreach ($dog_farms as $dog_farm)
                                    <a class="dropdown-item"
                                        href="{{ route('manage_dogs.index_sort_farm',$dog_farm->dog_farm_name) }}">{{$dog_farm->dog_farm_name}}</a>
                                    @endforeach
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="true" aria-expanded="false">เพศ</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                        href="{{ route('manage_dogs.index_sort_sex','ตัวผู้') }}">ตัวผู้</a>
                                    <a class="dropdown-item"
                                        href="{{ route('manage_dogs.index_sort_sex','ตัวเมีย') }}">ตัวเมีย</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="true" aria-expanded="false">สถานะ</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                        href="{{ route('manage_dogs.index_sort_status','0') }}">มีจำหน่าย</a>
                                    <a class="dropdown-item"
                                        href="{{ route('manage_dogs.index_sort_status','1') }}">รอดำเนินการจัดส่ง</a>
                                    <a class="dropdown-item"
                                        href="{{ route('manage_dogs.index_sort_status','2') }}">รอยืนยันข้อมูล</a>
                                    <a class="dropdown-item"
                                        href="{{ route('manage_dogs.index_sort_status','3') }}">ขายแล้ว</a>
                                </div>
                            </li>
                        </ul>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รหัส</th>
                                        <th>รูปภาพ</th>
                                        <th>สายพันธ์</th>
                                        <th>สี</th>
                                        <th>เพศ</th>
                                        <th>ฟาร์ม</th>
                                        <th>สถานะ</th>
                                        <th>จัดการ</th>
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
                                        <td>
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
                                            @endswitch

                                            @switch($dog->install_status)
                                            @case(0)
                                            @break
                                            @case(1)
                                            <a href="{{route('manage_dogs.show_install',$dog->id)}}" class="badge badge-pill badge-success">ติดตั้งไมโครชิพแล้ว</a>
                                            @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-link text-dark"
                                                    href="{{ route('manage_dogs.show',$dog->id) }}" role="button"><i
                                                        class="fas fa-eye"></i></a>

                                                @if ($dog->dog_status == 0)
                                                <a class="btn btn-link text-dark"
                                                    href="{{ route('manage_dogs.edit',$dog->id) }}" role="button"><i
                                                        class="fas fa-edit"></i></a>

                                                <a class="btn btn-link text-dark"
                                                    href="{{ route('manage_orders.create_dog',$dog->id) }}"
                                                    role="button"><i class="fas fa-truck"></i></a>
                                                @endif

                                                {{-- @if ($dog->dog_status == 0 || $dog->dog_status == 3 && $dog->install_status == 0) --}}
                                                @if ($dog->dog_status == 0)
                                                <!-- Trigger installOrder modal -->
                                                <button type="button" class="btn btn-link text-dark" data-toggle="modal"
                                                    data-target="#installOrder{{ $dog->id }}Modal">
                                                    <i class="fas fa-syringe"></i>
                                                </button>
                                                <!-- installOrder Modal -->
                                                <div class="modal fade" id="installOrder{{ $dog->id }}Modal"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="installOrder{{ $dog->id }}ModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h5 class="modal-title"
                                                                    id="installOrder{{ $dog->id }}ModalLabel">
                                                                    ติดตั้งไมโครชิพ</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('manage_orders.create_install',$dog->id) }}"
                                                                    method="GET">
                                                                    @csrf
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md">
                                                                            <label>หมายเลขไมโครชิพ</label>
                                                                            <select name="microchip_id"
                                                                                class="form-control" required>
                                                                                <option value="">เลือกหมายเลขไมโครชิพ...
                                                                                </option>
                                                                                @foreach ($microchips as $microchip)
                                                                                <option value="{{ $microchip->id }}">
                                                                                    ไมโครชิพ {{ $microchip->id }} -
                                                                                    หมายเลข
                                                                                    {{ $microchip->microchip_no }}
                                                                                </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group text-right">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">ยกเลิก</button>
                                                                        <button type="submit"
                                                                            class="btn btn-main">ยืนยัน</button>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- .installOrder Modal -->
                                                @endif

                                                @if ($dog->dog_status == 0)
                                                <!-- Trigger delete modal -->
                                                <button type="button" class="btn btn-link text-dark" data-toggle="modal"
                                                    data-target="#delete{{ $dog->id }}Modal">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete{{ $dog->id }}Modal" tabindex="-1"
                                                    role="dialog" aria-labelledby="delete{{ $dog->id }}ModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h5 class="modal-title"
                                                                    id="delete{{ $dog->id }}ModalLabel">ยืนยันการลบสุนัข
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>คุณต้องการลบสุนัข รหัส {{ $dog->id }}
                                                                    "{{ $dog->dog_breed }} {{ $dog->dog_color }}
                                                                    {{ $dog->dog_sex }}" หรือไม่?</p>
                                                                <div class="form-group text-right">
                                                                    <form
                                                                        action="{{ route('manage_dogs.destroy',$dog->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <input type="hidden" name="dog_farm_name"
                                                                            value="{{ $dog->dog_farm_name }}">
                                                                        <input type="hidden" name="dog_breed"
                                                                            value="{{ $dog->dog_breed }}">
                                                                        <input type="hidden" name="dog_sex"
                                                                            value="{{ $dog->dog_sex }}">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">ยกเลิก</button>
                                                                        <button type="submit"
                                                                            class="btn btn-main">ลบข้อมูล</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- .Delete Modal -->
                                                @endif
                                            </div>
                                        </td>
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
