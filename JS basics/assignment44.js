let x = 30;
let y = 50;
let z = 40;
if((x>=20 && (x<y || x<z)) || (y>=20 && (y<x || y<z)) || (z>=20 && (z<y || z<x))){
console.log("true");
}
else{
console.log("false");
}