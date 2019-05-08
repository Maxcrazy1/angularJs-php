var myApp = angular.module("myApp", []);
myApp.controller("myController", function($scope,$http){
	$scope.info = "";
	$scope.datos= {};
	$scope.newPro= {};
	// función principal que carga la lista
	$http.get("controlador/dirigidor.php?getProductos")
	.then(function (response) {$scope.names = response.data.records;});

	// función que permite mostrar los datos de l usuario clickado
	$scope.selectPro = function(names){
		$scope.newPro = names;
	};
	// borrador de mensaje de alerta
	$scope.clearInfo = function(){
		$scope.info = "";
	};
	
	
	// método para guardar datos
	$scope.enviar = function(){
		$http.post("controlador/manejador.php",{nombre:$scope.datos.Nombre,
			precio:$scope.datos.Precio, pais:$scope.datos.pais, accion:'guardar'} )
			.then(function (response) {
				$scope.names.push($scope.datos);
				$scope.info = "¡Producto Agregado en el inventario!";
				$scope.nombre = '';
				$scope.precio = '';
				$scope.pais = '';
				console.log(response); 
				
				
			});
		}    
		
		$scope.modificar = function(){
			console.log($scope.newPro);
			
			$http.post("controlador/manejador.php",{pais:$scope.newPro.pais,nombre:$scope.newPro.Nombre,
				precio:$scope.newPro.Precio, accion:'modificar'} )
				.then(function (response) {
					$scope.info = "¡Producto modificado en el inventario!";
					$scope.nombre = '';
					$scope.precio = '';
					$scope.pais = '';
					console.log(response); 
				});
			}   
			
			$scope.eliminar = function(){
				$scope.names.splice( $scope.names.indexOf($scope.datos), 1 );
				$scope.info = "¡Producto eliminado del inventario!";
				$http.post("controlador/manejador.php",{nombre:$scope.datos.Nombre,
					pais:$scope.datos.pais,
					accion:'eliminar'})
					.then(function () {
						
					});
				}   
				
			});