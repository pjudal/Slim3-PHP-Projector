var app = angular.module('assignProjectApp', []);

app.controller('assignProjectController', function($scope, $http) {

	$scope.assign = function (person_id, project_id) {
		alert(person_id);

		var data = { 'person_id': person_id, 'project_id': project_id }
		/*
		var data = $.param({
                'person_id': person_id,
                'project_id': project_id
		});
		*/

		var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }

		$http.post('/projects/assign', data, config)
		.success(function (data, status, headers, config) {
			alert(data);
			$scope.PostDataResponse = data;
		})
		.error(function (data, status, header, config) {
			$scope.ResponseDetails = "Data: " + data +
			"<hr />status: " + status +
			"<hr />headers: " + header +
			"<hr />config: " + config;
		})

	};

});