@extends('layouts.data')

@section('title')
	Users
@endsection

@section('headerContent')
  <h3 class="m-t-none m-b-none font-thin padder-v-sm">Users Manage</h3>
@endsection


@include('users.default.data')
@include('users.default.tool')

@section('js')
    <script type="text/javascript" src="{{ asset('js/apps/users.js') }}"></script>
@endsection
