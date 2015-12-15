var Terrain = function(coords){
	this.coords = coords;
	var self 	= this;

	return {
		getCoords: function(){
			return self.coords;
		}
	};
};