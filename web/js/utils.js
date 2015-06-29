var getUnidimensionalIndex = function(row, col, page, pageSize){
	var offset = page * pageSize;
	return offset + row*col + col;
}

var range = function (a,b){
	var range = [];
	for(i=a;i<b;i++){
		range.push(i);
	}
	return range;
}