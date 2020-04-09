@extends('layout')

@section('content')

    <div class="row justify-content-center">
        <div class="col-8">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Successfully created</h5>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Prefix</label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" value="{{ $user['prefix'] }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" value="{{ $user['password'] }}">
                        </div>
                    </div>

                    <p>
                        JSON config for client
                        <textarea class="form-control">{!! json_encode($conf, JSON_UNESCAPED_SLASHES) !!}</textarea>
                    </p>

                    <a class="btn btn-primary" href="/editor">Continue</a>
                </div>
            </div>
        </div>
    </div>

@endsection