@extends('layouts.master')
@section('title')
كمية المبيعات
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
							<h4 class="content-title mb-0 my-auto">كمية المبيعات</h4>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table key-buttons text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">رقم الفاتورة</th>
                                        <th class="border-bottom-0">تاريخ الفاتورة</th>
                                        <th class="border-bottom-0">اسم الزبون </th>
    
    
                                    </tr>
                                </thead>
                                <tbody>
    
                                    <?php $i = 0; ?>
                                    @foreach ($sale_invoices as $x)
                                        <?php $i++; ?>
                                        
                                        <tr>
    
                                            <td>{{ $i }}</td>
                                            <td> {{ $x->invoice_date }}</td>
                                            <td>{{ $x->customers->name }}</td>
                                            <td>

                                            </td>
                                        </tr>
                                    @endforeach
    
                                </tbody>
                            </table>
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
@endsection