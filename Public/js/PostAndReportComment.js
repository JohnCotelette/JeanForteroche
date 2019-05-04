/**
 * A class to create an item to post a comment
 */

class PostAndReportComment
{
	constructor()
	{
		this.form = document.getElementById("postForm");
		this.name = this.form.nom;
		this.surname = this.form.prenom;
		this.contentPost = document.getElementById("commentPostContent");
		this.currentArticle = document.getElementById("articleID");
		this.confirmPostMessage = document.getElementById("confirmPostMessage");
		this.submitButton = document.getElementById("submit");
		this.displayCaptchaButton = document.getElementById("displayCaptcha");
		this.reportCommentButtons = document.querySelectorAll(".report");
		this.captcha = new Captcha;
		this.ajax = new Ajax;
	};

	init()
	{
		this.displayCaptchaButton.classList.add("invisible");
		this.captcha.captcha.classList.remove("invisible");
		this.captcha.init();
		this.captcha.initControls();
	};

	check()
	{	
		this.lastContentPost = localStorage.getItem("contentLastPost");
		if (this.contentPost.value === this.lastContentPost)
		{
			alert("Le spam n'est pas une bonne chose !\nVous avez en effet déjà envoyé le même message.\n");
			return;
		}
		else
		{
			this.postComment();
		};
	};

	postComment()
	{
		let message = encodeURIComponent(this.contentPost.value);
		let articleID = encodeURIComponent(this.currentArticle.textContent);
		let name = encodeURIComponent(this.surname.value + " " + this.name.value);
		let data = "name=" + name + "&message=" + message + "&articleID=" + articleID + "&autorisation=" + this.captcha.autorisation;
		this.ajax.sendData("index.php", data, (response) => 
			{	
				console.log(response);
				this.displayConfirmPost();
				setTimeout(() => {
					window.location.reload();
					this.captcha.autorisation = "false";
				}, 2500);
				localStorage.setItem("contentLastPost", this.contentPost.value);
			});
	};

	reportComment(commentID)
	{
		let confirm = window.confirm("Etes vous sur de vouloir signaler ce commentaire ?");
		if (confirm)
		{
			let data = "reported=true" + "&commentID=" + commentID;
			this.ajax.sendData("index.php", data, (response) =>
			{
				document.getElementById(commentID).value = "Signalé !"
			});
		}
		else
		{
			return;
		};
	};

	displayConfirmPost()
	{
		this.confirmPostMessage.classList.remove("invisible");
		this.submitButton.classList.add("invisible");
	};

	initControls()
	{
		this.displayCaptchaButton.addEventListener("click", () => {
			this.init();
		});

		this.form.addEventListener("submit", (e) => {
			e.preventDefault();
			this.check();
		});

		for(let i = 0; i < this.reportCommentButtons.length; i++)
		{
			this.reportCommentButtons[i].addEventListener("click", () => {
				this.reportComment(this.reportCommentButtons[i].getAttribute("id"));
			});
		};
	};
};

let newPostAndReportComment = new PostAndReportComment;
newPostAndReportComment.initControls();