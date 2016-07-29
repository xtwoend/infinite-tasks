@section('formHeader')
{!! Form::text('title', $row->title , ['class' => 'form-control input-title', 'placeholder' => 'Task name...']) !!}
@endsection

@section('formLeft')

{{ method_field('PUT') }}

<div class="form-group">
	<label>DATE</label>
	<div class="input-group">
		{!! Form::text('date', $row->date , ['class' => 'form-control datetime']) !!}
		<span class="input-group-addon"><i class="icon icon-calendar"></i></span>
	</div>
</div>

<div class="form-group">
	<label>PRIORITY</label>
	<div class="input-group">
		<div class="radio-inline i-checks">
		    <label>
		      {!! Form::radio('priority', 0) !!}<i></i> LOW
		    </label>
		</div>
		<div class="radio-inline i-checks">
		    <label>
		      {!! Form::radio('priority', 1, true) !!}<i></i> NORMAL
		    </label>
		</div>
		<div class="radio-inline i-checks">
		    <label>
		      {!! Form::radio('priority', 2) !!}<i></i> HIGH
		    </label>
		</div>
	</div>
</div>

<div class="form-group">
  	<label>DESCRIPTION</label>
  	{!! Form::textarea('description', $row->description , ['class' => 'form-control', 'rows' => 5]) !!}
</div>

<div class="form-group">
	<label>OPTIONS</label>
	<div class="checkbox i-checks">
	  <label>
	    {!! Form::checkbox('status', 1, ($row->status == 1)? true: false) !!}<i></i> Actived this task
	  </label>
	</div>

</div>

@endsection


@section('formRight')


@endsection
