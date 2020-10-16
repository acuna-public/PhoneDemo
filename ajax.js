	function isNumber (e) {
		
		e = e || window.event;
		var charCode = (typeof e.which == 'undefined') ? e.keyCode : e.which; // IE имеет метод keyCode вместо which
		
		return /\d/.test (String.fromCharCode (charCode));
		
	}
	
	var uname = document.getElementById ('name');
	
	uname.onkeypress = function (e) { // Используем onkeypress вместо onkeyup, так как он может получать информацию о набранном символе, что позволит обойтись без регулярок и каких-либо дополнительных действий со строкой, так как проверка осуществляется еще до ввода
		return !isNumber (e);
	}
	
	var phone = document.getElementById ('phone');
	
	phone.onkeypress = function (e) {
		return (isNumber (e) && e.target.value.length < 11);
	}
	
	var city = document.getElementById ('city');
	
	var select = document.getElementById ('city');
	
	select.onchange = function () {
		
		var content = document.getElementById ('content');
		
		content.style.display = 'none';
		
		var xhr = new XMLHttpRequest ();
		
		xhr.open ('POST', 'ajax.php', false);
		
		var formData = new FormData ();
		
		formData.append ('name', uname.value);
		formData.append ('phone', phone.value);
		formData.append ('city', city.value);
		
		xhr.send (formData); // Шлем нужные данные на сервер
		
		var span = document.createElement ('span');
		
		if (xhr.status == 200)
			span.innerHTML = xhr.responseText;
		else
			span.innerHTML = xhr.status + ' ' + xhr.statusText;
		
		document.body.appendChild (span);
		
	}