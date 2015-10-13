/**
 * The main Client app module
 *
 * root_path & assets_path variables are set inside index.html.twig globally
 *
 * @type {angular.Module}
 */

angular.module('ApiClient', ['ngRoute', 'restangular', 'ui.bootstrap', 'ApiClient.controllers', 'ApiClient.services'])
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider
            .when('/pages', {
                controller: 'PageController',
                templateUrl: assets_path + '/page/page-list.html'
            })
            .when('/login', {
                controller: 'Login',
                templateUrl: assets_path + '/login.html'
            })
            .otherwise({
                redirectTo: '/login'
            });
    }])
    .config(['RestangularProvider', '$injector', 'TokenHandlerProvider', 'AuthHandlerProvider', function (RestangularProvider, $injector, TokenHandlerProvider, AuthHandlerProvider) {

        var TokenHandler = $injector.instantiate(TokenHandlerProvider.$get);
        var AuthHandler = $injector.instantiate(AuthHandlerProvider.$get);

        RestangularProvider
            .setBaseUrl(root_path + 'api')
            .addRequestInterceptor(function (element, operation, what, url) {
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
            })
            .setRestangularFields({
                selfLink: '_links.self.href'
            })
            .addFullRequestInterceptor(function (element, operation, route, url, headers, params, httpConfig) {

                headers['X-WSSE'] =
                    TokenHandler.getCredentials(
                        AuthHandler.username(),
                        AuthHandler.secret()
                    );

                return {
                    element: element,
                    headers: headers,
                    params: params,
                    httpConfig: httpConfig
                };
            });
    }]);
