<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('subdomain_id', 'Vendor:') !!}
            <select class="form-control" id="subdomain_id" name="subdomain_id">
                <option value="">choose</option>
                @foreach($subdomains as $subdomain)
                    <option value="{{ $subdomain['SubdomainID'] }}" @if(isset($portal->subdomain_id))
                        @if ($portal->subdomain_id == old('subdomain_id', $portal->subdomain_id))
                            selected="selected"
                        @endif
                    @endif
                    >{{ $subdomain['Vendor'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('contact', 'Contact Info:') !!}
            {!! Form::text('contact', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('color', 'Color:') !!}
            {!! Form::text('color', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('logo', 'Logo:') !!}
            <div class="row">
                <div class="col-12">
                    <img id="logo_img" src="{{ isset($portal) ? $portal->logo_url : '' }}" width=100/>
                    <button id="upload_logo" class="btn btn-primary">Upload</button>
                    <button id="remove_logo" class="btn btn-danger">Remove</button>
                </div>
            </div>
            {!! Form::hidden('logo', null) !!}
            {!! Form::file('logo_file', ['class' => 'd-none']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('background', 'Background:') !!}
            <div class="row">
                <div class="col-12">
                    <img id="background_img" src="{{ isset($portal) ? $portal->background_url : '' }}" width=100/>
                    <button id="upload_background" class="btn btn-primary">Upload</button>
                    <button id="remove_background" class="btn btn-danger">Remove</button>
                </div>
            </div>
            {!! Form::hidden('background', null) !!}
            {!! Form::file('background_file', ['class' => 'd-none']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('access', 'Access:') !!}
            {!! Form::checkbox('access', null, isset($portal) ? $portal->access : 0, ['data-toggle' => 'toggle', 'data-on' => 'Public', 'data-off' => 'Private']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::text('password', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Save', ['class' => 'btn btn-lg btn-primary']) !!}
        <a href="{!! route('portals.index') !!}" class="btn btn-lg btn-default">Cancel</a>
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

            function logoAttr() {
                if ($('#logo_img').attr('src').length > 0) {
                    $('#logo_img').removeClass('d-none');
                    $('#upload_logo').addClass('d-none');
                    $('#remove_logo').removeClass('d-none');
                } else {
                    $('#logo_img').addClass('d-none');
                    $('#upload_logo').removeClass('d-none');
                    $('#remove_logo').addClass('d-none');
                }
            }
            logoAttr();
            var frLogo = new FileReader();
            frLogo.onload = function(e) {
                $('#logo_img').attr('src', this.result);
                logoAttr();
            }
            $('#upload_logo').click(function (e) {
                e.preventDefault();
                $('input[name=logo_file]').click();
            })
            $('#remove_logo').click(function (e) {
                e.preventDefault();
                $('#logo').val('');
                $('#logo_img').attr('src', '');
                $('input[name=logo_file]').val('');
                logoAttr();
            })
            $('input[name=logo_file]').change(function (e) {
                $('#logo').val(e.target.files[0].name);
                frLogo.readAsDataURL(e.target.files[0]);
            })

            function backgroundAttr() {
                if ($('#background_img').attr('src').length > 0) {
                    $('#background_img').removeClass('d-none');
                    $('#upload_background').addClass('d-none');
                    $('#remove_background').removeClass('d-none');
                } else {
                    $('#background_img').addClass('d-none');
                    $('#upload_background').removeClass('d-none');
                    $('#remove_background').addClass('d-none');
                }
            }
            backgroundAttr();
            var frBackground = new FileReader();
            frBackground.onload = function(e) {
                $('#background_img').attr('src', this.result);
                backgroundAttr();
            }
            $('#upload_background').click(function (e) {
                e.preventDefault();
                $('input[name=background_file]').click();
            })
            $('#remove_background').click(function (e) {
                e.preventDefault();
                $('#background').val('');
                $('#background_img').attr('src', '');
                $('input[name=background_file]').val('');
                backgroundAttr();
            })
            $('input[name=background_file]').change(function (e) {
                $('#background').val(e.target.files[0].name);
                frBackground.readAsDataURL(e.target.files[0]);
            })
        })
    </script>
@endsection
