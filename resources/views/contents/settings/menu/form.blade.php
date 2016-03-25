@extends('layouts.app')

@section('header')
	@if (!isset($item))
	Add Menu
	@else
	Edit Menu
	@endif
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<form class="form-horizontal" role="form" method="POST" action="{{ (isset($item) ? url('/settings/menu/edit') : url('/settings/menu/add')) }}">
				{!! csrf_field() !!}
				@if (isset($item))
				<input type="hidden" name="id" value="{{ $item->id or '' }}" />
				@endif

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="name"> Name </label>

					<div class="col-sm-9">
						<input type="text" id="name" name="name" class="col-xs-10 col-sm-5" @if (isset($item)) value="{{ $item->name }}" @endif required />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="head_menu"> Head Menu </label>

					<div class="col-sm-9">
						<select class="col-xs-10 col-sm-5" id="head_menu" name="head_menu">
							<option value="0"> As Head Menu </option>
							@foreach ($head as $h)
							<option value="{{ $h['id'] }}" @if (isset($item)) @if ($h['id'] == $item->parent_id) selected="selected" @endif @endif >{{ $h['name'] }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="url"> URL </label>

					<div class="col-sm-9">
						<input type="text" id="url" name="url" placeholder="#" class="col-xs-10 col-sm-5" @if (isset($item)) value="{{ $item->url }}" @endif required />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="icon"> Icon </label>

					<div class="col-sm-9">
						<input type="text" id="icon" name="icon" placeholder="ex: fa-cog, fa-book" class="col-xs-3 col-sm-2" @if (isset($item)) value="{{ $item->icon }}" @endif />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="order"> Order </label>

					<div class="col-sm-9">
						<input type="text" id="order" name="order" placeholder="0" class="col-xs-2 col-sm-1" @if (isset($item)) value="{{ $item->order }}" @endif />
					</div>
				</div>

				<div class="space-4"></div>

				<div class="form-group">
					<div class="col-md-offset-3 col-md-9">
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