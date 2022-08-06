@extends('layouts.master')
@section('title')
    عرض فاتورةالبيع
@endsection
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    اضافة فاتورة
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    عرض فاتورة</span>
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
                    <form action=" " method="get" enctype="multipart/form-data" autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">رقم الفاتورة</label>
                                <input type="text" class="form-control" id="receipt_id" name="receipt_id"
                                    value="{{ $receipt_invoice->id }}" title="يرجي ادخال رقم الفاتورة" disabled>

                            </div>

                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" name="invoice_date" id="invoice_date"
                                    placeholder="YYYY-MM-DD" type="text" value="{{ $receipt_invoice->invoice_date }}"
                                    disabled>
                            </div>

                            <div class="col">
                                <label>اسم المورد</label>
                                <input class="form-control fc-datepicker" name="supplier_name" placeholder="YYYY-MM-DD"
                                    value="{{ $supplier_name }}" type="text" disabled>
                            </div>

                        </div>

                        {{-- 2 --}}
                        <br />
                        <h3>المنتجات :</h3>
                        
                        @foreach ($productsReceipt as $product)
                            <div class="row">

                                <div class="col">
                                    <label for="inputName" class="control-label">اسم المنتج</label>
                                    <input type="text" class="form-control" id="receipt_id" name="receipt_id"
                                        value="{{ $product->id }}" title="يرجي ادخال اسم المنتج " disabled>
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">القسم</label>
                                    <input type="text" class="form-control" id="category" name="category"
                                        value="{{ $product->category_name }}" title="يرجي ادخال القسم " disabled>
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">سعر الشراء</label>
                                    <input type="text" class="form-control" id="Pruchasing_price" name="Pruchasing_price"
                                        value="{{ $product->Pruchasing_price }}" title="يرجي ادخال  سعر الشراء" disabled>
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">الكمية</label>
                                    <input type="text" class="form-control" id="receipt_id" name="receipt_id"
                                        value="{{ $product->quantity }}" title="يرجي ادخال كمية المنتج " disabled>
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">تاريخ انتهاء الصلاحية</label>
                                    <input type="text" class="form-control" id="Expiry_date" name="Expiry_date"
                                        value="{{ $product->Expiry_date }}" title="يرجي ادخال تاريخ الصلاحية" disabled>
                                </div>

                            </div>
                        @endforeach



                        {{-- 3 --}}
                        <br>

                        <div class="row">


                            <div class="col">
                                <label for="inputName" class="control-label" style="font-weight: bold">الدين</label>
                                <input type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                    title="يرجي ادخال مبلغ الدين "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value={{ $cost }} disabled>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label" style="font-weight: bold"> القيمة
                                    المدفوعة</label>
                                <input type="text" class="form-control form-control-lg" id="paid_value"
                                    name="paid_value" title="يرجي ادخال مبلغ العمولة "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $receipt_invoice->amount_paid }}" disabled>

                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label" style="font-weight: bold">المبلغ الإجمالي
                                    :(مبلغ الفاتورة + مبلغ
                                    الدين) </label>
                                <input type="text" class="form-control form-control-lg" id="Total_Amount"
                                    name="Total_Amount" title="يرجي ادخال مبلغ العمولة "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $receipt_invoice->total_price }}" disabled>
                            </div>






                    </form>
                </div>
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
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
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

    <script>
        $(document).ready(function() {
            $('select[name="Section"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>


    <script>
        function myFunction() {
            var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);
            var Amount_Commission2 = Amount_Commission - Discount;
            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {
                alert('يرجي ادخال مبلغ العمولة ');
            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;
                var intResults2 = parseFloat(intResults + Amount_Commission2);
                sumq = parseFloat(intResults).toFixed(2);
                sumt = parseFloat(intResults2).toFixed(2);
                document.getElementById("Value_VAT").value = sumq;
                document.getElementById("Total").value = sumt;
            }
        }
    </script>


@endsection
