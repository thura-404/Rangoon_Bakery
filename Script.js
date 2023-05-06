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

var swiper = new Swiper(".Product_Slider", 
{
	loop: true,
	spaceBetween: 20,
	autoplay:
	{
		delay: 3500,
		disableOnInteraction: false,
	},
	breakpoints: 
	{
	  0: 
	  {
		slidesPerView: 1,
	  },
	  768: 
	  {
		slidesPerView: 2,
	  },
	  1020: 
	  {
		slidesPerView: 3,
	  },
	},
});


let Preview_Container 	= document.querySelector('.Product_Preview');
let Preview_Box			= Preview_Container.querySelectorAll('.Preview');
let Box_Container		= document.querySelector('.Box_Container');
let Box_A	 			= Box_Container.querySelectorAll('.Box');

document.querySelectorAll('.Box_Container .Box').forEach(Box => {
	Box.onclick = () => {
		Preview_Container.style.display = 'flex';
		let Name = Box.getAttribute('data-name');

		Preview_Box.forEach(Preview => {
			let Target = Preview.getAttribute('data-target');
			if (Name == Target) {
				Preview.classList.toggle('Active');
			}
		});
	};
});

Preview_Box.forEach(close => {
	close.querySelector('.fa-times').onclick = () => {
		close.classList.remove('Active');

		Preview_Container.style.display = 'none';
	}
});

Box_A.forEach(close => {
	close.querySelector('.fa-eye').onclick = () => {
		Preview_Container.style.display = 'flex';
		Preview.classList.toggle('Active');
	}
});