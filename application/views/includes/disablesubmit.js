
var oldvalue = "";
$("form").submit(function(ev){
    var newvalue = $("title", this).val();
    if(newvalue == oldvalue) ev.preventDefault(); //Same value, cancel submission
    else oldvalue = newvalue;
})
