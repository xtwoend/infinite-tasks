@extends('layouts.app')

@section('content')

{!! Form::open([
    'url' => $form_url,
    'id'=> 'form-post'])
!!}

<div class="sub-nav row">
    <div class="col-md-6">
        @yield('formHeader')
    </div>
    <div class="pull-right padder">
        @yield('pageTool')
    </div>
</div>

<section class="hbox stretch">
    <aside class="bg-white b-r col-md-6 no-padder">
        <section class="vbox animated fadeInUp">
            <section class="scrollable w-f-xlg padder-v padder">
                @yield('formLeft')
            </section>
        </section>
    </aside>
    <aside class="bg-white col-md-6 no-padder" temp-part="property">
        <section class="vbox animated fadeInUp">
            <section class="scrollable w-f-xlg padder-v hover padder">
                @yield('formRight')
            </section>
        </section>
    </aside>
</section>

{!! Form::close() !!}

@endsection
