/*
	@author : Borja Molina Zea
	@date : 4/17/2015
	@contact : borja.mz8@gmail.com
*/

/*
This file is part of be-utils.

be-utils is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

be-utils is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with be-utils.  If not, see <http://www.gnu.org/licenses/>.
*/

var be_indexer = function(arr, indexerAttr) {
	var indexedArr = {};
	for(i in arr){
		var item = arr[i];
		var index = item[indexerAttr];
		indexedArr[index] = item;
	}
	return indexedArr;
}

var be_getAttrVals = function(arr,attr){
	var vals = [];
	for(i in arr){
		vals.push(arr[i][attr]);
	}
	return vals;
}

var be_addAttr = function (arr,attrName,attrVal){
	for(i in arr) {
		arr[i][attrName] = attrVal;
	}
	return arr;
}

var be_range = function (a,b){
	var range = [];
	for(i=a;i<b;i++){
		range.push(i);
	}
	return range;
}

var be_random_int = function(min, max){
    return Math.floor(Math.random() * (max - min + 1)) + min;
}