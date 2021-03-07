function formSubmit(event) {
  event.preventDefault();
  var url = "mJSterm.php";
  var request = new XMLHttpRequest();
  var imgMAPInputEle = document.getElementById('Terminal');
  var FormTargetEle = document.getElementById('TermResponce');
  request.open('POST', url, true);
  request.onload = function() { // request successful
  // we can use server response to our request now
//    console.log(request.responseText);
    FormTargetEle.srcdoc = request.responseText;
  };

  request.onerror = function() {
    // request failed
	alert('POST FAILED, TERMINAL BROKEN.');
	return false;
  };

  request.send(new FormData(document.forms.mJSterm)); // create FormData from form that triggered event
 // document.getElementById('Terminal').value
  console.log("Terminal Interaction");
//  FormTargetEle.srcdoc = request.responseText;
//	alert('POST SENT.');

  return false;
}

// and you can attach form submit event like this for example
function attachFormSubmitEvent(formId){
  document.getElementById(formId).addEventListener("submit", formSubmit);
}
