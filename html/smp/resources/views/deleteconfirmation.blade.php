@extends('layouts.master')
@section('pagetitle', 'Delete')
@section('headerincludes')
<link href="/smp/style.css" rel="stylesheet" type="text/css">
@stop
@section('content')
	<div class="container">
		<div class="text-center">
			@if (count($list_images) == 0)
				<!-- No Images to Delete -->
				<h2>The images you are trying to delete either do not exist or have already been deleted.</h2>
				
				<!-- Go to Homepage -->
				<a href="/" class="btn btn-success" role="button">Go Back to Gallery</a>
				<br/>
			@else
				<!-- Images -->
				<form method="POST" id="mass-deletion" action="/image/delete">
					@if (count($list_images) == 1)
						<h2>Are you sure you want to delete the following image?</h2>
					@else
						<h2>Are you sure you want to delete the following images?</h2>
					@endif
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<!-- Iterate through the list of images and create the thumbnails and links -->
								@foreach ($list_images as $image)
									<div class="col-xs-4 col-sm-3 col-md-2 img-padding">
										<a href="/image/view/{{ $image->image_guid }}"><img src="/image/get/thumbnail/{{ $image->image_guid }}" alt="{{ $image->image_title }}" class="img-responsive center-block"></a>

										<!-- Hidden field to mark the image for deletion -->
										<input type="hidden" name="{{ $image->image_guid }}" value="1">
									</div>
								@endforeach
							</div>
						</div>
					</div>
					<!-- Delete Button -->
					<div class="text-center">
						<!-- Delete -->
						<button type="submit" class="btn btn-danger" id="delete-button">Yes</button>
						
						<!-- Cancel -->
						<a href="/" class="btn btn-success" role="button">No</a>

						<!-- Hidden field to confirm deletion -->
						<input type="hidden" name="confirm_action" value="1">

						<!-- CSRF -->
						{!! csrf_field() !!}
					</div>
				</form>
				<br/>
			@endif
		</div>
	</div>
@stop