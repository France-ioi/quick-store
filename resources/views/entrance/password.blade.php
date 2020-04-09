<div class="card">
    <div class="card-body">
        <h5 class="card-title">@lang('entrance.password.title')</h5>
        <form method="POST" action="/check_password">
            @csrf
            <div class="form-group">
                <label>@lang('entrance.password.prefix')</label>
                <input type="text" class="form-control" name="prefix" value="{{ $prefix }}"/>
            </div>
            <div class="form-group">
                <label>@lang('entrance.password.password')</label>
                <input type="password" class="form-control" name="password"/>
            </div>                
            @if(Session::has('error_password'))
                <div class="alert alert-danger">
                    @lang('entrance.password.error')
                </div>
            @endif                
            <button class="btn btn-primary" type="submit">@lang('entrance.password.submit')</button>
        </form>            
    </div>
</div>