'use strict';

admin.controller('adminModalSelect', function($scope, $http, $location, $uibModal, pathParser, $log) {

    $scope.animationsEnabled = true;
    pathParser.setPath($location.path());
    $scope.data = {
        tagParent: "Companies",
        titleTemplate: "Select Attached to(object name) - "
    };

    $scope.title = $scope.data.titleTemplate + $scope.data.tagParent;

    $scope.items = [];
    $scope.selected = {Companies: [], People: [], Vertical: [], Products: [], Events: []};
    $scope.init = function() {
        if (pathParser.isEditPage()) {
            $http.get('/' + pathParser.getBase().join('/') + '/' + pathParser.getItemId() + '/selectedOptions').
                success(function(data) {
                    angular.forEach(data, function(tag, index) {
                        $scope.selected[tag.target].push(tag);
                    });
                    //$scope.selected = data;
                    //$log.info($scope.selected);
                });
        }
    };

    $scope.init();

    $scope.open = function (size) {
        $http.get('/' + pathParser.getBase().join('/') + '/' + $scope.data.tagParent + '/options').
            success(function(data) {
                angular.forEach(data, function(item, index){
                    data[index].selected = false;
                });
                angular.forEach($scope.selected[$scope.data.tagParent],function(tag, index){
                    angular.forEach(data, function(item, index){
                        if (item.id == tag.id) {
                            data[index].selected = true;
                            return;
                        }
                    });
                });
                $scope.items = data;
                var modalInstance = $uibModal.open({
                    animation: true,
                    templateUrl: '/frontend/views/admin/selectCcheckBoxesContent.html',
                    controller: 'ModalInstanceCtrl',
                    size: size,
                    resolve: {
                        items: function() {return $scope.items;},
                        options: function () {
                            return {
                                title: $scope.data.titleTemplate + $scope.data.tagParent,
                                owner: $scope.data.tagParent
                            };
                        }
                    }
                });

                modalInstance.result.then(function (selectedItem) {
                    $log.info(selectedItem);
                    $scope.selected[$scope.data.tagParent] = [];
                    angular.forEach(selectedItem, function(selectedTag, item){
                        if (selectedTag.selected) {
                            $scope.selected[$scope.data.tagParent].push({id:selectedTag.id,
                                        description:selectedTag.description, target:$scope.data.tagParent})
                        }
                    });
                    $log.info($scope.selected);
                }, function () {
                    $log.info('Modal dismissed at: ' + new Date());
                });
            });

    };

    $scope.preparation = function() {
        $scope.title = $scope.data.titleTemplate + $scope.data.tagParent;
    }

    $scope.toggleAnimation = function () {
        $scope.animationsEnabled = !$scope.animationsEnabled;
    };

});

admin.filter('offset', function() {
    return function(input, start) {
        start = parseInt(start, 10);
        return input.slice(start);
    };
});

admin.directive('pluginUniform',function() {
    // Return the directive configuration object.
    return ({
        link: link,
        restrict: "A"
    });
    // I bind the JavaScript events to the view-model.
    function link(scope, element, attributes) {
        // Because we are deferring the application of the Uniform plugin,
        // this will help us keep track of whether or not the plugin has been
        // applied.
        var uniformedElement = null;
        // We don't want to link-up the Uniform plugin right away as it will
        // query the DOM (Document Object Model) layout which will cause the
        // browser to repaint which will, in turn, lead to unexpected and poor
        // behaviors like forcing a scroll of the page. Since we have to watch
        // for ngModel value changes anyway, we'll defer our Uniform plugin
        // instantiation until after the first $watch() has fired.
        scope.$watch(attributes.ngModel, handleModelChange);
        // When the scope is destroyed, we have to teardown our jQuery plugin
        // to in order to make sure that it releases memory.
        scope.$on("$destroy", handleDestroy);
        // ---
        // PRIVATE METHODS.
        // ---
        // I clean up the directive when the scope is destroyed.
        function handleDestroy() {
            // If the Uniform plugin has not yet been applied, there's nothing
            // that we have to explicitly teardown.
            if (!uniformedElement) {
                return;
            }
            uniformedElement.uniform.restore(uniformedElement);
        }

        // I handle changes in the ngModel value, translating it into an
        // update to the Uniform plugin.
        function handleModelChange(newValue, oldValue) {
            // If we try to call render right away, two things will go wrong:
            // first, we won't give the ngValue directive time to pipe the
            // correct value into ngModle; and second, it will force an
            // undesirable repaint of the browser. As such, we'll perform the
            // Uniform synchronization at a later point in the $digest.
            scope.$evalAsync(synchronizeUniform);
        }

        // I synchronize Uniform with the underlying form element.
        function synchronizeUniform() {
            // Since we are executing this at a later point in the $digest
            // life-cycle, we need to ensure that the scope hasn't been
            // destroyed in the interim period. While this is unlikely (if
            // not impossible - I haven't poured over the details of the $digest
            // in this context) it's still a good idea as it embraces the
            // nature of the asynchronous control flow.
            // --
            // NOTE: During the $destroy event, scope is detached from the
            // scope tree and the parent scope is nullified. This is why we
            // are checking for the absence of a parent scope to indicate
            // destruction of the directive.
            if (!scope.$parent) {
                return;
            }
            // If Uniform has not yet been integrated, apply it to the element.
            if (!uniformedElement) {
                return ( uniformedElement = element.uniform() );
            }
            // Otherwise, update the existing instance.
            uniformedElement.uniform.update(uniformedElement);
        }
    }
});
admin.filter('custom', function() {
    return function(input, search) {
        if (!input) return input;
        if (!search) return input;
        var expected = ('' + search).toLowerCase();
        var result = [];
        angular.forEach(input, function(value, key) {
            var actual = ('' + value.description).toLowerCase();
            if (actual.indexOf(expected) !== -1) {
                result.push({id:value.id, description:value.description});
            }
        });
        return result;
    };
});
