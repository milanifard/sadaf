// get interface from ajax page by sending parameter and show it in a modal form
// ModalID should start with # eg: #MySpanID
function ShowDetailsInModal(AjaxFileName, ModalID, ModalTitle, ModalContentSpanID, ModalHeaderID, ParameterName, uid)
{
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById(ModalContentSpanID).innerHTML = this.responseText;
			document.getElementById(ModalHeaderID).innerHTML = ModalTitle;
			$(ModalID).modal();
		}
	};
	xmlhttp.open("GET", AjaxFileName+"?"+ParameterName+"="+uid, true);
	xmlhttp.send(); 
}

// get interface from ajax page by sending two parameters and show the result it in a modal form
// ModalID should start with # eg: #MySpanID
function DoActionAndRefreshModal(AjaxFileName, ModalID, ModalTitle, ModalContentSpanID, ModalHeaderID, ParameterName, uid, ActionParamName, ActionParamID)
{
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById(ModalContentSpanID).innerHTML = this.responseText;
			document.getElementById(ModalHeaderID).innerHTML = ModalTitle;
			$(ModalID).modal();
		}
	};
	xmlhttp.open("GET", AjaxFileName+"?"+ParameterName+"="+uid+"&"+ActionParamName+"="+ActionParamID, true);
	xmlhttp.send(); 
}

