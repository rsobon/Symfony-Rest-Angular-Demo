/**
 * Created by rafal on 05.10.15.
 */

/**
 * Services that persists and retrieves TODOs from the Symfony2 backend
 *
 * @type {angular.Module}
 */

ApiClient
    .service('PageRepository', ['Restangular', function (Restangular) {
        var PageRepository = function () {
            var resource = Restangular.allUrl('pages');
            this.fetchAll = function () {
                return resource.getList();
            };
            this.create = function (page) {
                return resource.post(page);
            };
            this.persist = function (page) {
                return resource.put(page);
            }
        };
        return new TodoRepository();
    }])
    .factory('PageFactory', ['Restangular', function (Restangular) {
        return Restangular.all('pages');
    }])
;