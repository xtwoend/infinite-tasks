@section('formHeader')
{!! Form::text('name', $row->name , ['class' => 'form-control input-title', 'placeholder' => 'name...']) !!}
@endsection

@section('formLeft')

{{ method_field('PUT') }}

<div class="form-group">
  	<label>EMAIL</label>
  	{!! Form::text('email', $row->email , ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  	<label>PASSWORD</label>
  	{!! Form::password('password', ['class' => 'form-control']) !!}
	<span class="help-block m-b-none">Isi jika ingin mereset password, biarkan kosong jika tidak</span>
</div>
{{-- <div class="form-group">
	<label>PHOTO</label>
	@forelse($row->avatar as $sample)
	<div class="file-uplod">
	{{ Form::hidden('usersample', $sample->id) }}
	{!! Form::file(null, ['class' => 'filestyle fileupload', 'data-iconName' => 'fa fa-folder-open', 'data-classInput' => 'form-control inline v-middle input-s', 'data-buttonText' => '', 'data-url'=> route('admin.media.upload'), 'data-placeholder' => $sample->name , 'data-field'=>'usersample']) !!}
	</div>
	@empty
	<div class="file-uplod">
		{!! Form::file(null, ['class' => 'filestyle fileupload', 'data-iconName' => 'fa fa-folder-open', 'data-classInput' => 'form-control inline v-middle input-s', 'data-buttonText' => '', 'data-url'=> route('admin.media.upload'), 'data-field'=>'usersample']) !!}
	</div>
	@endforelse
</div> --}}

<div class="form-group">
	<label>OPTIONS</label>
	<div class="checkbox i-checks">
	  <label>
	    {!! Form::checkbox('status', 1, ($row->status == 1)? true: false) !!}<i></i> Actived this user
	  </label>
	</div>

</div>

@endsection


@section('formRight')


@endsection
