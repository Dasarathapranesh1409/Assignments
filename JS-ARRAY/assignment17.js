function shuffle(arr) {
    let ctr = arr.length;
    let temp;
    let index;
    while (ctr > 0) {

        index = Math.floor(Math.random() * ctr)
        ctr--;
        temp = arr[ctr];
        arr[ctr] = arr[index];
        arr[index] = temp;
    }
    return arr;
}
const myArray = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
console.log(shuffle(myArray));
