function add(a,b,c){
    var d = a%100;
    var e = b%100;
    var f = c%100;
    if((d==e==f)){
        return true
    }
    else{
        return false
    }

}
console.log(add(264,564,664))