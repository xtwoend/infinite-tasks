@extends('layouts.app')

@section('content')

<div class="sub-nav">
    @yield('pageTool')
</div>
<section class="vbox">
    <section class="hbox stretch">
        <aside class="bg-white b-r">
        	<section class="vbox animated fadeInUp">
            	<section class="scrollable">
            		@yield('pageData')
            	</section>
            </section>
        </aside>
        <aside class="aside-xl bg-white" temp-part="property" id="property">
			@yield('pageProp')
        </aside>
    </section>
</section>

@endsection
