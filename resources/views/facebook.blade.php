
<script src="js/jquery-2.1.1.js"></script>
<script>
	function readCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	}

	$(document).ready(function(){
		var str = readCookie('email');
		var	email= str.replace("%40", "@");
		//console.log(email);
		$.ajax({
			type: "POST",
			url: "/api/loginSell",
			data: JSON.stringify({
				"email": email,
				"provider": "seller",
			}),
			contentType: "application/json; charset=utf-8",
			dataType: "json",
			success: function(data){

				var mytoken = JSON.stringify(data['success']['token']);
				localStorage.setItem("sid",data['success']['sid']);
				localStorage.setItem("user_token",mytoken.replace(/['"]+/g, ''));
				window.location.replace('/brand');
			},
			error: function(data){
				console.log(data);

			}
			,
			failure: function(errMsg) {
				alert(errMsg);
			}
		});


	});




</script>
