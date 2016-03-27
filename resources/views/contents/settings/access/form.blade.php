@extends('layouts.app')

@section('header')
	Edit Access
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="control-group">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="center">Display</th>
							<th class="center">Menu</th>
							<th class="center">Add</th>
							<th class="center">Edit</th>
							<th class="center">Delete</th>
						</tr>						
					</thead>

					<tbody>
						@foreach ($item as $i)
						<tr>
							<td class="center">
								<div class="checkbox">
									<label>
										<input type="checkbox" class="ace" name="form-field-checkbox" @if ($i['access']) checked @endif>
										<span class="lbl"></span>
									</label>
								</div>								
							</td>
							<td class="center">
								{{ $i['name'] }}
								@foreach ($i['child'] as $c)
								<div class="checkbox">
									<label>
										<input type="checkbox" class="ace" name="form-field-checkbox" @if ($c['access']) checked @endif>
										<span class="lbl">{{ $c['name'] }}</span>
									</label>
								</div>								
								@endforeach
							</td>
							<td class="center"></td>
							<td class="center"></td>
							<td class="center"></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>			
		</div>
	</div>
@endsection