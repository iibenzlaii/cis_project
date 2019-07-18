@extends('layouts.deliveryman')
@section('content')
<div id="page-content">
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <!-- Chart -->
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Icon Cards-->
                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <div class="card border-left-main shadow-sm h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-main mb-1"><a
                                                        href="{{ route('manage_orders.index_deliveryman') }}">รายการจัดส่งสินค้า</a>
                                                </div>
                                                <div class="mr-5">{{ $count_order }} รายการ</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-truck fa-3x text-black-50"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <div class="card border-left-main shadow-sm h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-main mb-1">
                                                    <a href="{{ route('manage_transports.index') }}">ช่องทางจัดส่ง</a>
                                                </div>
                                                <div class="mr-5">{{ $count_transport }} ช่องทาง</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-map fa-3x text-black-50"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm">
                            <div class="card-header bg-white border-0">
                                <div class="text-xs font-weight-bold text-main mb-1">
                                    <i class="fas fa-truck"></i> รายการรอดำเนินการจัดส่งสินค้า
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                @forelse ($new_orders as $new_order)
                                <li class="list-group-item">
                                    <a class="btn btn-link text-dark"
                                        href="{{ route('manage_orders.show_deliveryman',$new_order->id) }}"
                                        role="button"><i class="fas fa-eye"></i></a>
                                    @if ($new_order->order_status == 0 || $new_order->order_status == 2)
                                    <!-- Trigger confrim modal -->
                                    <button type="button" class="btn btn-link text-dark" data-toggle="modal"
                                        data-target="#comfirm{{ $new_order->id }}Modal">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <!-- Cimfirm Modal -->
                                    <div class="modal fade" id="comfirm{{ $new_order->id }}Modal" tabindex="-1"
                                        role="dialog" aria-labelledby="comfirm{{ $new_order->id }}ModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title" id="comfirm{{ $new_order->id }}ModalLabel">
                                                        ยืนยันการจัดส่ง
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>คุณต้องการยืนยันการจัดส่งสินค้า รหัส
                                                        {{ $new_order->id }}
                                                        {{ $new_order->order_dog }} {{ $new_order->order_microchip }}
                                                        หรือไม่?</p>
                                                    <form
                                                        action="{{ route('manage_orders.confirm_deliveryman',$new_order->id) }}"
                                                        method="POST" class="needs-validation" novalidate>
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="id" value="{{ $new_order->id}}">
                                                        <input type="hidden" name="dog_id"
                                                            value="{{ $new_order->dog_id}}">
                                                        <input type="hidden" name="microchip_id"
                                                            value="{{ $new_order->microchip_id}}">
                                                        <div class="form-row">
                                                            <div class="form-group col-md">
                                                                <label>หมายเลข Tracking</label>
                                                                <input type="text" class="form-control"
                                                                    name="order_tracking_no"
                                                                    placeholder="กรอกหมายเลข Tracking 13 หลัก" required
                                                                    minlength="13" maxlength="13">
                                                                <div class="invalid-feedback">
                                                                    กรุณากรอกหมายเลข Tracking 13 หลัก
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group text-right">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">ยกเลิก</button>
                                                            <button type="submit" class="btn btn-main">ยืนยัน</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Cimfirm Modal -->
                                    @endif
                                    @if ($new_order->order_dog != null && $new_order->order_microchip == null)
                                    รายการจัดส่งสินค้า {{ $new_order->id}} "{{ $new_order->order_dog}}"
                                    @elseif ($new_order->order_microchip != null && $new_order->order_dog == null)
                                    รายการจัดส่งสินค้า {{ $new_order->id}} "{{ $new_order->order_microchip}}"
                                    @elseif ($new_order->order_dog != null && $new_order->order_microchip != null)
                                    รายการจัดส่งสินค้า {{ $new_order->id}} "{{ $new_order->order_dog }} ,
                                    {{ $new_order->order_microchip }}"
                                    @endif
                                    วันกำหนดส่ง {{ $new_order->order_due_date }}
                                </li>
                                @empty
                                <li class="list-group-item">ไม่มีรายการจัดส่งสินค้าใหม่</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white border-0">
                                <div class="text-xs font-weight-bold text-main mb-1">
                                    <i class="fas fa-chart-pie"></i> Pie Chart
                                </div>
                            </div>
                            <div class="card-body">
                                <div style="width:100%">
                                    {!! $transport_chart->container() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{!! $transport_chart->script() !!}
@endsection
