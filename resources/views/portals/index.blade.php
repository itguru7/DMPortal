@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Portals
                <a class="btn btn-success float-right" href="{!! route('portals.create') !!}"><i class="fa fa-plus"> Add</i></a>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped table-vcenter text-center">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Subdomain</th>
                        <th>Name</th>
                        <th>Color</th>
                        <th></th>
                        <th>Logo</th>
                        <th>Background</th>
                        <th>Access</th>
                        <th>Password</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($portals as $index => $portal)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td><a href="{{ $portal->link }}" target="_blank">{{ $portal->vendor }}</a></td>
                            <td>{{ $portal->name }}</td>
                            <td>{{ $portal->color }}</td>
                            <td style="background-color:{{ $portal->color }}"> </td>
                            <td><img width="100" src="{{ $portal->logo_url }}"/></td>
                            <td><img width="100" src="{{ $portal->background_url }}"/></td>
                            <td>{{ $portal->access ? 'Public' : 'Private' }}</td>
                            <td>{{ $portal->password }}</td>
                            <td>
                                <a href="{{ route('portals.edit', $portal->id ) }}" class="btn btn-sm btn-info" title="Edit Portal Information"><i class="fa fa-edit"> Edit</i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection