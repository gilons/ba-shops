@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card" id="app">
             <div class="card-body">
            <manage-products id="{!! $id !!}"></manage-products>
        </div>
        </div>
    </div>

</div>
</div>
@endsection