'use strict'
var admin = angular.module('admin', ['ui.bootstrap'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

admin.config(['$locationProvider', function($locationProvider) {
    $locationProvider.html5Mode(true);
}]);

admin.service("pathParser", function () {
    this.pathPart = [];
    this.setPath = function(path) {
        this.pathPart = path.split('/');
    }
    this.isEditPage = function () {
        return this.pathPart[this.pathPart.length - 1].toLowerCase() === 'edit';
    }
    this.getBase = function() {
        return [this.pathPart[1], this.pathPart[2]];
    }
    this.getItemId = function () {
        return this.isEditPage() ? this.pathPart[this.pathPart.length - 2] : 0;
    }
});
