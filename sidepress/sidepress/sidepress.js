
function sidepress_ok()
{
  alert("Updated");
}

function sidepress_update(content, element)
{
  element = document.getElementById("sidepress");

	var values = content.split("\n");

	var x = values[0].split("=");
	var number = x[1];
	
	x = values[1].split("=");
	var titleflag = x[1];
  
	x = values[2].split("=");
	var dateflag = x[1];
  
	x = values[3].split("=");
	var descflag = x[1];
  
	x = values[4].split("=");
	var descsize = x[1];
        	
	element.number.value = number;
	element.title.checked = (titleflag == "1");
	element.date.checked = (dateflag == "1");
	element.description.checked = (descflag == "1");
	element.descsize.value = descsize;
	
}

function sidepress_restore()
{
	AARead("../wp-content/plugins/sidepress/sidepress.ini", sidepress_update, null);
}

function sidepress_save()
{ 

  var element = document.getElementById("sidepress");
	var content = "number=" + element.number.value;
	content += "&title=" + (element.title.checked ? 1 : 0);
	content += "&date=" + (element.date.checked? 1 : 0);
	content += "&desc=" + (element.description.checked? 1 : 0);
	content += "&descsize=" + element.descsize.value;

	AAWrite("../wp-content/plugins/sidepress/sidepress-save.php", content, sidepress_ok);
} 


