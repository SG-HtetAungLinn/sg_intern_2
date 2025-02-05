@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="col-md-4">

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('user.store') }}">
                    @csrf
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" name="first_name" id="first_name" class="form-control mb-3"
                            ng-model="firstName" />
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
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in users">
                            <td>
                                @{{ item.id }}
                            </td>
                            <td>
                                @{{ item.name }}
                            </td>
                            <td>
                                @{{ item.email }}
                            </td>
                            <td>
                                <a class="btn btn-danger btn-sm" ng-click="deleteUser(item.id)">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\UserCreateRequest') !!}
    <script>
        var app = angular.module('app', []);
        app.controller('myCtrl', function($scope, $http) {
            $scope.users = []
            getData()
            $scope.deleteUser = function(id) {
                let conAlert = confirm('Are you sure you want to delete')
                if (conAlert) {
                    $http({
                            method: 'POST',
                            url: '/users/delete',
                            data: {
                                id
                            }
                        })
                        .then(
                            function(response) {
                                alert(messages.deleteSuccess[0])
                                getData()
                            })
                }
            }

            function getData() {
                $http.get('/users/data')
                    .then(
                        function(response) {
                            if (response.status === 200) {
                                $scope.users = response.data;
                            } else {
                                alert('Error fetching data');
                            }
                        })
            }
        });
    </script>
@endsection
