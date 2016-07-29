<h4 class="font-thin m-b">New users register</h4>
<div class="portlet-item">
    <ul class="list-group alt">
        @foreach(\App\Entities\User::latest()->limit(6)->get() as $user)
        <li class="list-group-item">
            <div class="media">
                <span class="pull-left thumb-sm"><img src="/images/a1.png" alt="..." class="img-circle"></span>
                <div class="media-body">
                    <div><a href="#">{{ $user->name }}</a></div>
                        <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                    </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>
