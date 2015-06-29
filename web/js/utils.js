var getUnidimensionalIndex = function(row, col, nCols, page, pageSize){
	//console.log("entro: ", page);
	var offset = page * pageSize;
	return offset + row*nCols + col;
}

var range = function (a,b){
	var range = [];
	for(i=a;i<b;i++){
		range.push(i);
	}
	return range;
}