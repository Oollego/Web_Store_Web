console.log("Script.js");

document.addEventListener('DOMContentLoaded', () => {

	var elemsAuthDrop = document.querySelectorAll('.dropdown-trigger');
    var instancesElemsAuthDrop = M.Dropdown.init(elemsAuthDrop, {"alignment": "left"});

	var elemsTabs = document.querySelector('.tabs');
	var instanceTab = M.Tabs.init(elemsTabs, {"duration": 300});


	var elems = document.querySelector('.carousel');
	var instance = M.Carousel.init(elems, { "duration": 300, "padding": 15, "numVisibler": 4 });

	if (instance != null) {
		setInterval(() => {
			instance.next();
		}, 7000);
	}

	var elems = document.querySelectorAll('.modal');
	M.Modal.init(elems, {
		"opacity": 0.5, 	// Opacity of the modal overlay.
		"inDuration": 250, 	// Transition in duration in milliseconds.
		"outDuration": 250, 	// Transition out duration in milliseconds.
		"onOpenStart": null,	// Callback function called before modal is opened.
		"onOpenEnd": null,	// Callback function called after modal is opened.
		"onCloseStart": null,	// Callback function called before modal is closed.
		"onCloseEnd": null,	// Callback function called after modal is closed.
		"preventScrolling": true,	// Prevent page from scrolling while modal is open.
		"dismissible": true,	// Allow modal to be dismissed by keyboard or overlay click.
		"startingTop": '4%',	// Starting top offset
		"endingTop": '10%'	// Ending top offset
	});

	var elemsColaps = document.querySelectorAll('.collapsible');
	M.Collapsible.init(elemsColaps, { "accordion": true });
	//доступно контекстное меню

	const signupButton = document.getElementById("signup-button");
	if (signupButton) { signupButton.onclick = signupButtonClick; }
	

	const authButton = document.getElementById("auth-button");
	if (authButton) { authButton.onclick = authButtonClick; }
	

	const signoutButton = document.getElementById("signout-button");
	if (signoutButton) { signoutButton.onclick = SignoutButtonClick; }
	
	const subGroup = document.querySelectorAll('.imgHref');
	if (subGroup.length>0) { subGroup.forEach((e)=>e.onclick = GetItemsFromSubGroupsClick ) }
	

	const subGroupName = document.querySelectorAll('.ffutrg');
	if (subGroupName.length>0) { subGroupName.forEach((e)=>e.onclick = GetItemsFromSubGroupsClick ) }
	

	const itemGroup = document.querySelectorAll('.ItemgrHref');
	if (itemGroup.length > 0) { itemGroup.forEach((e)=>e.onclick = GetItemsFromItemGroupClick ) }
	

	// let itemDiv = document.querySelectorAll('.items_img_div img');
	// if (itemDiv.length > 0) { itemDiv.forEach((e)=>e.onclick = GetItemByIdClick ) }
	// else {console.log("itemDiv");}

	// let itemName = document.querySelectorAll('.item_name');
	// if (itemName.length > 0) { itemName.forEach((e)=>e.onclick = GetItemByIdClick ) }
	// else {console.log("itemName");}

	let imgBoxDiv = document.querySelectorAll('.img_box_div');
	if (imgBoxDiv.length > 0) { imgBoxDiv.forEach((e)=>e.onclick = selectImg ) }
	else {console.log("imgBoxDiv");}

	const buyButtonClick = document.getElementById("buyItemButton");
	if (buyButtonClick) { buyButtonClick.onclick = addItemtoBasket; }

	const basketDeleteButton = document.querySelectorAll(".basket-delete-img");
	if (basketDeleteButton) { basketDeleteButton.forEach((e)=>e.onclick = BasketDeleteItemClick) }

	const basketItemQuantitySub = document.querySelectorAll(".basketItemSub");
	if (basketItemQuantitySub) { basketItemQuantitySub.forEach((e)=>e.onclick = basketItemQuantitySubClick) }
	
	const basketItemQuantityAdd = document.querySelectorAll(".basketItemAdd");
	if (basketItemQuantityAdd) { basketItemQuantityAdd.forEach((e)=>e.onclick = basketItemQuantityAddClick) }

	const buttonSearch = document.querySelector('.button-search');
	if (buttonSearch) { buttonSearch.onclick = buttonSearchItemClick }

	const nameCabinetButton = document.getElementById("name-cabinet-button");
	if (nameCabinetButton) { nameCabinetButton.onclick = nameCabinetButtonClick; }
	
	const addressCabinetButton = document.getElementById("address-cabinet-button");
	if (addressCabinetButton) { addressCabinetButton.onclick = addressCabinetButtonClick; }

	const emailPhoneCabinetButton = document.getElementById("contact-data-cabinet-button");
	if (emailPhoneCabinetButton) {emailPhoneCabinetButton.onclick = EmailPhoneCabinetButtonClick; }

	const avatarCabinetButton = document.getElementById("avatar-cabinet-button");
	if (avatarCabinetButton) {avatarCabinetButton.onclick = avatarButtonClick; }

	const checkoutButton = document.getElementById("checkout_button");
	if (checkoutButton) {checkoutButton.onclick = checkoutButtonClick; }
	
});

function buttonSearchItemClick(e){
	let searchInput = document.getElementById("search-input").value;
	fetch(`/search?search_name=${searchInput}`, {
		method: 'GET'
	})
	.then(r => r.json())
	.then(j => {
		if(j.status == 1){
			window.location = '/items';
			 //window.location.reload();
		}
		else{
			console.log(j.data.message);
		}
	});
}

function basketItemQuantitySubClick(e){
	
	let basketItemId = e.target.dataset.basketitemid;
	fetch(`/basket?item_id=${basketItemId}&AddOrSub=sub`, {
		method: 'PUT'
	})
	.then(r => r.json())
	.then(j => {
		if(j.status == 1){
			window.location.reload();
		}
		else{
			console.log(j.data.message);
		}
	});
}

function basketItemQuantityAddClick(e){
	console.dir(e.target);
	let basketItemId = e.target.dataset.basketitemid;
	fetch(`/basket?item_id=${basketItemId}&AddOrSub=add`, {
		method: 'PUT'
	})
	.then(r => r.json())
	.then(j => {
		if(j.status == 1){
			window.location.reload();
		}
		else{
			console.log(j.data.message);
		}
	});
}

function BasketDeleteItemClick(e){
	let basketItemId = e.target.dataset.basketitemid;
	
	fetch(`/basket?item_id=${basketItemId}`, {
		method: 'DELETE'
	})
	.then(r => r.json())
	.then(j => {
		if(j.status == 1){
			window.location.reload();
		}
		else{
			console.log(j.data.message);
		}
	});
	
}

function addItemtoBasket(){

	let formData = new FormData();
	let pos = window.location.href.lastIndexOf("_") ;
	let itemId = window.location.href.substring( pos + 1 ).trim();
	
	formData.append("item_id", itemId);
	
	fetch(`/basket`, { method: 'POST', body: formData })
		.then(r => r.json())
		.then(j => {
			if (j.status == 1) { //register OK
				alert('Successfuly added to basket');
				window.location.reload();
			}
			else { //Error
				alert(j.data.message);
			}
		});
}

function selectImg(e){
    let boardImg = document.getElementById("bigImgItem");
    if(!boardImg) throw '#inputImg not found';
    let newBoardImg= document.createElement("img");
    newBoardImg.classList.add("item_img", "col", "s12");

	// newBoardImg.src = `/img/item/${e.target.alt}`;
	// let eImg = e.target.
	
    newBoardImg.src = e.target.firstElementChild.currentSrc;
   	newBoardImg.id = "bigImgItem";
    newBoardImg.alt = e.target.alt;
    boardImg.replaceWith(newBoardImg);
}

function GetItemsFromItemGroupClick(e){
	let targetName = e.target.dataset.subgroup; 
	
	fetch(`/ItemGroup?group_name=${targetName}`, {
		method: 'GET'
	})
	.then(r => r.json())
	.then(j => {
		if(j.status == 1){
			window.location = '/items'
		}
		else{
			console.log(j.data.message);
		}
	});
}

function GetItemsFromSubGroupsClick(e){
	let targetName = e.target.dataset.subgroup; 
	
	fetch(`/SubGroup?group_name=${targetName}`, {
		method: 'GET'
	})
	.then(r => r.json())
	.then(j => {
		if(j.status == 1){
			window.location = '/items'
		}
		else{
			console.log(j.data.message);
		}
	});
}

// function GetItemByIdClick(e){
// 	let targetName = e.target.dataset.codeitem; 
	
// 	fetch(`/Item?item_id=${targetName}`, {
// 		method: 'GET'
// 	})
// 	.then(r => r.json())
// 	.then(j => {
// 		if(j.status == 1){
// 			window.location = '/itemview'
// 		}
// 		else{
// 			console.log(j.data.message);
// 		}
// 	});
// }

function SignoutButtonClick(e){
	
	fetch(`/auth`, {
		method: 'DELETE'
	})
	.then(r => r.json())
	.then(j => { 
		if (j.status == 1) { //register OK
			alert('Out success');
			window.location = '/';
		}
		else { //Error
			alert(j.data.message);
		}
	});
	window.location = '/';
	
}
function authButtonClick(e) {
	const emailInput = document.querySelector('input[name="auth-email"]');
	if (!emailInput) { throw "'auth-email' not found"; }
	const passwordInput = document.querySelector('input[name="auth-password"]');
	if (!passwordInput) { throw "'auth-password' not found"; }

	fetch(`/auth?email=${emailInput.value}&password=${passwordInput.value}`, {
		method: 'PATCH'
	})
	.then( r => r.json() )
	.then(j => { 
		if (j.status == 1) { //register OK
			window.location = '/';
		}
		else { 
			alert(j.data.message);
		}
	});
	
}

function signupButtonClick(e) {

	const signupForm = e.target.closest('form');
	if (!signupForm) {
		throw "Signup form not found";
	}

	const nameInput = signupForm.querySelector('input[name="user-name"]');
	if (!nameInput) { throw "nameInput not found"; }
	const emailInput = signupForm.querySelector('input[name="user-email"]');
	if (!emailInput) { throw "emailInput not found"; }
	const passwordInput = signupForm.querySelector('input[name="user-password"]');
	if (!passwordInput) { throw "passwordInput not found"; }
	const repeatInput = signupForm.querySelector('input[name="user-repeat"]');
	if (!repeatInput) { throw "repeatInput not found"; }
	const avatarInput = signupForm.querySelector('input[name="user-avatar"]');
	if (!avatarInput) { throw "avatarInput not found"; }

	let isFormValid = true;

   
	if ( !(/[a-zA-Z]+$/.test(nameInput.value)) ) {
		
		nameInput.classList.add("invalid");
		isFormValid = false;
	}
	else {
		nameInput.classList.remove("invalid");
		
	}

	if ( !(/^(\w+)@(\w+)\.(\w{2,10})/.test(emailInput.value)) ) {
		
		emailInput.classList.add("invalid");
		isFormValid = false;
	}
	else {
		nameInput.classList.remove("invalid");
		
	}
		

	if((passwordInput.value != repeatInput.value)||(passwordInput.value == "")){
		passwordInput.classList.add("invalid");
		repeatInput.classList.add("invalid");
		isFormValid = false;
	}
	else{
		passwordInput.classList.remove("invalid");
		repeatInput.classList.remove("invalid");
	}

	if (!isFormValid) return;


	const formData = new FormData();
	formData.append("user-name", nameInput.value);
	formData.append("user-email", emailInput.value);
	formData.append("user-password", passwordInput.value);
	if (avatarInput.files.length > 0) {
		formData.append("user-avatar", avatarInput.files[0]);
	}

	fetch("/auth", { method: 'POST', body: formData })
		.then(r => r.json())
		.then(j => {
			if (j.status == 1) { //register OK
				alert('Register success');
				window.location = '/';
			}
			else { //Error
				alert(j.data.message);
			}
		});
}

function checkoutButtonClick(e){
	const checkoutForm = e.target.closest('form');
	if (!checkoutForm) {
		throw "Signup form not found";
	}

	const nameInput = document.getElementById("check_first_name");
	if (!nameInput) { throw "nameInput not found"; }
	const surnameInput = document.getElementById("check_last_name");
	if (!surnameInput) { throw "surnameInput not found"; }
	const emailInput = document.getElementById("check_email");
	if (!emailInput) { throw "emailInput not found"; }
	const phoneInput = document.getElementById("check_phone");
	if (!phoneInput) { throw "phoneInput not found"; }
	const addressInput = document.getElementById("check_address");
	if (!addressInput) { throw "addressInput not found"; }
	const commentInput = document.getElementById("check_comment");
	if (!commentInput) { throw "commentInput not found"; }

	const shipmentRadio = checkoutForm.querySelectorAll('input[name="checkout_shipment"]');
	if (!shipmentRadio) { throw "shipmentRadio not found"; }

	const paymentRadio = checkoutForm.querySelectorAll('input[name="checkout_payment"]');
	if (!paymentRadio) { throw "paymentRadio not found"; }

	// const shipmentRadio = document.querySelectorAll([name="checkout_shipment"]);
	// if (!shipmentRadio) { throw "shipmentRadio not found"; }
	

	let isFormValid = true;
	if ( !(/[a-zA-Z]+$/.test(nameInput.value)) ) {
		nameInput.classList.add("invalid");
		isFormValid = false;
	}
	else {
		nameInput.classList.remove("invalid");
	}
	if ( !(/[a-zA-Z]+$/.test(surnameInput.value)) ) {
		surnameInput.classList.add("invalid");
		isFormValid = false;
	}
	else {
		surnameInput.classList.remove("invalid");
	}

	if ( !(/^(\w+)@(\w+)\.(\w{2,10})/.test(emailInput.value)) ) {
		
		emailInput.classList.add("invalid");
		isFormValid = false;
	}
	else {
		nameInput.classList.remove("invalid");
		
	}
	if ( !(/\d{6}/.test(phoneInput.value)) ) {
		phoneInput.classList.add("invalid");
		isFormValid = false;
	}
	else {
		phoneInput.classList.remove("invalid");
		
	}	
	if(addressInput.value < 10){
		addressInput.classList.add("invalid")
		isFormValid = false;
	}
	else{
		addressInput.classList.remove("invalid")
	}

	if (!isFormValid) return;



	const formData = new FormData();
	formData.append("checkout-name", nameInput.value);
	formData.append("checkout-surname", surnameInput.value);
	formData.append("checkout-email", emailInput.value);
	formData.append("checkout-phone", phoneInput.value);
	formData.append("checkout-address", addressInput.value);
	formData.append("checkout-comment", commentInput.value);

	for(shipment of shipmentRadio){
		if(shipment.checked){
			formData.append("checkout-shipment", shipment.value);
		}
	}

	for(payment of paymentRadio){
		if(payment.checked){
			formData.append("checkout-payment", payment.value);
		}
	}

	fetch("/confirmation", { method: 'POST', body: formData })
		.then(r => r.json())
		.then(j => {
			if (j.status == 1) { //register OK
				alert('Замовлення прийнято');
				window.location = '/';
			}
			else { //Error
				alert(j.data.message);
			}
		});
}

function avatarButtonClick(e){
	let avatarInput = document.getElementById("avatar_cabinet_input"); 
	
	const formData = new FormData();
	if (avatarInput.files.length > 0) {
		formData.append("user-avatar", avatarInput.files[0]);
	}
	fetch("/avatarupdate", { method: 'POST', body: formData })
		.then(r => r.json())
		.then(j => {
			if (j.status == 1) { 
				alert('Avatar is added');
				window.location.reload();
			}
			else { 
				alert(j.data.message);
			}
		});

}

function nameCabinetButtonClick(e){
	const nameCabinetForm = e.target.closest('form');
	if (!nameCabinetForm) {
		throw "nameCabinetForm form not found";
	}

	const nameInput = nameCabinetForm.querySelector('input[name="user-cabinet-name"]');
	if (!nameInput) { throw "nameInput not found"; }
	const surnameInput = nameCabinetForm.querySelector('input[name="user-cabinet-surname"]');
	if (!surnameInput) { throw "emailInput not found"; }
	
	let isFormValid = true;

	if ( !(/[a-zA-Z]+$/.test(nameInput.value)) ) {
		
		nameInput.classList.add("invalid");
		isFormValid = false;
	}
	else {
		nameInput.classList.remove("invalid");
		
	}

	if ( !(/[a-zA-Z]+$/.test(surnameInput.value)) ) {
		
		surnameInput.classList.add("invalid");
		isFormValid = false;
	}
	else {
		surnameInput.classList.remove("invalid");
		
	}

	if (!isFormValid) return;
	const formData = new FormData();
	formData.append("user-name", nameInput.value);
	formData.append("user-surname", surnameInput.value);

	fetch("/usernameupdate", { method: 'POST', body: formData })
		.then(r => r.json())
		.then(j => {
			if (j.status == 1) { //register OK
				alert('Name changed');
				window.location.reload();
			}
			else { //Error
				alert(j.data.message);
			}
		});

}

function EmailPhoneCabinetButtonClick(e){
	const EmailPhoneForm = e.target.closest('form');
	if (!EmailPhoneForm) {
		throw "EmailPhoneCabinetForm form not found";
	}

	const emailInput = EmailPhoneForm.querySelector('input[name="user-cabinet-email"]');
	if (!emailInput) { throw "emailInput not found"; }
	const phoneInput = EmailPhoneForm.querySelector('input[name="user-cabinet-phone"]');
	if (!phoneInput) { throw "phoneInput not found"; }
	
	let isFormValid = true;

	if ( !(/^(\w+)@(\w+)\.(\w)/.test(emailInput.value)) ) {
		
		emailInput.classList.add("invalid");
		isFormValid = false;
	}
	else {
		emailInput.classList.remove("invalid");
		
	}

	if ( !(/\d{6}/.test(phoneInput.value)) ) {
		
		phoneInput.classList.add("invalid");
		isFormValid = false;
	}
	else {
		phoneInput.classList.remove("invalid");
		
	}

	if (!isFormValid) return;
	const formData = new FormData();
	formData.append("user-email", emailInput.value);
	formData.append("user-phone", phoneInput.value);

	fetch("/emailphoneupdate", { method: 'POST', body: formData })
		.then(r => r.json())
		.then(j => {
			if (j.status == 1) { //register OK
				alert('Email, phone are changed');
				window.location.reload();
			}
			else { //Error
				alert(j.data.message);
			}
		});


}

function addressCabinetButtonClick(e){
	let user_address_cab_text = document.getElementById("user_address_cab_text");
	if (!user_address_cab_text) { throw "user_address_cab_text not found"; }

	if(user_address_cab_text.value < 10){
		return;
	}
	const formData = new FormData();
	formData.append("user_address", user_address_cab_text.value);
	fetch("/Addressupdate", {method: 'POST', body: formData})
	.then(r => r.json())
	.then(j => {
		if (j.status == 1) { //register OK
			alert('Name changed');
			window.location.reload();
		}
		else { //Error
			alert(j.data.message);
		}

	});
}








