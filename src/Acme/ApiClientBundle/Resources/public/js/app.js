/**
 * The main Client app module
 *
 * @type {angular.Module}
 */

var ApiClient = angular.module('ApiClient', ['ngRoute', 'restangular']);

ApiClient
    .config(function ($routeProvider) {

        $routeProvider.
            when('/', {
                controller: 'PageController',
                templateUrl: assets_path + '/page/page-list.html'
            }).
            otherwise({
                redirectTo: '/'
            });
    })
;