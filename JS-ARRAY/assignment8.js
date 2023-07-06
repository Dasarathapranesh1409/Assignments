let arr = [3,'a','a','a',2,3,'a',3,'a',2,4,9,3];
let found =0;
let m =1;
var item;
for(let i =0 ;i<arr.length;i++){
    for(let j = i;j<arr.length;j++){
        if(arr[i]==arr[j]){
            found++;
             }
          if(m<found){
            m=found;
            item = arr[i]
          }   
    }
    found=0;
}
console.log(item,m);