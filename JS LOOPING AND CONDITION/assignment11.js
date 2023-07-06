let x = 12;
let y = 8;
let gcd = 0;
for (let i = 1;i<=y;i++){
    if((x%i==0) && (y%i==0)){
        gcd=i;
    }
}
console.log(gcd);