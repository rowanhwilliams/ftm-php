'use strict';

admin.controller('ModalInstanceCtrl', function ($scope, $http, $uibModalInstance, items, options, pathParser, $log) {

    $scope.data = items;
    $scope.title = options.title;
    $scope.owner = options.owner;

    //$scope.selected = {
    //    //item: $scope.data[0]
    //};

    // Pagination
    $scope.totalItems = $scope.data.length;
    $scope.currentPage = 1;

    $scope.setPage = function (pageNo) {
        $scope.currentPage = pageNo;
    };

    $scope.pageChanged = function() {
        $log.log('Page changed to: ' + $scope.currentPage);
    };

    $scope.maxSize = 5;
    $scope.itemsPerPage = 10;

    //$scope.setItemsPerPage = function(num) {
    //    $scope.itemsPerPage = num;
    //    $scope.currentPage = 1; //reset to first paghe
    //}



    $scope.select = function () {
        $uibModalInstance.close($scope.data);
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
});