@section('pageData')
<div class="table-responsive no-border">
  <table class="table stripe m-b-none" data-ride="datatables" id="user-lists" data-url="{{ route('user.data') }}">
    <thead>
      <tr>
        <th style="width:20px;"></th>
        <th class="col-md-5">NAME</th>
        <th class="col-md-5">EMAIL</th>
        <th class="zonk"></th>
        <th class="zonk"></th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
@endsection
