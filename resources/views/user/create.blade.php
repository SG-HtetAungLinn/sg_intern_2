@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('user.store') }}">
                @csrf
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" name="first_name" id="first_name" class="form-control mb-3" ng-model="firstName" />
                    <label for="first_name" class="form-label">First Name</label>
                </div>
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="last_name" class="form-control" name="last_name" />
                    <label class="form-label" for="last_name">Last Name</label>
                </div>
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="email" class="form-control" name="email" autocomplete="off" />
                    <label class="form-label" for="email">Email</label>
                </div>
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="password" class="form-control" name="password"
                        autocomplete="new-password" />
                    <label class="form-label" for="password">Password</label>
                </div>
                <input type="submit" class="btn btn-info w-100">
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\UserCreateRequest') !!}
    <script>
        var app = angular.module('app', []);
        app.controller('myCtrl', function($scope) {
            $('#first_name').on('input', function() {
                console.log($scope.firstName);
            })
        });
    </script>
@endsection
