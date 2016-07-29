<section class="panel panel-default no-border no-box-shadow">
    <header class="panel-heading text-right bg-light">
        <ul class="nav nav-tabs pull-left">
            <li class="active">
                <a href="#quick" data-toggle="tab">QUICK EDIT</a>
            </li>
        </ul>
        <span class="hidden-sm">&nbsp;</span>
    </header>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade active in" id="quick">

    			{!! Form::open([
    				'route' => ['user.update', $row->id],
    				'class' => 'form-horizontal',
                    'id'=> 'post-quick-update'])
    			!!}

				{{ method_field('PUT') }}

				{!! Form::hidden('quick_edit', true) !!}

                <div class="form-group">
                  	<label class="col-lg-3 control-label">NAME</label>
                  	<div class="col-lg-9">
                  	{!! Form::text('name', $row->name, ['class' => 'form-control input-sm']) !!}
                  	</div>
                </div>
                <div class="form-group">
                  	<label class="col-lg-3 control-label">EMAIL</label>
                  	<div class="col-lg-9">
                  	{!! Form::text('email', $row->email, ['class' => 'form-control input-sm', 'readonly' => true]) !!}
                  	</div>
                </div>

                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-9">
                        <div class="checkbox i-checks">
                            <label>
                            {!! Form::checkbox('status', 1, ($row->status == 1)? true :false) !!}<i></i> Active this user
                            </label>
                        </div>
                    </div>
                </div>

                <div class="line line-dashed b-b line-lg pull-in"></div>

                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-9">
                        <button type="submit" class="btn btn-primary" data-action="update">UPDATE</button>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>

        </div>
    </div>
</section>
