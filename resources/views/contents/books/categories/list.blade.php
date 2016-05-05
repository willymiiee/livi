@extends('layouts.app')

@section('header')
	List Categories
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<a class="btn btn-sm btn-primary" href="{{ url()->current().'/add' }}">
				<i class="ace-icon fa fa-pencil align-top bigger-125"></i>
				Add Data
			</a>

			<div class="space-6"></div>

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
						<th class="center">Sub-category</th>
						<th class="center">Code</th>
						<th class="center">Type</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					@foreach ($category as $m)
					<tr>
						<td><b>{{ $m['name'] }}</b></td>
						<td class="center">
							@if (!empty($m['child']))
							<a href="#modal-form" class="subcategory btn btn-xs btn-success" category-id="{{ $m['id'] }}" data-toggle="modal">Sub-category</a>
							@endif
						</td>
						<td class="center">{{ $m['code'] }}</td>
						<td class="center">{{ $m['type'] == 'local' ? 'Lokal' : 'Internasional' }}</td>
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

			{!! $category->links() !!}
		</div><!-- /.span -->
	</div>

	<div id="modal-form" class="modal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="blue bigger">List of Sub-category</h4>
				</div>

				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th class="center">Name</th>
										<th class="center">Code</th>
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
	$('.subcategory').click(function() {
		$('#content').empty();
		$.get('categories/get/' + $(this).attr('category-id'), function(data) {
			$.each(data, function(key,value) {
				$('#content').append('<tr><td class="center">'+value.name+'</td><td class="center">'+value.code+'</td><td><div class="btn-group"><a href="categories/edit/'+value.id+'" class="btn btn-xs btn-info"><i class="ace-icon fa fa-pencil bigger-120"></i></a><a href="categories/delete/'+value.id+'" onclick="return confirm(\'Are you sure?\');" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-trash-o bigger-120"></i></a></div></td></tr>');
			});
		});
	});
@endsection