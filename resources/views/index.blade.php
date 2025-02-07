@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div ng-repeat=" user in userData">
                <h1>@{{ user.id }}</h1>
                <h2>@{{ user.name }}</h2>
                <h3>@{{ user.email }}</h3>
                <hr>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var app = angular.module('app', []);
        app.controller('myCtrl', function($scope, $http) {
            $scope.userData = [];
            $http({
                url: 'users/data',
                method: 'GET',
            }).then(function(response) {
                $scope.userData = response.data
            })
        })
    </script>
@endsection
