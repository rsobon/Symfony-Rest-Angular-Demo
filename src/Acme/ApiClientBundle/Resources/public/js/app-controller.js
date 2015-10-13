/**
 * The main controller for the app. The controller:
 * - retrieves and persists the model via Restangular
 * - exposes the model to the template and provides event handlers
 *
 * root_path & assets_path variables are set inside index.html.twig globally
 *
 * @type {angular.Module}
 */


angular.module('ApiClient.controllers', ['ngCookies'])
    .controller('Login', ['AuthHandler', '$scope', '$window', '$cookies', 'Restangular', 'Digest', function (AuthHandler, $scope, $window, $cookies, Restangular, Digest) {
        // On Submit function
        $scope.getSalt = function () {
            var username = $scope.username;
            var password = $scope.password;
            // Get Salt
            Restangular
                .oneUrl('salts', root_path + 'public/salts/' + username).get()
                .then(function(response) {
                    var salt = response.salt;
                    // Encrypt password accordingly to generate secret
                    Digest.cipher(password, salt).then(function (secret) {
                        // Display salt and secret for this example
                        $scope.salt = salt;
                        $scope.secret = secret;
                        // Store auth informations in cookies for page refresh
                        $cookies.put('username', $scope.username);
                        $cookies.put('secret', secret);

                        $window.location = '#/pages';
                    }, function (err) {
                        console.log(err);
                    });
                });
        };
    }])
    .controller('PageController', ['$scope', '$window', 'Restangular', '$modal', function ($scope, $window, Restangular, $modal) {

        $scope.pages = [];
        Restangular
            .all('pages').getList()
            .then(function (response) {
                $scope.pages = response;
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

    }])
    .controller('ModalInstanceCtrl', ['$scope', '$modalInstance', 'page', function ($scope, $modalInstance, page) {

        $scope.page = page;

        $scope.ok = function () {
            $modalInstance.close();
        };

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };

        $scope.doneEditing = function (page) {
            page.title = page.title.trim();
            page.put();
            $modalInstance.close();
        };

    }]);