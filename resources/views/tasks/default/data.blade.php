@section('pageData')
<div class="table-responsive no-border">
  <table class="table stripe m-b-none" data-ride="datatables" id="task-lists" data-url="{{ route('tasks.data') }}">
    <thead>
      <tr>
        <th style="width:20px;"></th>
        <th class="col-md-6">TITLE</th>
        <th class="col-md-3">DATE</th>
        <th class="col-md-1">PRIORITY</th>
        <th class="zonk"></th>
        <th class="zonk"></th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
@endsection
