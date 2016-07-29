@extends('layouts.data')

@section('title')
	Tasks
@endsection

@section('headerContent')
  <h3 class="m-t-none m-b-none font-thin padder-v-sm">Tasks Manage</h3>
@endsection


@include('tasks.default.data')
@include('tasks.default.tool')

@section('js')
    <script type="text/javascript" src="{{ asset('js/apps/tasks.js') }}"></script>
@endsection
