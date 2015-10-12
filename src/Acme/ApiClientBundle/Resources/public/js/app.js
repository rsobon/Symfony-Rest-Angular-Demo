/**
 * The main Client app module
 *
 * root_path & assets_path variables are set inside index.html.twig globally
 *
 * @type {angular.Module}
 */

var ApiClient = angular.module('ApiClient', ['ngRoute', 'restangular', 'ui.bootstrap']);

ApiClient
    .config(['$routeProvider', function ($routeProvider) {

        $routeProvider.
            when('/', {
                controller: 'PageController',
                templateUrl: assets_path + '/page/page-list.html'
            }).
            otherwise({
                redirectTo: '/'
            });
    }])
    .config(['RestangularProvider', function (RestangularProvider) {
        RestangularProvider.setBaseUrl(root_path + 'api');
        RestangularProvider.addRequestInterceptor(function (element, operation, what, url) {
            var newRequest = {};
            if (operation == 'post' || operation == 'put') {
                what = what.split('');
                what.pop();
                what = what.join('');
            }
            if (operation == 'put') {
                delete element._links;
            }
            newRequest[what] = element;
            return newRequest;
        });
        RestangularProvider.setRestangularFields({
            selfLink: '_links.self.href'
        });
    }]);