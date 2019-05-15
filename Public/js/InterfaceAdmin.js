/**
 * A class to create an object which can control the admin interface and communicate with the PHP router
 */

class InterfaceAdmin 
{
	constructor()
	{
		// GLOBALS SELECTORS
		this.links = document.querySelectorAll(".links");
		this.controllers = document.querySelectorAll(".sectionTitles");
		this.smallControllers = document.querySelectorAll(".smallCategories");
		this.contents = document.querySelectorAll(".containers");
		this.smallContents = document.querySelectorAll(".smallContents");
		this.bigArrows = document.querySelectorAll(".bigArrows");
		this.smallArrows = document.querySelectorAll(".smallArrows");

		// ARTICLESADD FORM SELECTORS
		this.formAddArticleContainer = document.getElementById("addArticle");
		this.formAddArticle = document.getElementById("formAddArticle");
		this.articleButtonsDelete = document.querySelectorAll(".adminButtonsDeleteArticle");
		this.articlesContainers = document.querySelectorAll(".articles");
		this.articlesSeparators = document.querySelectorAll(".articlesHr");

		// ARTICLESEDIT FORM SELECTORS
		this.formEditArticleContainer = document.getElementById("editArticle");
		this.formEditArticle = document.getElementById("formEditArticle");
		this.changeModButton = document.getElementById("changeMod");
		this.articleButtonsEdit = document.querySelectorAll(".adminButtonsEditArticle");

		// COMMENTS SELECTORS
		this.adminButtonsDeleteComment = document.querySelectorAll(".adminButtonsDeleteComment");
		this.adminButtonsResetComment = document.querySelectorAll(".adminButtonsComment");
		this.commentsContainers = document.querySelectorAll(".commentsReported");
		this.commentsSeparators = document.querySelectorAll(".commentsHr");

		//ADMIN SELECTORS
		this.formAddAdmin = document.getElementById("addAdmin");
		this.adminButtonsDelete = document.querySelectorAll(".adminButtonsDelete");
		this.adminButtonsEdit = document.querySelectorAll(".adminButtonsEdit");
		this.adminsContainers = document.querySelectorAll(".adminsList");
		this.adminsSeparators = document.querySelectorAll(".adminsHr");

		// AJAX OBJECT
		this.ajax = new Ajax;
	};

/* -------------------- ARTICLES  -------------------- */

	addArticle()
	{
		let confirm = window.confirm("Confirmer l'ajout de l'article ?");
		if (confirm)
		{
			let formData = new FormData(this.formAddArticle);
			this.ajax.sendData("index.php", formData, (response) => 
			{	
				alert(response);
				if (response === "L'article a bien été ajouté.")
				{
					this.displayConfirmAlert();
				}
				else
				{
					alert(response);
					return;
				};
			}, "formData") ;
		}
		else
		{
			return;
		};
	};

	editArticle(articleID)
	{
		let confirm = window.confirm("Confirmer la modification de l'article ?");
		if (confirm)
		{
			let formData = new FormData(this.formEditArticle);
			formData.append("articleID", articleID);
			formData.append("firstAuthor", this.formEditArticle.getAttribute("data-firstAuthor"));
			formData.append("lastPictureName", document.getElementById("lastPicture").textContent);
			this.ajax.sendData("index.php", formData, (response) =>
			{
				alert(response);
				if (response === "L'article a bien été modifié.")
				{
					this.displayConfirmAlert();
				}
				else
				{
					return;
				};

			}, "formData");
		};
	};

	downloadInfo(articleID)
	{
		tinymce.activeEditor.setContent("");
		let data = "requestDataArticle=true" + "&articleID=" + articleID;
		this.ajax.sendData("index.php", data, (response) => 
		{
			this.formEditArticle.titleEdit.value = response["title"];
			this.formEditArticle.titleBookEdit.value = response["titleBook"];
			this.formEditArticle.articleContentEdit.value = response["content"];
			this.formEditArticle.setAttribute("data-articleID", response["ID"]);
			this.formEditArticle.setAttribute("data-firstAuthor", response["author"]);
			tinymce.get("articleContentEdit").execCommand('mceInsertContent', false, response["content"]);
			document.getElementById("lastPicture").textContent = response["localPicture"];
			this.displayFormEdit();
		}, "json");
	};

	deleteArticle(articleID, i)
	{
		let confirm = window.confirm('Etes vous sur de vouloir supprimer cet article ?\nCette action est irréversible.');
		if (confirm)
		{
			let data = "deleteArticle=true" + "&articleID=" + articleID;
			this.ajax.sendData("index.php", data, (response) => 
			{	
				this.displayConfirmArticle(i);
				alert("L'article a bien été supprimé.");
			});
		}
		else
		{
			return;
		};
	};

/* -------------------- COMMENTS  -------------------- */

	deleteComment(commentID, i)
	{
		let confirm = window.confirm('Etes vous sur de vouloir supprimer ce commentaire ?\nCette action est irréversible.');
		if (confirm)
		{
			let data = "deleteComment=true" + "&commentID=" + commentID;
			this.ajax.sendData("index.php", data, (response) => 
			{	
				this.displayConfirmComment(i);
				alert("Le commentaire a été supprimé.");
			});
		}
		else
		{
			return;
		};
	};

	cancelReportComment(commentID, i)
	{
		let confirm = window.confirm("Ce commentaire n'apparaitra plus comme signalé, êtes vous sur ?");
		if (confirm)
		{
			let data = "cancelReport=true" + "&commentID=" + commentID;
			this.ajax.sendData("index.php", data, (response) => 
			{	
				this.displayConfirmComment(i);
				alert("Le commentaire n'est plus marqué comme 'signalé'.");
			});
		}
		else
		{
			return;
		};
	};

/* -------------------- ADMINS  -------------------- */

	addAdmin()
	{
		let pseudo = encodeURIComponent(this.formAddAdmin.pseudo.value);
		let password = encodeURIComponent(this.formAddAdmin.password.value);
		let statut = this.formAddAdmin.rights.value;
		let confirm = window.confirm("Voulez vous insérer dans la base de données un nouveau collaborateur ?\nPseudo: " + pseudo + "\nMot de passe: " + password + "\nStatut: " + statut);
		if (confirm)
		{
			let data = "newBlogAdminName=" + pseudo + "&newBlogAdminPassword=" + password + "&newBlogAdminStatut=" + statut;
			this.ajax.sendData("index.php", data, (response) => 
			{	
				alert(response);
				if (response === "Le nouveau collaborateur a bien été ajouté à la base de données.")
				{
					this.displayConfirmAlert();
				}
				else
				{
					return;
				};
			});
		}
		else
		{
			return;
		};
	};

	deleteAdmin(adminID, i)
	{
		let confirm = window.confirm("Cet admin sera supprimé de la base de données.\nCette action est irréversible.");
		if (confirm)
		{
			let data = "deleteAdmin=true" + "&adminID=" + adminID;
			this.ajax.sendData("index.php", data, (response) => 
			{
				alert(response);
				if (response === "L'admin séléctionné a bien été supprimé de la base de données.")
				{
					this.displayConfirmAdminDeleted(i);
				}
				else
				{
					return;
				};
			});
		}
		else
		{
			return;
		}
	};

/* -------------------- DISPLAYS  -------------------- */

	displayConfirmAlert()
	{
		let confirmAlert = window.confirm("Actualiser la page pour prendre en compte les changements ?");
		if (confirmAlert)
		{
			location.reload();
		}
		else
		{
			return;
		};
	};

	displayFormEdit()
	{
		this.formAddArticleContainer.classList.add("invisible");
		this.formEditArticleContainer.classList.remove("invisible");
		this.formEditArticleContainer.scrollIntoView(({behavior: "smooth", block: "end", inline: "nearest"})); 
	}

	displayFormAdd()
	{
		this.formAddArticleContainer.classList.remove("invisible");
		this.formEditArticleContainer.classList.add("invisible");
		this.formAddArticleContainer.scrollIntoView(({behavior: "smooth", block: "end", inline: "nearest"}));
	}

	displayConfirmArticle(i)
	{
		this.articlesContainers[i].classList.add("invisible");
		this.articlesSeparators[i].classList.add("invisible");
	}

	displayConfirmComment(i)
	{
		this.commentsContainers[i].classList.add("invisible");
		this.commentsSeparators[i].classList.add("invisible");
	};

	displayConfirmAdminDeleted(i)
	{
		this.adminsContainers[i + 1].classList.add("invisible");
		this.adminsSeparators[i + 1].classList.add("invisible");
	}

	displayCategories(category)
	{
		this.contents[category].classList.toggle("bigger");
		this.bigArrows[category].classList.toggle("fa-sort-up");
		this.bigArrows[category].classList.toggle("fa-sort-down");
	};

	displaySmallCategories(smallCategory)
	{
		this.smallContents[smallCategory].classList.toggle("bigger");
		this.smallArrows[smallCategory].classList.toggle("fa-sort-up");
		this.smallArrows[smallCategory].classList.toggle("fa-sort-down");
	};

/* -------------------- CONTROLS  -------------------- */

	initControls()
	{
		this.links.forEach(link => 
		{
			link.addEventListener("click", (e) => {e.preventDefault();});
		});

		for (let i = 0; i < this.controllers.length; i++)
		{
			this.controllers[i].addEventListener("click", (e) => 
			{
				this.displayCategories(i);
			});
		};

		for (let i = 0; i < this.smallControllers.length; i++)
		{
			this.smallControllers[i].addEventListener("click", (e) => 
			{
				this.displaySmallCategories(i); 
			});
		};

		this.formAddArticle.addEventListener("submit", (e) =>
		{
			e.preventDefault();
			this.addArticle();
		});

		this.formEditArticle.addEventListener("submit", (e) =>
		{
			e.preventDefault();
			this.editArticle(this.formEditArticle.getAttribute("data-articleID"));
		});

		for (let i = 0; i < this.adminButtonsDeleteComment.length; i++)
		{
			this.adminButtonsDeleteComment[i].addEventListener("click", () =>
			{
				this.deleteComment(this.adminButtonsDeleteComment[i].getAttribute("data-commentID"), i);
			});
		};

		for (let i = 0; i < this.adminButtonsResetComment.length; i++)
		{
			this.adminButtonsResetComment[i].addEventListener("click", () =>
			{
				this.cancelReportComment(this.adminButtonsResetComment[i].getAttribute("data-commentID"), i);
			});
		};

		for (let i = 0; i < this.adminButtonsDelete.length; i++)
		{
			this.adminButtonsDelete[i].addEventListener("click", () =>
			{
				this.deleteAdmin(this.adminButtonsDelete[i].getAttribute("data-adminID"), i);
			});
		};

		this.formAddAdmin.addEventListener("submit", (e) =>
		{
			e.preventDefault();
			this.addAdmin();
		});

		for (let i = 0; i < this.articleButtonsDelete.length; i++)
		{
			this.articleButtonsDelete[i].addEventListener("click", () =>
			{
				this.deleteArticle(this.articleButtonsDelete[i].getAttribute("data-articleID"), i);
			});
		};

		for (let i = 0; i < this.articleButtonsEdit.length; i++)
		{
			this.articleButtonsEdit[i].addEventListener("click", () =>
			{
				this.downloadInfo(this.articleButtonsEdit[i].getAttribute("data-articleID"));
			});
		};

		this.changeModButton.addEventListener("click", (e) => 
		{
			e.preventDefault();
			this.displayFormAdd();
		});
	};
};

let newInterfaceAdmin = new InterfaceAdmin;
newInterfaceAdmin.initControls();