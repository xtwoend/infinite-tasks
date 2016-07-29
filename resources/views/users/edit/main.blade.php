@extends('layouts.form', ['form_url' => route('user.update', [$row->id])])

@section('title')
	Edit user
@endsection

@section('headerContent')
  <h3 class="m-t-none m-b-none font-thin padder-v-sm"> Edit user </h3>
@endsection

@include('users.edit.tool')
@include('users.edit.form')

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
