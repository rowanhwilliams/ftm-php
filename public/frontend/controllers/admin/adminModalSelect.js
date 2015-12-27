'use strict';

admin.controller('adminModalSelect', function($scope, $http, $uibModal, $log) {
    $scope.animationsEnabled = true;

    $scope.data = {
        tagParent: "Companies",
        titleTemplate: "Select Attached to(object name) - "
    };

    $scope.items = ['item1', 'item2', 'item3'];
    $scope.title = "P1" + $scope.data.titleTemplate + $scope.data.tagParent;


    $scope.open = function (size) {
        $log.info(size);

        var modalInstance = $uibModal.open({
            animation: true,
            templateUrl: '/frontend/views/admin/selectCcheckBoxesContent.html',
            controller: 'ModalInstanceCtrl',
            size: size,
            resolve: {
                items: function () {
                    return $scope.items;
                }
            }
        });

        modalInstance.result.then(function (selectedItem) {
            $log.info(selectedItem);
            $scope.selected = selectedItem;
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });
    };

    $scope.preparation = function(self, $event) {
        $scope.title = "P1" + $scope.data.titleTemplate + $scope.data.tagParent;
        $log.info($event);
    }

    $scope.toggleAnimation = function () {
        $scope.animationsEnabled = !$scope.animationsEnabled;
    };

});


