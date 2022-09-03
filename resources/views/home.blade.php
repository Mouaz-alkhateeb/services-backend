@extends('layouts.master')
@section('title')
لوحة التحكم 
@endsection
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex"><h4 class="content-title mb-0 my-auto">لوحة التحكم</h4></div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
				<div class="row row-sm">
									<div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
										<div class="card text-center">
											<div class="card-body ">
												<div class="feature widget-2 text-center mt-0 mb-3">
													<i class="ti-stats-up project bg-success-transparent mx-auto text-success "></i>
												</div>
												<h6 class="mb-1 text-muted"> إجمالي الأرباح</h6>
												<h3 class="font-weight-semibold">{{number_format($total)}} </h3>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
										<div class="card text-center">
											<div class="card-body ">
												<div class="feature widget-2 text-center mt-0 mb-3">
												<i class="fe fe-users project bg-pink-transparent text-pink mx-auto"></i></i>
												</div>
												<h6 class="mb-1 text-muted"> عدد المستخدمين</h6>
												<h3 class="font-weight-semibold">{{$users}}</h3>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
										<div class="card text-center">
											<div class="card-body ">
												<div class="feature widget-2 text-center mt-0 mb-3">
													<i class="ti-pie-chart project bg-pink-transparent mx-auto text-pink "></i>
												</div>
												<h6 class="mb-1 text-muted"> الخدمات النشطة</h6>
												<h3 class="font-weight-semibold">{{$services}}</h3>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-6 col-sm-6 col-md-6">
										<div class="card text-center">
											<div class="card-body ">
												<div class="card-chart bg-primary-transparent brround mx-auto  text-center mt-0 mb-3">
															<i class="typcn typcn-group-outline text-primary tx-24"></i>
												</div>								
												<h6 class="mb-1 text-muted"> مقدمي الخدمات</h6>
												<h3 class="font-weight-semibold">{{$providers}}</h3>
												
											</div>
										</div>
									</div>	
				</div>
                <div class="row row-sm">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
						<div class="card">
							<div class="card-body iconfont text-right">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mb-3"> عدد الطلبات الكلي</h4>
									<i class="mdi mdi-dots-vertical"></i>
								</div>
								<div class="d-flex mb-0">
									<div class="">
										<h4 class="mb-1 font-weight-bold">{{$orders}}<span class="text-danger tx-13 ml-2"></span></h4>
										
									</div>
									<div class="card-chart bg-success-transparent brround mr-auto mt-0">
									     <i class="typcn typcn-time  text-purple tx-24"></i>
									</div>
								</div>

								<div class="progress progress-sm mt-2">
									<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar bg-pink wd-50p" role="progressbar"></div>
								</div>
								<small class="mb-0  text-muted">شهريا<span class="float-left text-muted">100%</span></small>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
						<div class="card">
							<div class="card-body iconfont text-right">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mb-3">  الطلبات المنفذة</h4>
									<i class="mdi mdi-dots-vertical"></i>
								</div>
								<div class="d-flex mb-0">
									<div class="">
										<h4 class="mb-1 font-weight-bold">{{$Fullfilled_orders}}<span class="text-danger tx-13 ml-2"></span></h4>
										
									</div>
									<div class="card-chart bg-pink-transparent brround mr-auto mt-0">
										<i class="typcn typcn-chart-line-outline text-pink tx-24"></i>
									</div>
								</div>

								<div class="progress progress-sm mt-2">
									<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar bg-pink wd-50p" role="progressbar"></div>
								</div>
								<small class="mb-0  text-muted">شهريا<span class="float-left text-muted">{{$nspa1}}%</span></small>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
						<div class="card">
							<div class="card-body iconfont text-right">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mb-3"> الطلبات قيد التنفيذ</h4>
									<i class="mdi mdi-dots-vertical"></i>
								</div>
								<div class="d-flex mb-0">
									<div class="">
										<h4 class="mb-1   font-weight-bold">{{ $Partially_Fullfilled_Orders}}<span class="text-success tx-13 ml-2"></span></h4>
										
									</div>
									<div class="card-chart bg-teal-transparent brround mr-auto mt-0">
										<i class="typcn typcn-chart-bar-outline text-teal tx-20"></i>
									</div>
								</div>

								<div class="progress progress-sm mt-2">
									<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar bg-teal wd-60p" role="progressbar"></div>
								</div>
								<small class="mb-0  text-muted">شهريا<span class="float-left text-muted">{{$nspa2}}%</span></small>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
						<div class="card">
							<div class="card-body iconfont text-right">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mb-3"> الطلبات الغير منفذة</h4>
									<i class="mdi mdi-dots-vertical"></i>
								</div>
								<div class="d-flex mb-0">
									<div class="">
										<h4 class="mb-1 font-weight-bold">{{$UnFullfilled_Orders}} <span class="text-success tx-13 ml-2"></span></h4>
										
									</div>
									<div class="card-chart bg-purple-transparent brround mr-auto mt-0">
										<i class="typcn typcn-time  text-purple tx-24"></i>
									</div>
								</div>

								<div class="progress progress-sm mt-2">
									<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar bg-purple wd-40p" role="progressbar"></div>
								</div>
								<small class="mb-0  text-muted">شهريا<span class="float-left text-muted">{{$nspa3}}%</span></small>
							</div>
						</div>
					</div>
				</div>
				<div class="row row-sm">
        <div class="col-md-12 col-lg-12 col-xl-7">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0"> احصائية الطلبات</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>

                </div>
                <div class="card-body" style="width:75%;" >
                    {!! $chartjs->render() !!}
                </div>
            </div>
        </div>


        <div class="col-lg-12 col-xl-5">
            <div class="card card-dashboard-map-one">
                <label class="main-content-label">نسبة احصائية الطلبات</label>
                <div class="" >
				{!! $chartjs2->render() !!}
                </div>
            </div>
        </div>
    </div>
				<!-- row closed -->

				
			</div>
		</div>
		
		<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>	
@endsection