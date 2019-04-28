/**
 * A class to create an object that can control the mobile menu 
 */

class MobileNav
{
	constructor()
	{
		this.hamburgerButton = document.getElementById("hamburger");
		this.exitMobileMenu = document.getElementById("exitMobileMenu");
		this.mobileMenu = document.getElementById("contentNav");
		this.mobileMenuLinks = document.querySelectorAll(".menuLinks");
		this.filter = document.getElementById("filterBody");
	};

	showMenu(e)
	{
		e.preventDefault();
		this.mobileMenu.classList.toggle("pop");
		this.filter.classList.toggle("filterBody");
	};

	hideMenu(e)
	{
		e.preventDefault();
		this.mobileMenu.classList.toggle("pop");
		this.filter.classList.toggle("filterBody");
	};

	initControls()
	{
		this.hamburgerButton.addEventListener("click", this.showMenu.bind(this));
		this.exitMobileMenu.addEventListener("click", this.hideMenu.bind(this));
		
		for(let i = 0; i < this.mobileMenuLinks.length; i++)
		{
			this.mobileMenuLinks[i].addEventListener("click", this.hideMenu.bind(this));
		};
	};
};