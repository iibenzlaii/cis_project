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
                        <li class="breadcrumb-item active" aria-current="page">จัดการสายพันธ์สุนัข</li>
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
                            <h1 class="h2">จัดการสายพันธ์สุนัข</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group mr-2">
                                    {{-- Triger add Modal --}}
                                    <button type="button" class="btn btn-main" data-toggle="modal"
                                        data-target="#addDogBreedModal">
                                        เพิ่มสายพันธ์สุนัข
                                    </button>
                                    {{-- Add Modal --}}
                                    <div class="modal fade" id="addDogBreedModal" tabindex="-1" role="dialog"
                                        aria-labelledby="addDogBreedModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h4 class="modal-title" id="addDogBreedModalLabel">
                                                        เพิ่มสายพันธ์สุนัข</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('manage_dog_breeds.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="dog_breed_male_count" value="0">
                                                        <input type="hidden" name="dog_breed_female_count" value="0">
                                                        <div class="form-row">
                                                            <div class="form-group col-md">
                                                                <label>สายพันธ์สุนัข</label>
                                                                <input type="text" class="form-control" name="dog_breed"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group text-right">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">ยกเลิก</button>
                                                            <button type="submit"
                                                                class="btn btn-main">บันทึกข้อมูล</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รหัส</th>
                                        <th>ฟาร์ม</th>
                                        <th>จำนวนตัวผู้</th>
                                        <th>จำนวนตัวเมีย</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dog_breeds as $dog_breed)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $dog_breed->id }}</td>
                                        <td>{{ $dog_breed->dog_breed }}</td>
                                        <td>{{ $dog_breed->dog_breed_male_count }}</td>
                                        <td>{{ $dog_breed->dog_breed_female_count }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-link text-dark"
                                                    href="{{ route('manage_dog_breeds.show',[$dog_breed->id, $dog_breed->dog_breed]) }}"
                                                    role="button"><i class="fas fa-eye"></i></a>

                                                <!-- Trigger edit modal -->
                                                <button type="button" class="btn btn-link text-dark" data-toggle="modal"
                                                    data-target="#edit{{ $dog_breed->id }}Modal">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="edit{{ $dog_breed->id }}Modal" tabindex="-1"
                                                    role="dialog" aria-labelledby="edit{{ $dog_breed->id }}ModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h4 class="modal-title"
                                                                    id="edit{{ $dog_breed->id }}ModalLabel">
                                                                    แก้ไขสายพันธ์สุนัข</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('manage_dog_breeds.update',$dog_breed->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="hidden" name="old_value" value="{{ $dog_breed->dog_breed}}">
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md">
                                                                            <label>สายพันธ์สุนัข</label>
                                                                            <input type="text" class="form-control"
                                                                                name="dog_breed"
                                                                                value="{{ $dog_breed->dog_breed}}"
                                                                                required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group text-right">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">ยกเลิก</button>
                                                                        <button type="submit"
                                                                            class="btn btn-main">บันทึกข้อมูล</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if ($dog_breed->dog_breed_male_count == 0 &&
                                                $dog_breed->dog_breed_female_count == 0)
                                                <!-- Trigger delete modal -->
                                                <button type="button" class="btn btn-link text-dark" data-toggle="modal"
                                                    data-target="#delete{{ $dog_breed->id }}Modal">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete{{ $dog_breed->id }}Modal"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="delete{{ $dog_breed->id }}ModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h5 class="modal-title"
                                                                    id="delete{{ $dog_breed->id }}ModalLabel">
                                                                    ยืนยันการลบสายพันธ์สุนัข</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>คุณต้องการลบสายพันธ์สุนัข รหัส {{ $dog_breed->id }}
                                                                    "{{ $dog_breed->dog_breed }}" หรือไม่?</p>
                                                                <div class="form-group text-right">
                                                                    <form
                                                                        action="{{ route('manage_dog_breeds.destroy',$dog_breed->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
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
                                                <!-- Delete Modal -->
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
                                {!! $dog_breeds->links() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
