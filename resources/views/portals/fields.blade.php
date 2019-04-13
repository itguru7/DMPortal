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
            {!! Form::label('background', 'Background:') !!}
            {!! Form::file('background', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('access', 'Access:') !!}
            {!! Form::checkbox('access', null, ['class' => 'form-control']) !!}
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

@section('script')
    <script>
        $(document).ready(function() {
            console.log(123);
            $('input:checkbox').bootstrapToggle();
        })
    </script>
@endsection
