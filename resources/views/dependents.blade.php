@extends('layouts.app')
@section('content')

<?php $data = \App\Http\Controllers\DependentsController::getDependentsByID($id); //dd(($data)) ?><!---->
        <dependents-component :data="{{ json_encode($data) }}"></dependents-component>

@endsection
