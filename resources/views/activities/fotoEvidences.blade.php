	<div class="row">
	@foreach($evidences as $foto)
		<div class="col l4 m6 s12">
			<div class="card">
				<div class="card-image">
					<img src="{{ getenv('S3_FOLDER_BASE')}}{{ isset($foto->path)?$foto->path:'' }}" >
				</div>
				<div class="card-content">
					<p>{{ trans('activities.date') }}: {{ $foto->created_at->format('Y-m-d h:i:s A') }}</p>
					<p>{{ trans('activities.comments') }}: {{ $foto->comments }}
				</div>
				<div class="card-action">
					<a class="waves-effect btn blue darken-3 waves-light" href="{{ route('activity.download_photo_evidence', [$foto->id]) }}">Download</a>
				</div>
			</div>
		</div>
	@endforeach
	</div>
