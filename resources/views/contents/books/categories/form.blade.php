@extends('layouts.app')

@section('header')
	@if (!isset($item))
	Add Category
	@else
	Edit Category
	@endif
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<form class="form-horizontal" role="form" method="POST" action="{{ (isset($item) ? url('/books/categories/edit') : url('/books/categories/add')) }}">
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
					<label class="col-sm-3 control-label no-padding-right" for="code"> Code </label>

					<div class="col-sm-9">
						<input type="text" id="code" name="code" class="col-xs-10 col-sm-5" @if (isset($item)) value="{{ $item->code }}" @endif />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="head_cat"> Head Category </label>

					<div class="col-sm-9">
						<select class="col-xs-10 col-sm-5" id="head_cat" name="head_cat">
							<option value="0"> As Head Category </option>
							@foreach ($head as $h)
							<option value="{{ $h['id'] }}" @if (isset($item)) @if ($h['id'] == $item->parent_id) selected="selected" @endif @endif >{{ $h['name'] }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="type"> Type </label>

					<div class="col-sm-9">
						<select class="col-xs-10 col-sm-5" id="type" name="type">
							<option value="local"> Local </option>
							<option value="international"> International </option>
						</select>
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