@extends('layout')

@section('content')
    <div class="row">
       
        <div class="col-md-6">
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
        </div>

        <div class="col-md-6">
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
        </div>

    </div>
@endsection