@extends('layouts.app')

@section('header')
	List Role
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
						<th class="center">Access</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					@foreach ($role as $m)
					<tr>
						<td class="center">{{ $m['name'] }}</td>
						<td class="center"><a href="{{ url('/settings/access/'.$m['id']) }}" class="btn btn-xs btn-primary">Accesses</a></td>
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
@endsection