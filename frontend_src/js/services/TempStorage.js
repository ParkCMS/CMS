parkAdmin.service("TempStorage", [function() {
	var storage = {};

	this.set = function(key, value) {
		storage[key] = value;
	};

	this.setIfNotSet = function(key, value) {
		if (this.isset(key)) {
			storage[key] = value;
		}
	};

	this.get = function(key) {
		return storage[key];
	};

	this.getAndDelete = function(key) {
		if (this.isset(key)) {
			var tmp = this.get(key);
			delete storage[key];

			return tmp;
		}
		return undefined;
	};

	this.isset = function(key) {
		return !(typeof storage[key] === "undefined");
	}
}]);