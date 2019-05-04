/**
 * A class to manage the Ajax requests
 */

class Ajax
{
	constructor()
	{
		this.messageConfirmation = null;
		this.messageErreur = null;
	};

	sendData(url, data, callback)
	{
		var req = new XMLHttpRequest();
    	req.open ("POST", url);
    	req.addEventListener("load", () => { 
			callback(req.responseText);
		});
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		req.send(data);
	};
};