@extends('layouts.master')
@section('css')
@endsection
@section('title')
    تغير الحالة 
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الطلبان</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تغير حالة الطلب</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('status_update', ['id' => $orders->id]) }}" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">رقم الطلب</label>
                                <input type="hidden" name="order_id" value="{{ $orders->id }}">
                                <input type="text" class="form-control" id="inputName" name="order_number"
                                    title="يرجي ادخال رقم الطلب" value="{{ $orders->order_number }}" required
                                    readonly>
                            </div>

                            <div class="col">
                                <label>تاريخ الطلب</label>
                                <input class="form-control fc-datepicker" name="order_Date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $orders->order_Date }}" required readonly>
                            </div>

                            <div class="col">
                                <label>تاريخ الإستلام</label>
                                <input class="form-control fc-datepicker" name="Due_Date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $orders->Due_Date }}" required readonly>
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                           

                            <div class="col">
                                <label for="inputName" class="control-label">الخدمة</label>
                                <select id="service" name="service" class="form-control" readonly>
                                    <option value="{{ $orders->service }}"> {{ $orders->service->name }}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">سعر الخدمة  </label>
                                <input type="text" class="form-control" id="inputName" name="Amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $orders->Amount_collection }}" readonly>
                            </div>
                        </div>
                        {{-- 3 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3" readonly>
                                {{ $orders->note }}</textarea>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">حالة الدفع</label>
                                <select class="form-control" id="PaymentStatus" name="PaymentStatus" required>
                                    <option selected="true" disabled="disabled">-- حدد حالة الدفع --</option>
                                    <option value="مدفوع">مدفوع</option>
                                    <option value="مدفوع جزئيا">مدفوع جزئيا </option>                                         
                                </select>
                            </div>

                            <div class="col">
                                <label for="exampleTextarea">حالة الطلب</label>
                                <select class="form-control" id="OrderStatus" name="OrderStatus" required>
                                    <option selected="true" disabled="disabled">-- حدد حالة الطلب --</option>
                                    <option value="منفذ">منفذ</option>
                                    <option value="قيد التنفيذ">قيد التنفيذ  </option>
                                </select>
                            </div>

                            <div class="col">
                                <label>تاريخ الدفع</label>
                                <input class="form-control fc-datepicker" name="Payment_Date" placeholder="YYYY-MM-DD"
                                    type="text" required>
                            </div>


                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">تحديث الحالة  </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>
@endsection