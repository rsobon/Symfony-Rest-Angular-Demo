/**
 * Created by rafal on 05.10.15.
 */

/**
 * The main controller for the app. The controller:
 * - retrieves and persists the model via Restangular
 * - exposes the model to the template and provides event handlers
 *
 * @type {angular.Module}
 */


ConstructorClient
    .controller('PageController',  ['$scope', '$routeParams', '$filter', 'Restangular', '$q', function ($scope, $routeParams, $filter, Restangular, $q) {

        $scope.pages = [];
        Restangular.all('api/pages').getList().then(function (pages) {
            $scope.pages = pages;
        })
}]);