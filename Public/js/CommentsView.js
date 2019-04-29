/**
 * A class to create an object that can display more posts 
 */

class CommentsView
{
	constructor()
	{
		this.controller = document.getElementById("showMoreComments");
		this.comments = document.getElementById("comments");
		this.arrow = document.getElementById("arrow");
		this.status = null;
	}

	init()
	{
		this.status = 0;
	}

	showComments()
	{
		this.comments.classList.toggle("bigger");
		this.arrow.classList.remove("fa-sort-up");
		this.arrow.classList.add("fa-sort-down");
	}

	hideComments()
	{
		this.comments.classList.toggle("bigger");
		this.arrow.classList.remove("fa-short-down");
		this.arrow.classList.add("fa-sort-up");
	}

	initControls()
	{
		this.controller.addEventListener("click", (e) => 
			{
				e.preventDefault();
				if (this.status == 0)
				{
					this.showComments();
					this.status++;
				} 
				else 
				{
					this.hideComments();
					this.status = 0;
				}
		});
	};
};

let newCommentsView = new CommentsView;
newCommentsView.init();
newCommentsView.initControls();