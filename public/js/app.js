var app = angular.module('assignProjectApp', []);

app.controller('assignProjectController', function($scope, $http) {

	$scope.assign = function (person_id, project_id) {
		$scope.person_id = person_id;
		$scope.project_id = project_id;

		var data = serializeData({
            'person_id': person_id,
            'project_id': project_id
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }

        $http.post('/projects/assign', data, config)
        .success(function (data, status, headers, config) {
        	//alert(data);
            $scope.ServerResponse = data;
        })
        .error(function (data, status, header, config) {
            $scope.ServerResponse = "Data: " + data +
                "<hr />status: " + status +
                "<hr />headers: " + header +
                "<hr />config: " + config;
        });
	};

/////////////////////////////////////////////////////////////////////////////////////////////////


	$scope.remove = function (person_id, project_id) {
		$scope.person_id = person_id;
		$scope.project_id = project_id;

		var data = serializeData({
            'person_id': person_id,
            'project_id': project_id
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }

        $http.post('/projects/assign/remove', data, config)
        .success(function (data, status, headers, config) {
        	//alert(data);
            $scope.ServerResponse = data;
        })
        .error(function (data, status, header, config) {
            $scope.ServerResponse = "Data: " + data +
                "<hr />status: " + status +
                "<hr />headers: " + header +
                "<hr />config: " + config;
        });
	};

/////////////////////////////////////////////////////////////////////////////////////////////////

	function serializeData( data ) { 
	    // If this is not an object, defer to native stringification.
	    if ( ! angular.isObject( data ) ) { 
	        return( ( data == null ) ? "" : data.toString() ); 
	    }
	    var buffer = [];
	    // Serialize each key in the object.
	    for ( var name in data ) { 
	        if ( ! data.hasOwnProperty( name ) ) { 
	            continue; 
	        }
	        var value = data[ name ];
	        buffer.push(
	            encodeURIComponent( name ) + "=" + encodeURIComponent( ( value == null ) ? "" : value )
	        ); 
	    }
	    // Serialize the buffer and clean it up for transportation.
	    var source = buffer.join( "&" ).replace( /%20/g, "+" ); 
	    return( source ); 
	}

});