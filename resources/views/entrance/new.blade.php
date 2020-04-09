<div class="card">
    <div class="card-body">
        <h5 class="card-title">New prefix</h5>
        <form method="POST" action="/new_prefix">
            @csrf
            <div>
                @captcha
            </div>
            <div class="form-group">
                <label>Code</label>
                <input type="text" class="form-control" name="captcha"/>
            </div>                        
            @if(Session::has('error_captcha'))
                <div class="alert alert-danger">
                    Invalid code
                </div>
            @endif                                                
            <button class="btn btn-primary" type="submit">Create</button>
        </form>
    </div>
</div>    