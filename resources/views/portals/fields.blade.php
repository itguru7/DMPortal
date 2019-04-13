<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('color', 'Color:') !!}
            {!! Form::text('color', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('logo_file', 'Logo:') !!}
            {!! Form::file('logo_file', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('background_file', 'Background:') !!}
            {!! Form::file('background_file', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('access', 'Access:') !!}
            {!! Form::checkbox('access', null, isset($portal) ? $portal->access : 0, ['data-toggle' => 'toggle', 'data-on' => 'Public', 'data-off' => 'Private']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::text('password', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {!! Form::submit('Save', ['class' => 'btn btn-lg btn-primary']) !!}
            <a href="{!! route('portals.index') !!}" class="btn btn-lg btn-default">Cancel</a>
        </div>
    </div>
</div>

@section('styles')
    <link href="{{ asset('backend/plugins/Color-Picker-Plugin-jQuery-MiniColors/jquery.minicolors.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('backend/plugins/Color-Picker-Plugin-jQuery-MiniColors/jquery.minicolors.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#color').minicolors({
                control: $(this).attr('data-control') || 'hue',
                defaultValue: $(this).attr('data-defaultValue') || '',
                format: $(this).attr('data-format') || 'hex',
                keywords: $(this).attr('data-keywords') || '',
                inline: $(this).attr('data-inline') === 'true',
                letterCase: $(this).attr('data-letterCase') || 'lowercase',
                opacity: $(this).attr('data-opacity'),
                position: $(this).attr('data-position') || 'bottom',
                swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
                change: function(value, opacity) {
                    if( !value ) return;
                    if( opacity ) value += ', ' + opacity;
                    if( typeof console === 'object' ) {
                    }
                },
                theme: 'bootstrap'
            });
        })
    </script>
@endsection
