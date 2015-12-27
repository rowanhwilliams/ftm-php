'use strict'

admin.controller('Dashboard', function($scope, $http, $log) {
    $scope.data = {
        statistic: {
            month:{},
            employee:{},
            headQuaters:{}
        },
        period: {
            month: new Date().getMonth() + 1,
            year: new Date().getFullYear()
        }
    };
    $scope.pchart = [];
    $scope.bchart = [];

    $scope.init = function(data) {
        $http.get('admin/dashboard/'+$scope.data.period.month+'/'+$scope.data.period.year+'/MonthStatistic').success(function(MonthStatistics) {
            data.statistic.month = MonthStatistics;
        });
        $http.get('admin/dashboard/EmployeeStatistic').success(function(EmployeeStatistics) {
            $scope.pchart = EmployeeStatistics;
        });
        $http.get('admin/dashboard/HQStatistic').success(function(hqStatistics) {
            console.log(hqStatistics);
            //$scope.bchart = [["London",2113],["New York",1673],["San Francisco",727],["Boston",477],["Chicago",265],["Paris",262],["Toronto ",223],["Mumbai",163],["Zurich",145],["Berlin",135],["Los Angeles",121]];
            $scope.bchart = hqStatistics;
        });
    }

    $scope.init($scope.data);

    $scope.labelFormatter =

    $log.error($scope.data);
    angular.element(document).ready(function () {
        $log.info(document);
        //document.getElementById('msg').innerHTML = 'Hello';
    });

});

admin.directive('piechart', function(){
    return{
        restrict: 'E',
        link: function(scope, elem, attrs){

            var chart = null,
                opts  = {
                    width:100,
                    height:100,
                            series: {
                                pie: {
                                    radius: 1,
                                    show: true,
                                    label: {
                                        show: true,
                                        radius: 2/3,
                                        //formatter: function(label, series) {
                                        //    //var percent= Math.round(series.percent);
                                        //    //var number= series.data[0][1]; //kinda weird, but this is what it takes
                                        //    //return('<b>'+label+'</b>: '+number+' ('+ percent + '%)');
                                        //    console.log(label);
                                        //    return('<b>'+label+'</b>');
                                        //},
                                        threshold: 0.1
                                    }
                                }
                            },
                            legend: {
                                show: true,
                                margin: [-250,0],
                                labelFormatter: function(label, series) {
                                    var percent= Math.round(series.percent);
                                    var number= series.data[0][1]; //kinda weird, but this is what it takes
                                    return('<b>'+label+'</b>: ('+ percent + '%)');
                                }
                            }
                        };


            var data = scope[attrs.ngModel];
            console.log(elem);
            scope.$watch('pchart', function(v){
                if(!chart){
                    chart = $.plot(elem, v , opts);

                    elem.show();
                }else{
                    chart.setData(v);
                    chart.setupGrid();
                    chart.draw();
                }
            });
        }
    };
});

admin.directive('barchart', function(){
    return{
        restrict: 'E',
        link: function(scope, elem, attrs){

            var chart = null,
                opts  = {
                    series: {
                        bars: {
                            show: true,
                            barWidth: 0.6,
                            align: "center"
                        }
                    },
                    xaxis: {
                        mode: "categories",
                        tickLength: 0,
                    }
                };


            var data = scope[attrs.ngModel];
            scope.$watch('bchart', function(v){

                if(!chart){
                    console.log(v);
                    chart = $.plot(elem, [v] , opts);
                    //  elem.show();
                }else{
                    chart.setData([v]);
                    chart.setupGrid();
                    chart.draw();
                }
            });
        }
    };
});