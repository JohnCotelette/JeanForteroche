window.onload = function() {
	var newPostsView = new PostsView;
	newPostsView.init();
	newPostsView.initControls();

	var newMobileNav = new MobileNav;
	newMobileNav.initControls();
};