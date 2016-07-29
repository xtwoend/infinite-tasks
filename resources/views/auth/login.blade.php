@extends('layouts.base')

@section('mainContent')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<section id="content" class="m-t-lg wrapper-md animated fadeInUp">
    <div class="container aside-xl">
        <a class="navbar-brand block"><span class="h1 font-bold">{{ config('site.name') }}</span></a>
        <section class="m-b-lg">
            <header class="wrapper text-center">
              <strong>Sign in to get in touch</strong>
            </header>
            <form method="POST" action="/login">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input name="email" type="text" placeholder="Email" class="form-control rounded input-lg text-center no-border" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <input name="password" type="password" placeholder="Password" class="form-control rounded input-lg text-center no-border">
                </div>
                <button type="submit" class="btn btn-lg btn-warning lt b-white b-2x btn-block btn-rounded"><i class="icon-arrow-right pull-right"></i><span class="m-r-n-lg">Sign in</span></button>
                <div class="text-center m-t m-b"><a href="#"><small>Forgot password?</small></a></div>
                <div class="line line-dashed"></div>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
            </form>
        </section>
    </div>
</section>
@endsection
