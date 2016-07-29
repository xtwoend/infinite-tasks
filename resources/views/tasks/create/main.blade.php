@extends('layouts.form', ['form_url' => route('tasks.store')])

@section('title')
	Create task
@endsection

@section('headerContent')
  <h3 class="m-t-none m-b-none font-thin padder-v-sm">Create New task</h3>
@endsection

@include('tasks.create.tool')
@include('tasks.create.form')

@section('js')
    @if (count($errors) > 0)
	    <script>
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
