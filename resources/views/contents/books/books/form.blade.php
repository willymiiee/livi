@extends('layouts.app')

@section('header')
	@if (!isset($item))
	Add Book
	@else
	Edit Book
	@endif
@endsection

@section('style')
	<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}" />
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<form class="form-horizontal" role="form" method="POST" action="{{ (isset($item) ? url('/books/list/edit') : url('/books/list/add')) }}" enctype="multipart/form-data">
				{!! csrf_field() !!}
				@if (isset($item))
				{{ method_field('PUT') }}
				<input type="hidden" name="id" value="{{ $item->id or '' }}" />
				@endif

				<div class="col-xs-12 col-xs-5">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="identifier"> Identifier </label>

						<div class="col-sm-9">
							<input type="text" id="identifier" name="identifier" class="col-xs-12" @if (isset($item)) value="{{ $item->identifier }}" @endif required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="category"> Category </label>

						<div class="col-sm-9">
							<select multiple="" name="category[]" id="category" class="select2 tag-input-style" data-placeholder="Klik untuk memilih..." >
								<option value="">&nbsp;</option>
								@foreach ($category as $c)
								<option value="{{ $c['id'] }}">{{ $c['name'] }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="description"> Description </label>

						<div class="col-sm-9">
							<textarea maxlength="50" id="description" name="description" class="form-control limited">@if(isset($item)){{$item->description}}@endif</textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="year"> Year </label>

						<div class="col-sm-9">
							<input type="text" id="year" name="year" class="col-xs-10 col-sm-3" @if (isset($item)) value="{{ $item->year }}" @endif required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="currency"> Currency </label>

						<div class="col-sm-9">
							<select class="col-xs-10 col-sm-3" id="currency" name="currency" required>
								<option disabled @if (!isset($item)) selected @endif> Pilih mata uang </option>
								<option value="IDR" @if (isset($item) && $item['currency'] == 'IDR') selected @endif> IDR </option>
								<option value="EUR" @if (isset($item) && $item['currency'] == 'EUR') selected @endif> EUR </option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="resellerShare"> Reseller Share </label>

						<div class="col-sm-9">
							<input type="text" id="resellerShare" name="resellerShare" class="col-xs-10 col-sm-3" @if (isset($item)) value="{{ $item->reseller_share }}" @endif />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="encryption"> Encryption </label>

						<div class="col-sm-9">
							<input type="text" id="encryption" name="encryption" class="col-xs-6" @if (isset($item)) value="{{ $item->encryption }}" @endif />
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-xs-6">
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="title"> Title </label>

						<div class="col-sm-10">
							<input type="text" id="title" name="title" class="col-xs-12" @if (isset($item)) value="{{ $item->title }}" @endif required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="creator"> Creator </label>

						<div class="col-sm-10">
							<input type="text" id="creator" name="creator" class="col-xs-6" @if (isset($item)) value="{{ $item->creator }}" @endif required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="language"> Language </label>

						<div class="col-sm-10">
							<input type="text" id="language" name="language" class="col-xs-5" @if (isset($item)) value="{{ $item->language }}" @endif />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="publisher"> Publisher </label>

						<div class="col-sm-10">
							<input type="text" id="publisher" name="publisher" class="col-xs-6" @if (isset($item)) value="{{ $item->publisher }}" @endif />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="price"> Price </label>

						<div class="col-sm-10">
							<input type="text" id="price" name="price" class="col-xs-3" @if (isset($item)) value="{{ $item->price }}" @endif />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="format"> Format </label>

						<div class="col-sm-10">
							<input type="text" id="format" name="format" class="col-xs-5" @if (isset($item)) value="{{ $item->format }}" @endif />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="whitelabel"> Whitelabel </label>

						<div class="col-sm-10">
							<input type="text" id="whitelabel" name="whitelabel" class="col-xs-5" @if (isset($item)) value="{{ $item->whitelabel }}" @endif />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right" for="type"> Type </label>

						<div class="col-sm-10">
							<input type="text" id="type" name="type" class="col-xs-5" @if (isset($item)) value="{{ $item->type }}" @endif />
						</div>
					</div>
				</div>

				<div class="col-xs-12">
					<div class="form-group">
						<label class="col-md-offset-2 col-sm-2 control-label no-padding-right" for="epub"> Epub file </label>
						
						<div class="col-sm-2">
							<input type="file" name="epub" id="epub" @if (isset($item)) value="{{ $item->epub }}" @endif></input>
						</div>

						@if (isset($item) && $item->epub != null)
						<div class="col-sm-3">
							<a href="{{ $item->epub }}"> Download here </a>
						</div>
						@endif
					</div>

					<div class="form-group">
						<label class="col-md-offset-2 col-sm-2 control-label no-padding-right" for="epubSample"> Sample Epub file </label>
						
						<div class="col-sm-2">
							<input type="file" name="epubSample" id="epubSample" @if (isset($item)) value="{{ $item->epub_sample }}" @endif></input>
						</div>

						@if (isset($item) && $item->epub_sample != null)
						<div class="col-sm-3">
							<a href="{{ $item->epub_sample }}"> Download here </a>
						</div>
						@endif
					</div>

					<div class="form-group">
						<label class="col-md-offset-2 col-sm-2 control-label no-padding-right" for="cover"> Cover Image </label>
						
						<div class="col-sm-2">
							<input type="file" name="cover" id="cover" @if (isset($item)) value="{{ $item->cover }}" @endif></input>
						</div>

						@if (isset($item) && $item->cover != null)
						<div class="col-sm-3">
							<img src="{{ $item->cover }}">
						</div>
						@endif
					</div>

					<div class="form-group">
						<div class="checkbox">
							<label class="col-md-offset-3 col-xs-2">
								<input type="checkbox" class="ace" name="featured" @if (isset($item) && $item['featured'] == 'Y') checked @endif>
								<span class="lbl"> Featured</span>
							</label>

							<label class="col-xs-2">
								<input type="checkbox" class="ace" name="newRelease" @if (isset($item) && $item['new'] == 'Y') checked @endif>
								<span class="lbl"> New Release</span>
							</label>

							<label class="col-xs-2">
								<input type="checkbox" class="ace" name="bestSeller" @if (isset($item) && $item['best_seller'] == 'Y') checked @endif>
								<span class="lbl"> Best Seller</span>
							</label>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-offset-5 col-md-3">
							<button type="submit" class="btn btn-info">
								<i class="ace-icon fa fa-check bigger-110"></i>
								Submit
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@section('script')
	$(function() {
		$('.select2').css('width','100%').select2({allowClear:true})

		@if (isset($item))
		var cat = '{{ $item-> category }}';
		cat = cat.split(',');
		var arrCat = [];
		for (i=0; i < cat.length; i++) {
			arrCat.push(cat[i]);
		}
		$('#category').val(arrCat).trigger("change");
		@endif
	});
@endsection