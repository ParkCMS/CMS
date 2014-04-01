parkAdmin.directive("highlightActive", ['$location', function($location) {
	return {
		restrict: "A",
		link: function(scope, element, attrs) {
			var pattern = attrs.highlightActive;
			if ((new RegExp(pattern)).test($location.path())) {
				element.addClass('active');
			}

			scope.$on('$routeChangeSuccess', function(e, current, prev) {
				element.removeClass('active');
				var pattern = attrs.highlightActive;
				if ((new RegExp(pattern)).test($location.path())) {
					element.addClass('active');
				}
			});
		}
	};
}]);