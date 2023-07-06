// function is_string(str){
//     let type = typeof(str);
//     if(type=="string"){
//         return true;
//     }
//     else{
//         return false;
//     }
// }
// console.log(is_string('w3resource'));
// console.log(is_string([1, 2, 4, 0]));


// function is_Blank(str){
//     let type = typeof(str);
//     if(type==="undefined"){
//         return true;
//     }
//     else{
//         return false;
//     }
// }
// console.log(is_Blank());
// console.log(is_Blank('abc'));


// function string_to_array(str){
//     return str.trim().split(" ");
// }
// console.log(string_to_array("Robin Singh"));


// function truncate_string(str,n){
//      return str.slice(0,n);
// }
// console.log(truncate_string("Robin Singh",5));


// function string_parameterize(str){
//     return str.trim().replace(/[^A-Z a-z 0-9]/g,"").replace(/\s/g,"-");
// }

// console.log(string_parameterize("Robin Singh from USA."));


// function capitalize(str){
//     return str.charAt(0).toUpperCase()+str.slice(1);
     
//  }
//  console.log(capitalize('js string exercises'));

// function capitalize_Words(str){
//     let split = str.split();
//     for(let i = 0 ; i<str.length; i++){
//         split[i] = split[i][0].toUpperCase() + split[i].substr(1);
//         split.join("");
//         return split;
//     }
// }
// console.log(capitalize_Words('js string exercises'));

// function mail(str){
//     var regex = /[a-z A-Z 0-9 @][.]/;
//     if(regex.test(str)){
//         return"valid email";
//     }
//     else{
//         return"invalid email";
//     }
//     }
//     console.log(mail("pranesh1409@gmailcom"));

    // var person = {
//     name : "pranesh",
//     age : 21,
//     getname : function(){
//         console.log(this.name)
//     }
// }
// var person2 = {
//     name : "hello"
// }
//  let x = person.getname.bind(person2)
// x();

// let a = [1,2,3];
// console.log(a);
// let b = a;
// // console.log(b);
// let year = 2008;
// if((year%4==0 && year%100!=0)||(year%400==0)){
//     console.log("leap")
// }


// var array1 = [1, 2, 3];
// var array2 = [2, 30, 1];
// var x = array1.concat(array2);
// console.log (x)
// var a = [...new Set(x)];
// console.log(a);

// function search_word(str,found){
//   let a = str.split()
//   for(let i =0; i<str.length;i++){
//       if(a[i]===found){
//           return found;
//       }
//   }
// }

// console.log(search_word('The quick brown fox', 'fox'));

// function case_insensitive_search(str,found){
//     if(str.endsWith(found)){
//         return "Matched";
//     }
//     else{
//         return "Not Matched "
//     }
// }
// console.log(case_insensitive_search('JavaScript Exercises', 'Exercises'));
// console.log(case_insensitive_search('JavaScript Exercises', 'Exercisess'));
// console.log(case_insensitive_search('JavaScript Exercises', 'exercises'));

// function humanize(n){
//     if(n%100>=11 && n%100<=13){
//         return n + "th";
//     }
//  var n=n%10;  
//  switch(n){
//      case 1:
//          return n + "st"
//     case 2:
//         return n + "nd"
//     case 3:
//         return n + "rd"
//  }
//  return n + "th"
// }
// console.log(humanize(1));
// console.log(humanize(20));
// console.log(humanize(302));

// var n = 6;
// var str="";
// for(let i = 0;i<n;i++){
//     for(let j =0;j<i;j++){
//         str+="*";
//     }
//     console.log(str);
//     str="";
// // }

// function mail(str){
// var regex = /[a-z A-Z 0-9 @][.]/;
// if(regex.test(str)){
//   return ("valid email");
// }
// else{
//   return ("invalid email");
// }
// }
// console.log(mail("pranesh1409@gmail.com"));

// function nthlargest(arr,n){
//     var arr1 = arr.sort();
//     console.log(arr1);
//     for(let i=0;i<arr1.length;i++){
//         if(i==n){
//             return arr[i];
//         }
//     }
// }
// console.log(nthlargest([ 43, 56, 23, 89, 88, 90, 99], 4));

// function array_filled(count,n){
//     // var str=n.toString()
//     if(count>0){
//       return  n.repeat(count);
//     }
    
// }
// console.log(array_filled(4, 11));
// console.log(array_filled(6, 0));

// console.log(array_filled(3, 'default value'));
// console.log(array_filled(4, 'password'));

// function filter_array_values(arr){
//     var arr1 = [];
//     for(let i =0;i<arr.length;i++){
//         if(arr[i]=='abcd'){
//             arr.push(arr1);
//             console.log(arr1)
//         }
    
//     }
// }
function filter_array_values(arr) {
    arr = arr.filter(isEligible);
    return arr;
  }
  function isEligible(value) {
    if(value !== false || value !== null || value !== 0 || value !== "") {
      return value;
    }
  }
  console.log(filter_array_values([58, '', 'abcd', true, null, false, 0]));