@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Portals</div>

            <div class="card-body">

                @include('shared.error')

                {!! Form::open(['route' => 'portals.store', 'class'=>'container-fluid', 'files' => true]) !!}
                    @include('portals.fields')
                {!! Form::close() !!}

               </div>
           </div>
       </div>
   </div>
@endsection
