<div class="card">
    <div class="card-body">
        <h5 class="card-title">Existing prefix</h5>

        @if(Session::has('error_password'))
            <div class="alert alert-danger">
                Invalid credentials
            </div>
        @endif                        

        <form method="POST" action="/check_password">
            @csrf
            <div class="form-group">
                <label>Prefix</label>
                <input type="text" class="form-control" name="prefix" value="{{ $prefix }}"/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password"/>
            </div>                
            <button class="btn btn-primary" type="submit">Enter</button>
        </form>            
    </div>
</div>