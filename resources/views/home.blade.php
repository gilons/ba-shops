@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" id="app">
                <div class="card-header">
                    {{ __('All Your Items') }}
                <button onclick="gotoAddItem()"  type="button" class="btn-success add-item-button" style="margin-left: 55%;">Add Item</button>
                </div>
                <div class="card-body">
                    <all-items></all-items>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
