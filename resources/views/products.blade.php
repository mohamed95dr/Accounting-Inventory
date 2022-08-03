@extends('layouts.master')
@section('title')
    المنتجات
@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المنتجات</h4>
                {{-- <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Empty</span> --}}
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#modaldemo8">إضافة منتج</a>

                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">  عداد</th>
                                    <th class="border-bottom-0"> رقم المنتج</th>

                                    <th class="border-bottom-0"> اسم المنتج</th>
                                    <th class="border-bottom-0">اسم القسم</th>
                                    <th class="border-bottom-0"> سعر الشراء</th>
                                    <th class="border-bottom-0"> سعر الجملة</th>
                                    <th class="border-bottom-0"> سعر المفرق</th>
                                    <th class="border-bottom-0"> الكمية</th>
                                    <th class="border-bottom-0"> تاريخ التوريد </th>
                                    <th class="border-bottom-0"> تاريخ الانتهاء </th>
                                    <th class="border-bottom-0"> الوصف </th>



                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($products as $x)
                                    <?php $i++; ?>
                                    {{--  --}}
                                    <tr>

                                        <td>{{ $i }}</td>
                                        <td> {{ $x->id }}</td>

                                        <td> {{ $x->product_name }}</td>
                                        <td>{{ $x->categories->cateory_name }}</td>
                                        <td>{{ $x->Purchasing_price }}</td>
                                        <td>{{ $x->Wholesale_price }}</td>
                                        <td>{{ $x->retail_price }}</td>
                                        <td>{{ $x->Quantity }}</td>
                                        <td>{{ $x->date_of_supply }}</td>
                                        <td>{{ $x->Expiry_date }}</td>
                                        <td>{{ $x->description }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-id="{{ $x->id }}" data-product_name="{{ $x->product_name }}"
                                                data-cateory_name="{{ $x->cateory_name }}"
                                                data-Purchasing_price="{{ $x->Purchasing_price }}"
                                                data-Wholesale_price="{{ $x->Wholesale_price }}"
                                                data-retail_price="{{ $x->retail_price }}"
                                                data-Quantity="{{ $x->Quantity }}"
                                                data-date_of_supply="{{ $x->date_of_supply }}"
                                                data-Expiry_date="{{ $x->Expiry_date }}"
                                                data-description="{{ $x->description }}" data-toggle="modal"
                                                href="#exampleModal2" title="تعديل"><i class="las la-pen"></i></a>

                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $x->id }}" data-product_name="{{ $x->product_name }}"
                                                data-cateory_name="{{ $x->cateory_name }}"
                                                data-Purchasing_price="{{ $x->Purchasing_price }}"
                                                data-Wholesale_price="{{ $x->Wholesale_price }}"
                                                data-retail_price="{{ $x->retail_price }}"
                                                data-Quantity="{{ $x->Quantity }}"
                                                data-date_of_supply="{{ $x->date_of_supply }}"
                                                data-Expiry_date="{{ $x->Expiry_date }}" data-toggle="modal"
                                                href="#modaldemo9" title="حذف"><i class="las la-trash"></i></a>

                                        </td>

                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Basic modal -->

            <div class="modal" id="modaldemo8">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">اضافة منتج</h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('/products') }}" method="post">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">رقم المنتج</label>
                                    <input type="text" class="form-control" id="product_id" name="product_id">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">اسم المنتج</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name">
                                </div>

                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="" selected disabled> --حدد القسم--</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->cateory_name }}</option>
                                    @endforeach
                                </select>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">سعر الشراء </label>
                                    <input type="text" class="form-control" id="Purchasing_price" name="Purchasing_price">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">سعر المبيع الجملة </label>
                                    <input type="text" class="form-control" id="Wholesale_price" name="Wholesale_price">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">سعر المبيع مفرق </label>
                                    <input type="text" class="form-control" id="retail_price" name="retail_price">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1"> الكمية </label>
                                    <input type="text" class="form-control" id="Quantity" name="Quantity">
                                </div>
                                

                                <div class="form-group">
                                    <label for="exampleInputEmail1"> تاريخ التوريد </label>
                                    <input type="date" class="form-control" id="date_of_supply" name="date_of_supply">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1"> تاريخ الانتهاء </label>
                                    <input type="date" class="form-control" id="Expiry_date" name="Expiry_date">
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">ملاحظات</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">تاكيد</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Basic modal -->
            </div>
            <!-- edit -->
            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">تعديل المنتج</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form action='products/update' method="post" autocomplete="off">
                                {{ method_field('patch') }}
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <input type="hidden" name="product_id" id="product_id" value="">

                                    <label for="recipient-name" class="col-form-label">اسم المنتج:</label>
                                    <input class="form-control" name="product_name" id="product_name" type="text">
                                </div>

 

                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="" selected disabled> --حدد القسم--</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->cateory_name }}</option>
                                    @endforeach
                                </select>

                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">سعر الشراء :</label>
                                    <input class="form-control" name="Purchasing_price" id="Purchasing_price" type="text">
                                </div>

                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">سعر مبيع الجملة :</label>
                                    <input class="form-control" name="Wholesale_price" id="Wholesale_price" type="text">
                                </div>

                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">سعر مبيع المفرق :</label>
                                    <input class="form-control" name="retail_price" id="retail_price" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label"> الكمية :</label>
                                    <input class="form-control" name="Quantity" id="Quantity" type="text">
                                </div>



                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label"> تاريخ التوريد :</label>
                                    <input class="form-control" name="date_of_supply" id="date_of_supply" type="date">
                                </div>

                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label"> تاريخ الانتهاء :</label>
                                    <input class="form-control" name="Expiry_date" id="Expiry_date" type="date">
                                </div>

                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">ملاحظات:</label>
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- delete -->

            <div class="modal" id="modaldemo9">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">حذف المنتج</h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="categories/destroy" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                <input type="hidden" name="id" id="id" value="">
                                <input class="form-control" name="product_name" id="product_name" type="text" readonly>
                                <input class="form-control" name="category_name" id="category_name" type="text" readonly>
                                <input class="form-control" name="Purchasing_price" id="Purchasing_price" type="text"
                                    readonly>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                <button type="submit" class="btn btn-danger">تاكيد</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
            <!-- row closed -->
        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
    {{-- edit button --}}
    <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var product_id = button.data('product_id')
            var product_name = button.data('product_name')
            var cateory_name = button.data('category_id')
            var Purchasing_price = button.data('Purchasing_price')
            var Wholesale_price = button.data('Wholesale_price')
            var retail_price = button.data('retail_price')
            var Quantity = button.data('Quantity')
            var date_of_supply = button.data('date_of_supply')
            var Expiry_date = button.data('Expiry_date')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #product_id').val(product_id);
            modal.find('.modal-body #product_name').val(product_name);
            modal.find('.modal-body #cateory_name').val(cateory_name);
            modal.find('.modal-body #Purchasing_price').val(Purchasing_price);
            modal.find('.modal-body #Wholesale_price').val(Wholesale_price);
            modal.find('.modal-body #retail_price').val(retail_price);
            modal.find('.modal-body #Quantity').val(Quantity);
            modal.find('.modal-body #date_of_supply').val(date_of_supply);
            modal.find('.modal-body #Expiry_date').val(Expiry_date);
            modal.find('.modal-body #description').val(description);
        })

        
    </script>
    {{-- delete button --}}
    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var product_id = button.data('product_id')
            var product_name = button.data('product_name')
            var category_name = button.data('category_name')
            var Purchasing_price = button.data('Purchasing_price')
            var Wholesale_price = button.data('Wholesale_price')
            var retail_price = button.data('retail_price')
            var Quantity = button.data('Quantity')
            var date_of_supply = button.data('date_of_supply')
            var Expiry_date = button.data('Expiry_date')
            var modal = $(this)
            modal.find('.modal-body #product_id').val(product_id);
            modal.find('.modal-body #product_name').val(product_name);
            modal.find('.modal-body #category_name').val(category_name);
            modal.find('.modal-body #Purchasing_price').val(Purchasing_price);
            modal.find('.modal-body #Wholesale_price').val(Wholesale_price);
            modal.find('.modal-body #retail_price').val(retail_price);
            modal.find('.modal-body #Quantity').val(Quantity);
            modal.find('.modal-body #date_of_supply').val(date_of_supply);
            modal.find('.modal-body #Expiry_date').val(Expiry_date);
        })
    </script>
@endsection
