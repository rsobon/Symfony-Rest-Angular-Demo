/**
 * The main Client app module
 *
 * assets_path variable is set inside index.html.twig globally
 *
 * @type {angular.Module}
 */

var ApiClient = angular.module('ApiClient', ['ngRoute', 'restangular', 'ui.bootstrap']);

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