@extends('layouts.form', ['form_url' => route('user.store')])

@section('title')
	Create user
@endsection

@section('headerContent')
  <h3 class="m-t-none m-b-none font-thin padder-v-sm">Create New user</h3>
@endsection

@include('users.create.tool')
@include('users.create.form')

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
