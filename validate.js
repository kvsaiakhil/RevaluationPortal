function validate()
{
var x=document.details.usn.value.search(/1BM1[3-6][A-Z]{2}[0-9]{3}/i);
if(x==0)
{
return true;
}
else
{
alert("Enter valid USN");
return false;
}


}
function validatename()
{
var y=document.details.name.value.search(/[A-Za-z]/);
if(y==0)
{
return true;
}
else
{
alert("enter valid name");
return false;
}
}


function validatemn()
{
var z=document.details.phn.value.search(/[7-9][0-9]{9}/);
if(z==0)
{
  return true;
}
else {
alert("Invalid Mobile no.");
return false;
}
}
