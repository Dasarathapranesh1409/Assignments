function quick_Sort(origArray) {
	if (origArray.length <= 1) { 
		return origArray;
	} else {

		let left = [];
		let right = [];
		let newArray = [];
		let pivot = origArray.pop();
		let length = origArray.length;

		for (var i = 0; i < length; i++) {
			if (origArray[i] <= pivot) {
				left.push(origArray[i]);
			} else {
				right.push(origArray[i]);
			}
		}

		return newArray.concat(quick_Sort(left), pivot, quick_Sort(right));
	}
}

let myArray = [3, 0, 2, 5, -1, 4, 1 ];

console.log("Original array: " + myArray);
let sortedArray = quick_Sort(myArray);
console.log("Sorted array: " + sortedArray);
