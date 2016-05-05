@extends('layouts.app')

@section('header')
	Edit Access
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<form class="form-horizontal" role="form" method="POST" action="{{ url('/settings/access/edit') }}">
				{!! csrf_field() !!}
				<input type="hidden" name="roleId" value="{{ Request::segment(3) }}" />

				<div class="control-group">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="center" width="10%">Display</th>
								<th class="center">Menu</th>
								<th class="center" width="5%">Add</th>
								<th class="center" width="5%">Edit</th>
								<th class="center" width="5%">Delete</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($item as $i)
							<tr>
								<td class="center">
									<div class="checkbox">
										<label>
											<input name="menu[{{ $i['id'] }}]" type="checkbox" class="ace head-checkbox" head-id="{{ $i['id'] }}" @if ($i['access']) checked @endif>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<b>{{ $i['name'] }}</b>
								</td>
								<td class="center {{ $i['id'] }}">
									@if (empty($i['child']))
									<div class="checkbox">
										<label>
											<input name="add[{{ $i['id'] }}]" type="checkbox" class="ace" @if ($i['access']['add'] == 'Y') checked @endif>
											<span class="lbl"></span>
										</label>
									</div>
									@endif
								</td>
								<td class="center {{ $i['id'] }}">
									@if (empty($i['child']))
									<div class="checkbox">
										<label>
											<input name="edit[{{ $i['id'] }}]" type="checkbox" class="ace" @if ($i['access']['edit'] == 'Y') checked @endif>
											<span class="lbl"></span>
										</label>
									</div>
									@endif
								</td>
								<td class="center {{ $i['id'] }}">
									@if (empty($i['child']))
									<div class="checkbox">
										<label>
											<input name="delete[{{ $i['id'] }}]" type="checkbox" class="ace" @if ($i['access']['delete'] == 'Y') checked @endif>
											<span class="lbl"></span>
										</label>
									</div>
									@endif
								</td>
							</tr>

							@foreach ($i['child'] as $c)
							<tr>
								<td class="center {{ $i['id'] }}">
									<div class="checkbox">
										<label>
											<input name="menu[{{ $c['id'] }}]" type="checkbox" class="ace" @if ($c['access']) checked @endif>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									--> {{ $c['name'] }}
								</td>
								<td class="center {{ $i['id'] }}">
									<div class="checkbox">
										<label>
											<input name="add[{{ $c['id'] }}]" type="checkbox" class="ace" @if ($c['access']['add'] == 'Y') checked @endif>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="center {{ $i['id'] }}">
									<div class="checkbox">
										<label>
											<input name="edit[{{ $c['id'] }}]" type="checkbox" class="ace" @if ($c['access']['edit'] == 'Y') checked @endif>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="center {{ $i['id'] }}">
									<div class="checkbox">
										<label>
											<input name="delete[{{ $c['id'] }}]" type="checkbox" class="ace" @if ($c['access']['delete'] == 'Y') checked @endif>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
							</tr>
							@endforeach

							@endforeach
						</tbody>
					</table>
				</div>

				<div class="space-4"></div>

				<div class="form-group">
					<div class="col-md-12">
						<button type="submit" class="btn btn-info">
							<i class="ace-icon fa fa-check bigger-110"></i>
							Submit
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@section('script')
	$('.head-checkbox').change(function() {
		if (this.checked) {
			$('.' + $(this).attr('head-id') + ' :checkbox').prop('disabled', false);
		}
		else {
			$('.' + $(this).attr('head-id') + ' :checkbox').prop('disabled', true);
		}
	});
@endsection