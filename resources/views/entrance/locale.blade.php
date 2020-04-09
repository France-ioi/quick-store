<form method="POST" action="/locale" id="form-locale">
    @csrf
    <div class="form-group">
        <select name="locale" class="form-control">
            @foreach($locales as $k => $v)
                <option value="{{ $k }}" @if($k == $locale) selected="selected" @endif>{{ $v }}</option>
            @endforeach
        </select>
    </div>
</form>


<script>
    $(document).ready(function() {
        $('#form-locale').find('[name=locale]').change(function() {
            $('#form-locale').submit();
        });
    })
</script>