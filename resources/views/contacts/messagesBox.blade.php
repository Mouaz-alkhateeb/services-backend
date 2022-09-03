@extends('layouts.master')
@section('css')

@section('title')
الرسائل الواردة
@stop

<!-- Internal Data table css -->

<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">رسائل العملاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ صندوق الوارد
                </span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
@if (session()->has('delete'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف الرسالة بنجاح",
                    type: "primary"
                })
            }

        </script>
    @endif
				<!--Row-->
				<div class="row row-sm">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive border-top userlist-table">
									<table class="table card-table table-striped table-vcenter text-nowrap mb-0">
										<thead>
											<tr>
											<th class="wd-15p border-bottom-0">#</th>
											<th class="wd-15p border-bottom-0"><span class="badge badge-pill badge-success">اسم المرسل</span></th>
											<th class="wd-20p border-bottom-0"><span class="badge badge-pill badge-success">الإيميل </span></th>
											<th class="wd-15p border-bottom-0"><span class="badge badge-pill badge-success">العنوان </span></th>
                                            <th class="wd-15p border-bottom-0"><span class="badge badge-pill badge-success">التفاصيل </span></th>
											</tr>
										</thead>
										<tbody>
										<?php $i=0 ?>
										@foreach ($contacts as $contact)
											<?php $i++ ?>
											<tr>
                                                <td>{{$i}}</td>
												<td>{{ $contact->name }}</td>
												<td>{{ $contact->email }}</td>
                                                <td>{{ $contact->title }}</td>
                                                <td>
                                                        <a  class="btn btn-outline-success btn-sm " 
                                                           href="{{ url('message_details') }}/{{ $contact->id }}"><i class="fas fa-eye"></i>  
                                                        </a> 
														<a class="modal-effect btn btn-sm btn-outline-danger" data-effect="effect-scale"
															data-id="{{ $contact->id }}" data-name="{{ $contact->name }}"
															data-toggle="modal" href="#modaldemo9"
															title="حذف"><i class="las la-trash"></i></a>
                                                </td>												
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								
							</div>
						</div>
					</div>
					<!-- COL END -->
					</div>
				</div>
				<!-- row closed  -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
		<div class="modal fade" id="modaldemo9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">حذف الرسالة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="contacts/destroy" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل أنت متأكد من حذف رسالة هذا الشخص؟  </p><br>
                            <input type="hidden" name="id" id="id" value="" >
                            <input class="form-control" name="name" id="name" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
<!-- Internal Modal js-->
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>
<script>
  $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
        }) 
</script>
@endsection
