function showListPhanHoi($id){
	event.preventDefault();
	var check = document.getElementById('list-reply-cmt'+$id);
	var togle = document.getElementById('togle'+$id);
	// console.log(check.style.display);
	if(check.style.display === 'none'){
		check.style.display = 'block';
		togle.innerHTML = 'Ẩn';
	}
	else{
		check.style.display = 'none';
		togle.innerHTML = 'Xem';
	}
}

function checkFormReply($id){
	event.preventDefault();
	var check = document.getElementById("replycomment"+$id).value.trim();
	var btreply = document.getElementById('btreply'+$id);
	if(check != ''){
		btreply.removeAttribute('disabled');
		btreply.style.color = 'white';
	}else{
		btreply.setAttribute('disabled','disabled');
		btreply.style.color = '';
	}
}

function showRep($id){
	event.preventDefault();
	var a = document.getElementById("noidungreply"+$id);
	a.style.display = "block";
}

function closeRep($id){
	event.preventDefault();
	var a = document.getElementById("noidungreply"+$id);
	a.style.display = "none";
	var aa = document.getElementById("replycomment"+$id);
	aa.value = "";
	var btreply = document.getElementById('btreply'+$id);
	btreply.setAttribute('disabled','disabled');
	btreply.style.color = '';
}

function showOption($id){
	var a = document.getElementById("option"+$id);
	if(a.style.display == "block"){
		a.style.display = "none";
	}else{
		a.style.display = "block";
	}
}

function showUpdate($id){
	var a = document.getElementById("comment_content"+$id);
	a.removeAttribute("disabled");
	a.style.border = "1px solid black";
	a.style.outline = "1px";
}