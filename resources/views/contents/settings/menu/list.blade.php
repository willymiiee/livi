@extends('layouts.app')

@section('header')
	List Menu
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<a class="btn btn-sm btn-primary" href="{{ url()->current().'/add' }}">
				<i class="ace-icon fa fa-pencil align-top bigger-125"></i>
				Add Data
			</a>

			@if (Session::has('flash-message'))
			<div class="alert alert-block alert-success">
				<button data-dismiss="alert" class="close" type="button">
					<i class="ace-icon fa fa-times"></i>
				</button>

				<p>
					<strong>
						<i class="ace-icon fa fa-check"></i>
						{{ Session::get('flash-message') }}
					</strong>
				</p>
			</div>
			@endif

			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="center">Name</th>
						<th class="center">URL</th>
						<th class="center hidden-480">Order</th>
						<th class="center">Submenus</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					@foreach ($head as $m)
					<tr>
						<td class="center">{{ $m['name'] }}</td>
						<td class="center hidden-480">{{ $m['url'] }}</td>
						<td class="center">{{ $m['order'] }}</td>
						<td class="center">
							@if ($m['url'] == '#')
							<a href="#modal-form" class="submenu btn btn-xs btn-success" menu-id="{{ $m['id'] }}" data-toggle="modal">Submenu</a>
							@endif
						</td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">
								<a href="{{ url()->current().'/edit/'.$m['id'] }}" class="btn btn-xs btn-info">
									<i class="ace-icon fa fa-pencil bigger-120"></i>
								</a>

								<a href="{{ url()->current().'/delete/'.$m['id'] }}" onclick="return confirm('Are you sure?');" class="btn btn-xs btn-danger">
									<i class="ace-icon fa fa-trash-o bigger-120"></i>
								</a>
							</div>

							<div class="hidden-md hidden-lg">
								<div class="inline pos-rel">
									<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
										<i class="ace-icon fa fa-cog icon-only bigger-110"></i>
									</button>

									<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
										<li>
											<a href="{{ url()->current().'/edit/'.$m['id'] }}" class="tooltip-success" data-rel="tooltip" title="Edit">
												<span class="green">
													<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
												</span>
											</a>
										</li>

										<li>
											<a href="{{ url()->current().'/delete/'.$m['id'] }}" onclick="return confirm('Are you sure?');" class="tooltip-error" data-rel="tooltip" title="Delete">
												<span class="red">
													<i class="ace-icon fa fa-trash-o bigger-120"></i>
												</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div><!-- /.span -->
	</div>

	<div id="modal-form" class="modal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="blue bigger">Please fill the following form fields</h4>
				</div>

				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th class="center">Name</th>
										<th class="center">URL</th>
										<th class="center hidden-480">Order</th>
										<th></th>
									</tr>
								</thead>
								<tbody id="content">
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	$('.submenu').click(function() {
		$('#content').empty();
		$.get('menu/get/' + $(this).attr('menu-id'), function(data) {
			$.each(data, function(key,value) {
				$('#content').append('<tr><td class="center">'+value.name+'</td><td class="center">'+value.url+'</td><td class="center hidden-480">'+value.order+'</td><td><div class="btn-group"><a href="menu/edit/'+value.id+'" class="btn btn-xs btn-info"><i class="ace-icon fa fa-pencil bigger-120"></i></a><a href="menu/delete/'+value.id+'" onclick="return confirm(\'Are you sure?\');" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-trash-o bigger-120"></i></a></div></td></tr>');
			});
		});
	});
@endsection