let x = 80;
let y = 70;
if (x != y)
{
x1 = Math.abs(x - 100);
y1 = Math.abs(y - 100);

if (x1 < y1)
{
  console.log(x);
}
if (y1 < x1)
{
  console.log(y);
}

else{
  console.log ("false");
}
}