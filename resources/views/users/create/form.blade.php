@section('formHeader')
{!! Form::text('name', null , ['class' => 'form-control input-title', 'placeholder' => 'fullname...']) !!}
@endsection

@section('formLeft')


<div class="form-group">
  	<label>EMAIL</label>
  	{!! Form::text('email', null , ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  	<label>PASSWORD</label>
  	{!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  	<label>CONFRIM PASSWORD</label>
  	{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	<label>OPTIONS</label>
	<div class="checkbox i-checks">
	  <label>
	    {!! Form::checkbox('status', 1) !!}<i></i> Actived this user
	  </label>
	</div>

</div>

@endsection


@section('formRight')

@endsection
