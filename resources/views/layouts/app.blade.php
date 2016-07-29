@extends('layouts.base')

@section('mainContent')
<section class="vbox">
    @include('layouts.partials.header')
    <section>
        <section class="hbox stretch">
            @include('layouts.partials.menu')
            <section id="content">
    		    <header class="header bg-light dk">
          		    @yield('headerContent')
                </header>
                @yield('content')
            </section>
        </section>
    </section>
</section>
@endsection
