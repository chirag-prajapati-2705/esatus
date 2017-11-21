checked = false;
function checkedAll(form) 
{
    var doc = document.getElementById('form');
    if (checked == false)
    {
        checked = true
    }
    else
    {
        checked = false
    }
    for (var i = 0; i < doc.elements.length; i++) 
    {
        doc.elements[i].checked = checked;
    }
}