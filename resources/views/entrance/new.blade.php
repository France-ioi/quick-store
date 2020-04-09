<div class="card">
    <div class="card-body">
        <h5 class="card-title">@lang('entrance.new.title')</h5>
        <form method="POST" action="/new_prefix">
            @csrf
            <div>
                @captcha
            </div>
            <div class="form-group">
                <label>@lang('entrance.new.code')</label>
                <input type="text" class="form-control" name="captcha"/>
            </div>                        
            @if(Session::has('error_captcha'))
                <div class="alert alert-danger">
                    @lang('entrance.new.error')
                </div>
            @endif                                                
            <button class="btn btn-primary" type="submit">@lang('entrance.new.submit')</button>
        </form>
    </div>
</div>    