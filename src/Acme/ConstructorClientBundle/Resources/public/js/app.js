/**
 * Created by rafal on 05.10.15.
 */

/**
 * The main Client app module
 *
 * @type {angular.Module}
 */

var ConstructorClient = angular.module('ConstructorClient', ['ngRoute', 'restangular']);

ConstructorClient
    .config(function ($routeProvider) {
        $routeProvider.
            when('/', {
                controller: 'PageController',
                templateUrl: '/bundles/acmeconstructorclient/partials/page/page-list.html'
            }).
            otherwise({
                redirectTo: '/'
            });
    })
;