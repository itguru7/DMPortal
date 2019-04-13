@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Portals</div>

            <div class="card-body">

                @include('shared.error')

                {!! Form::model($portal, ['route' => ['portals.update', $portal->id], 'method' => 'patch', 'class'=>'container-fluid']) !!}
                    @include('portals.fields')
                {!! Form::close() !!}

               </div>
           </div>
       </div>
   </div>
@endsection
