
let	Search_From = document.querySelector('.Search_Form');

document.querySelector('#Search_Btn').onclick = () =>
{
	Search_From.classList.toggle('Active');
	Shopping_Cart.classList.remove('Active');
	Login_Form.classList.remove('Active');
	Navbar.classList.remove('Active');
}

let	Shopping_Cart = document.querySelector('.Shopping_Cart');

document.querySelector('#Cart_Btn').onclick = () =>
{
	Shopping_Cart.classList.toggle('Active');
	Search_From.classList.remove('Active');
	Login_Form.classList.remove('Active');
	Navbar.classList.remove('Active');
}

let	Login_Form = document.querySelector('.Login_Form');

document.querySelector('#Login_Btn').onclick = () =>
{
	Login_Form.classList.toggle('Active');
	Search_From.classList.remove('Active');
	Shopping_Cart.classList.remove('Active');
	Navbar.classList.remove('Active');
}

let	Navbar = document.querySelector('.Navbar');

document.querySelector('#Menu_Btn').onclick = () =>
{
	Navbar.classList.toggle('Active');
	Search_From.classList.remove('Active');
	Shopping_Cart.classList.remove('Active');
	Login_Form.classList.remove('Active');
}

window.onscroll = () =>
{
	Search_From.classList.remove('Active');
	Shopping_Cart.classList.remove('Active');
	Login_Form.classList.remove('Active');
	Navbar.classList.remove('Active');
}


var Remove = document.getElementsByClassName("btn-Remove");

for(var i=0; i<Remove.length; i++)
{
    var Remove_Btn = Remove[i];
    Remove_Btn.addEventListener('click', function(event){
		var Clicked = event.target
		Clicked.parentElement.remove();
		Update_Total();		
	});
}


function Update_Total()
{
	var Box_Container 	= document.getElementsByClassName('Box_Container')[0];
	var Boxes 			= Box_Container.getElementsByClassName('Box');

	for (var index = 0; index < Boxes.length; index++) 
	{
		var Box 				= Boxes[index];
		var Price_Element		= Box.getElementsByClassName('Price')[0];
		var Quantity_Element	= Box.getElementsByClassName('Quantity')[0];

		var Price 				= parseFloat(Price_Element.innerText.replace('MMK', ''));
		var Quantity 			= Quantity_Element.value;

		console.log(Price * Quantity);
	}
}