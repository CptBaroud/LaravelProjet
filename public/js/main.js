function markNotificationAsRead(notificationCount){
	if(notificationCount != 0){
		$.get('/markAsRead');
	}
}


function checkNickName(field)
{
	if(field.value.length < 2 || field.value.length > 25)
	{	
		surligne(field, true);
		return false;
	}
	else
	{	
		surligne(field, false);
		return true;
	}
}

function checkMail(field)
{
	var regex =/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if(!regex.test(field.value))
	{
		surligne(field, true);
		return false;
	}
	else
	{
		surligne(field, false);
		return true;
	}
}

function checkPswd(field)
{
	var regex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");
	if(!regex.test(field.value))
	{	
		surligne(field, true);
		return false;
	}
	else
	{
		surligne(field, false);
		return true;
	}
}

function verifFormRegister(f)
{

	var nickNameOk = checkNickName(f.last_name);
	var mailOk = checkMail(f.email);
	var pswdOk = checkPswd(f.password);
	var checkBox = document.getElementById("agree");
	console.log(checkBox.checked);


	if(nickNameOk && mailOk && pswdOk && checkBox.checked == true){
		return true;
	}
	else
	{
		alert("Veuillez remplir correctement tous les champs");
		return false;
	}
}

function surligne(champ, erreur)
{
	if(erreur)
		champ.style.backgroundColor = "#fba";
	else
		champ.style.backgroundColor = "";
}

if($('.cookie-banner').length){
	$('.cookie-banner').slideDown(800);
}
function verifName(champ)
	{
			if(champ.value.length < 2 || champ.value.length > 25)
			{
				surligne(champ, true);
				return false;
			}
			else
			{
				surligne(champ, false);
				return true;
			} 
		}

		function verifDescription(champ)
		{
			if(champ.value.length < 2 || champ.value.length > 225)
			{
				surligne(champ, true);
				return false;
			}
			else
			{
				surligne(champ, false);
				return true;
			}
		}

		function verifNumber(champ)
		{
			
			var number = parseInt(champ.value);
			if(isNaN(number) || number < 1 || number > 100)
			{
				surligne(champ, true);
				return false;
			}
			else
			{
				surligne(champ, false);
				return true;
			}
		}

		function verifForm(f)
		{
			var nameOk = verifName(f.name);
			var descriptionOk = verifDescription(f.description);
			var numberOk = verifNumber(f.number);

			if(nameOk && descriptionOk && numberOk)
				return true;
			else
			{
				alert("Veuillez remplir correctement tous les champs");
				return false;
			}
		}