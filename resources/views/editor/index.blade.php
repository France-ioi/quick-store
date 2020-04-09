@extends('layout')

@section('content')
    <h1>{{ $prefix }}</h1>

    @if(Session::has('success'))
        <div class="alert alert-success">
            @lang('editor.message_updated')
        </div>
    @endif    

    <form method="POST" action="/editor">
        @csrf
        <table class="table" id="table">
            <thead class="thead-dark">
                <tr>
                    <th class="col-md-4">@lang('editor.key')</th>
                    <th class="col-md-6">@lang('editor.value')</th>
                    <th class="col-md-2">@lang('editor.action')</th>
                </tr>
            </thead>

            @foreach($rows as $rec)
                <tr>
                    <td>{{ $rec->key }}</td>
                    <td><textarea class="form-control" name="values[{{$rec->id}}]">{{ $rec->value }}</textarea></td>
                    <td><button class="btn btn-danger btn-detele">@lang('editor.delete')</button></td>
                </tr>
            @endforeach
        </table>

        <div class="row justify-content-between">
            <div class="col-4">
                <button id="btn-add" class="btn btn-success">@lang('editor.add_record')</button>
                <button id="btn-submit" type="submit" class="btn btn-primary pull-right">@lang('editor.save_changes')</button>
            </div>
            <div class="col-4 text-right">
                <a class="btn btn-danger" href="/">@lang('editor.exit')</a>
            </div>
        </div>        

    </form>


    <table class="d-none">
        <tr id="new-record-template" class="table-success">
            <td><input type="text" name="new_keys[]" class="form-control"/></td>
            <td><textarea class="form-control" name="new_values[]"></textarea></td>
            <td><button class="btn btn-danger btn-detele">@lang('editor.delete')</button></td>
        </tr>
    </table>

    <div id="validation-error-message" class="d-none">
        @lang('editor.validation_error', config('data_record'))
    </div>
    <div id="delete-confirmation-message" class="d-none">
        @lang('editor.delete_confirmation')
    </div>    


    <script>
        $(document).ready(function() {
            // config
            var cfg = {!! json_encode(config('data_record')) !!};

            // interface
            var changed = false;
            function refreshInterface() {
                var table_empty = $('#table').find('tr').length < 2;
                $('#btn-submit').toggle(!table_empty || changed);
                $('#table').toggle(!table_empty);
            }
            refreshInterface();

            // delete records
            function initDeleteHandler(el) {
                el.click(function(e) {
                    e.preventDefault();
                    if(confirm($('#delete-confirmation-message').text())) {
                        el.closest('tr').remove();
                        changed = true;
                        refreshInterface();
                    }
                })
            }
            $('#table').find('.btn-detele').each(function() {
                initDeleteHandler($(this));
            });

            // add records
            $('#btn-add').click(function(e) {
                e.preventDefault();
                var tr = $('#new-record-template').clone();
                tr.find('input,textarea').val('');
                initDeleteHandler(tr.find('.btn-detele'));
                $('#table').append(tr);
                refreshInterface();
            });

            // validation
            $('#btn-submit').click(function(e) {
                var all_valid = true;
                $('#table').find('input[type="text"],textarea').each(function() {
                    var el = $(this);
                    var el_valid = el.val().trim() != '';
                    var value_length = el.val().length;
                    if(this.tagName == 'INPUT' && value_length > cfg.key_max_length) {
                        el_valid = false;
                    }
                    if(this.tagName == 'TEXTAREA' && value_length > cfg.value_max_length) {
                        el_valid = false;
                    }                    
                    el.toggleClass('is-invalid', !el_valid);
                    all_valid = all_valid && el_valid;                    
                });
                if(!all_valid) {
                    alert($('#validation-error-message').text());
                    e.preventDefault();
                }
                
            })
        });
    </script>
@endsection