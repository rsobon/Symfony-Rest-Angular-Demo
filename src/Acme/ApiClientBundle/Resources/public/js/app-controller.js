/**
 * The main controller for the app. The controller:
 * - retrieves and persists the model via Restangular
 * - exposes the model to the template and provides event handlers
 *
 * root_path & assets_path variables are set inside index.html.twig globally
 *
 * @type {angular.Module}
 */


ApiClient
    .controller('PageController', ['$scope', 'Restangular', '$modal', function ($scope, Restangular, $modal) {

        $scope.pages = [];
        Restangular
            .allUrl('api/pages', root_path + 'api/pages').getList()
            .then(function (pages) {
                $scope.pages = pages;
            });

        $scope.showPage = function (page) {
            $modal.open({
                animation: true,
                templateUrl: assets_path + '/page/page-show.html',
                controller: 'ModalInstanceCtrl',
                resolve: {
                    page: page
                }
            });
        };

        $scope.editPage = function (page) {
            $modal.open({
                animation: true,
                templateUrl: assets_path + '/page/page-edit.html',
                controller: 'ModalInstanceCtrl',
                resolve: {
                    page: page
                }
            });
        };

        $scope.doneEditing = function (page) {
            page.title = page.title.trim();
            page.put();
        };
    }]);

ApiClient
    .controller('ModalInstanceCtrl', ['$scope', '$modalInstance', 'page', function ($scope, $modalInstance, page) {

        $scope.page = page;

        $scope.ok = function () {
            $modalInstance.close();
        };

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };

    }]);