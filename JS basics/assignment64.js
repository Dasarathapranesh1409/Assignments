let str1 = "hello";
let str2 = "world";
let  m = Math.min(str1.length, str2.length);
console.log( str1.substring(str1.length - m) + str2.substring(str2.length - m));
  