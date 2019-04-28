/**
 * A class to create an object that can display more posts 
 */

class PostsView
{
	constructor() 
	{
		this.blocsPosts = document.querySelectorAll(".postsBlog");
		this.buttonShowMore = document.getElementById("showMorePosts");
		this.postsVisibles = 5;
	};

	init()
	{	
		for (let i = 0; i < this.blocsPosts.length; i++)
		{
			this.blocsPosts[i].classList.add("invisible");
		}
		this.display();
	};

	display()
	{
		for(let i = 0; i < this.postsVisibles; i++)
		{
			if (i < this.blocsPosts.length) 
			{
				this.blocsPosts[i].classList.remove("invisible");
			}
			else
			{
				this.buttonShowMore.style.display = "none";
			};
		};
	};

	showMore()
	{
			this.postsVisibles += 2;
			this.display();
	};

	initControls()
	{
		this.buttonShowMore.addEventListener("click", (e) => {
			this.showMore();
		});
	};
};

let newPostsView = new PostsView;
newPostsView.init();
newPostsView.initControls();