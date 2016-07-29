@section('pageTool')
<a href="{{ route('user.create') }}" class="btn btn-success" data-bjax><i class="icon-plus"></i> CREATE</a>
<a href="{{ route('user.destroy', [0]) }}" class="btn btn-danger" data-item="delete"><i class="icon-trash"></i></a>
<button class="btn btn-info" data-item="refresh"><i class="icon-refresh"></i></button>

{{--
<a href="{{ route('user.index') }}" class="btn btn-default" data-bjax><i class="icon icon-list"></i></a>
<a href="{{ route('user.thumb') }}" class="btn btn-default" data-bjax><i class="icon  icon-grid"></i></a>
--}}

<div class="pull-right-lg pull-in col-md-3">
	<input class="form-control" type="text" data-item="search" placeholder="search...">
</div>
@endsection
