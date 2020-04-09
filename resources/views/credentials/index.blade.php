@extends('layout')

@section('content')

    <div class="row justify-content-center">
        <div class="col-8">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@lang('credentials.title')</h5>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">@lang('credentials.prefix')</label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" value="{{ $user['prefix'] }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">@lang('credentials.password')</label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" value="{{ $user['password'] }}">
                        </div>
                    </div>

                    <p>
                        @lang('credentials.config_label')
                        <textarea class="form-control">{!! json_encode($conf, JSON_UNESCAPED_SLASHES) !!}</textarea>
                    </p>

                    <form method="POST" action="/credentials">
                        @csrf
                        <button type="submit" class="btn btn-primary" href="/editor">@lang('credentials.submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection