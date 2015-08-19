var getUnidimensionalIndex = function(row, col, nCols, page, pageSize){
	//console.log(row, col, nCols, page, pageSize);
	var offset = page * pageSize;
	//console.log(offset + row*nCols + col)
	return offset + row*nCols + col;
}

var range = function (a,b){
	var range = [];
	for(i=a;i<b;i++){
		range.push(i);
	}
	return range;
}

var randi = function randomIntFromInterval(min, max){
    return Math.floor(Math.random()*(max-min+1)+min);
}

var watheverValue = function(value, arrValues){
	for(i in arrValues){
		if(arrValues[i] == value){
			return true;
		}
	}
	return false;
}

var spliceAndPos = function(min, max, splice, nSplices){
	min = parseInt(min);
	max = parseInt(max);
	splice = parseInt(splice);
	nSplices = parseInt(nSplices);
	//console.log(min, max, splice, nSplices);
	//console.log(Math.floor(min+(splice*((max-min)/nSplices))));
	return Math.floor(min+(splice*((max-min)/nSplices)));
}

var getSplicePosition = function(min, max, n, nSplices){
	min = parseInt(min);
	max = parseInt(max);
	return Math.floor((n-min)/((max-min)/nSplices));
}
