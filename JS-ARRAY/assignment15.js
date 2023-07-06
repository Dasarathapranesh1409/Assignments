let color = ["Blue ", "Green", "Red", "Orange", "Violet", "Indigo", "Yellow "];

function Ordinal(n)
 {
 let o = ["th","st","nd","rd"],
 x = n%100;
 return x+(o[(x-20)%10]||o[x]||o[0]);
 }

for(n = 0; n < color.length; n++){
 let ordinal = n + 1;

 let output = (Ordinal(ordinal) + " choice is " + color[n] + ".");

console.log(output);
}

