@extends('layouts.form', ['form_url' => route('tasks.update', [$row->id])])

@section('title')
	Edit task
@endsection

@section('headerContent')
  <h3 class="m-t-none m-b-none font-thin padder-v-sm"> Edit task </h3>
@endsection

@include('tasks.edit.tool')
@include('tasks.edit.form')

@section('js')
    @if (count($errors) > 0)
	    <script type="text/javascript">
	    	$(document).ready(function(){
	    		var html = '';
	    		@foreach ($errors->all() as $error)
	    			html += '{{ $error }} \n';
	    		@endforeach
	    		swal("Oops...", html , "error");
	    	});
	    </script>
	@endif
@endsection
