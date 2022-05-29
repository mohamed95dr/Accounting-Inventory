@extends('layouts.master')
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


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap Table with Add and Delete Row Feature</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        body {
            color: #404E67;
            background: #F5F7FA;
            font-family: 'Open Sans', sans-serif;
            /* direction: rtl */
        }

        .table-wrapper {
            width: 700px;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            padding-bottom: 10px;
            margin: 0 0 10px;
        }

        .table-title h2 {
            margin: 6px 0 0;
            font-size: 22px;
        }

        .table-title .add-new {
            float: right;
            height: 30px;
            font-weight: bold;
            font-size: 12px;
            text-shadow: none;
            min-width: 100px;
            border-radius: 50px;
            line-height: 13px;
        }

        .table-title .add-new i {
            margin-right: 4px;
        }

        table.table {
            table-layout: fixed;
        }

        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table th:last-child {
            width: 100px;
        }

        table.table td a {
            cursor: pointer;
            display: inline-block;
            margin: 0 5px;
            min-width: 24px;
        }

        table.table td a.add {
            color: #27C46B;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #E34724;
        }

        table.table td i {
            font-size: 19px;
        }

        table.table td a.add i {
            font-size: 24px;
            margin-right: -1px;
            position: relative;
            top: 3px;
        }

        table.table .form-control {
            height: 32px;
            line-height: 32px;
            box-shadow: none;
            border-radius: 2px;
        }

        table.table .form-control.error {
            border-color: #f50000;
        }

        table.table td .add {
            display: none;
        }

    </style>

    {{-- scrol --}}
    <style>
        .custom-scrollbar-js,
        .custom-scrollbar-css {
            height: 200px;
        }


        /* Custom Scrollbar using CSS */
        .custom-scrollbar-css {
            overflow-y: scroll;
        }

        /* scrollbar width */
        .custom-scrollbar-css::-webkit-scrollbar {
            width: 7px;
        }

        /* scrollbar track */
        .custom-scrollbar-css::-webkit-scrollbar-track {
            background: #eee;
        }

        /* scrollbar handle */
        .custom-scrollbar-css::-webkit-scrollbar-thumb {
            border-radius: 1rem;
            background-color: #00d2ff;
            background-image: linear-gradient(to top, #00d2ff 0%, #3a7bd5 100%);
        }

        body {
            min-height: 150vh;
            background-color: #00d2ff;
            /* background-image: linear-gradient(to right, #00d2ff 0%, #3a7bd5 100%); */
        }

        span {
            float: left;
        }

    </style>

    {{-- end scrol --}}

@endsection
@section('title')
    اضافة فاتورة
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">فواتير الشراء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة فاتورة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
<!--  -->
                    <form action="{{ route('receipt.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">السيد المحترم : اسم المورد </label>
                                {{-- add supplier --}}
                                <span>
                                    <a href="{{ url('view_invoice/') }}" class="btn btn-sm btn-info pull-right">اضافة مورد
                                    </a>
                                </span>

                                <select name="supplier_name" class="form-control SlectBox">
                                    <!--placeholder-->
                                    <option value="" selected disabled>اختر مورد</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->name }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" name="invoice_date" type="datetime-local"
                                    value="{{ date('Y-m-d') }}" required>
                            </div>


                        </div>

                        {{-- 3 --}}



                        {{-- custom scrole --}}

                        <div class="container py-5">


                            <div class="table-responsive">
                                <div class="">
                                    <div class="table-title">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <h2> أدخل المنتجات : </h2>
                                            </div>
                                            <div class="col-sm-8">
                                                <button type="button" class="btn btn-info add-new"><i
                                                        class="fa fa-plus"></i> منتج جديد</button>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0"> رقم المنتج</th>
                                                <th class="border-bottom-0"> اسم المنتج</th>
                                                <th class="border-bottom-0">اسم الصنف</th>
                                                <th class="border-bottom-0"> سعر الشراء</th>
                                                <th class="border-bottom-0"> سعر الجملة</th>
                                                <th class="border-bottom-0"> سعر المفرق</th>
                                                <th class="border-bottom-0"> الكمية</th>
                                                <th class="border-bottom-0"> الواحدة</th>
                                                <th class="border-bottom-0"> تاريخ التوريد </th>
                                                <th class="border-bottom-0"> تاريخ الانتهاء </th>
                                                <th class="border-bottom-0"> العمليات </th>

                                            </tr>
                                        </thead>
                                        <tbody>



                                    </table>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col">
                                    <label for="inputName" class="control-label">مبلغ الفاتورة </label>
                                    <input type="text" class="form-control form-control-lg" id="Amount_Commission"
                                        name="Amount_Commission" title="يرجي ادخال مبلغ العمولة "
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        required>
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">الدين</label>
                                    <input type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                        title="يرجي ادخال مبلغ الخصم "
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        value=0 required>
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label"> القيمة المدفوعة</label>
                                    <input type="text" class="form-control form-control-lg" id="paid-value"
                                        name="paid_value" title="يرجي ادخال مبلغ العمولة "
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        required>
                                    {{-- <select name="Rate_VAT" id="Rate_VAT" class="form-control" onchange="myFunction()">
                                        <!--placeholder-->
                                        <option value="" selected disabled>حدد نسبة الضريبة</option>
                                        <option value=" 5%">5%</option>
                                        <option value="10%">10%</option> --}}
                                    </select>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="inputName" class="control-label">المبلغ الإجمالي :(مبلغ الفاتورة + مبلغ
                                        الدين) </label>
                                    <input type="text" class="form-control form-control-lg" id="Amount_Commission"
                                        name="Amount_Commission" title="يرجي ادخال مبلغ العمولة "
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        required>
                                </div>

                            </div>

                            <div class="row m-3">
                                <button type="submit" class="btn btn-success m-auto ">تاكيد</button>
                            </div>


                        </div>


                    </form>
                    {{-- end scrole --}}


                </div>
            </div>

        </div>

        <!-- row closed -->
    </div>
    <!-- Container closed -->
    
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
            $('select[name="categories"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ URL::to('categories') }}/" + category_id,
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

    {{-- scrol --}}
    <script>
        $(function() {
            /* Rounded Dots Dark */
            $("#content-1").mCustomScrollbar({
                theme: "rounded-dots-dark"
            });

            /* Rounded Dark */
            $("#content-2").mCustomScrollbar({
                theme: "rounded-dark"
            });

            /* Inset Dark */
            $("#content-3").mCustomScrollbar({
                theme: "inset-3-dark"
            });

            /* 3d Dark */
            $("#content-4").mCustomScrollbar({
                theme: "3d-dark"
            });

            /* Dark Thin */
            $("#content-5").mCustomScrollbar({
                theme: "dark-thin"
            });
        });
    </script>
    {{-- end scrol --}}

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


    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            var actions = $("table td:first-child").html();
            // Append table with add row form on add new button click
            var i= 1;
            $(".add-new").click(function() {
                $(this).attr("disabled", "disabled");
                var index = $("table tbody tr:last-child").index();
                
                var row = '<tr>' +
                    '<td><input type="text" class="form-control" name="pid'+i  +'" id="pid"></td>' +
                    '<td><input type="text" class="form-control" name="pname'+i +'" id="pname"></td>' +
                    '<td><input type="text" class="form-control" name="category'+i +'" id="category"></td>' +
                    '<td><input type="text" class="form-control" name="Purchasing_price'+i +'" id="Purchasing_price"></td>' +
                    '<td><input type="text" class="form-control" name="Wholesale_price'+i  +'" id="Wholesale_price"></td>' +
                    '<td><input type="text" class="form-control" name="retail_price'+i  +'" id="retail_price"></td>' +
                    '<td><input type="text" class="form-control" name="quentity'+i  +'" id="quentity"></td>' +
                    '<td><input type="text" class="form-control" name="unit'+i +'" id="unit"></td>' +
                    '<td><input type="text" class="form-control" name="Purchasing_date'+i +'" id="Purchasing_date"></td>' +
                    '<td><input type="text" class="form-control" name="Expiry_date'+i +'" id="Expiry_date"></td>' +
                    '<td>' +
                    '    <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>' +
                    '<a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>' +
                    '<a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>' +
                    '</td>' +

                    '</tr>';
                    
                $("table").append(row);
                $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
                $('[data-toggle="tooltip"]').tooltip();
                i++;
            });



            // Add row on add button click
            $(document).on("click", ".add", function() {
                var empty = false;
                var input = $(this).parents("tr").find('input[type="text"]');
                input.each(function() {
                    if (!$(this).val()) {
                        $(this).addClass("error");
                        empty = true;
                    } else {
                        $(this).removeClass("error");
                    }
                });
                $(this).parents("tr").find(".error").first().focus();
                if (!empty) {
                    input.each(function() {
                        //td instaid p 
                        $(this).parent('input[type="text"]').html($(this).val());
                    });
                    $(this).parents("tr").find(".add, .edit").toggle();
                    $(".add-new").removeAttr("disabled");
                }
            });
            // Edit row on edit button click
            $(document).on("click", ".edit", function() {
                $(this).parents("tr").find("td:not(:last-child)").each(function() {
                    $(this).html('<input type="text" class="form-control" value="' + $(this)
                        .text() + '">');
                });
                $(this).parents("tr").find(".add, .edit").toggle();
                $(".add-new").attr("disabled", "disabled");
            });
            // Delete row on delete button click
            $(document).on("click", ".delete", function() {
                $(this).parents("tr").remove();
                $(".add-new").removeAttr("disabled");
            });
        });
    </script>


@endsection
