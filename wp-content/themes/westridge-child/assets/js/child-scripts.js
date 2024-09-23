/*
=============================================================================================================
Teacher Access menu
=============================================================================================================
*/
jQuery(".teacherActivate").click(function() {
	return false;
});
jQuery(".teacherActivate").click(function() {
		if(jQuery("#teacherAccess").css("margin-top") != "-344px") {
			jQuery("#teacherAccess").css("margin-top", "-344px");
			jQuery("#teacherAccess ul").css("display", "block");
		} else {
			jQuery("#teacherAccess").css("margin-top", "-38px");
			jQuery("#teacherAccess ul").css("display", "none");
		}
});
//inserts a link to the translation request form in the language switcher
window.onload = function () {
  var wrapper = document.querySelector(".trp-language-wrap");
  if (wrapper) {
	var newAnchor = document.createElement("a"); // create new anchor element
	newAnchor.href = "https://provo.edu/translations/"; // set href attribute
	newAnchor.textContent = "Request Translation"; // set link text
	wrapper.insertBefore(newAnchor, wrapper.children[1]); //insert new anchor before first child

	var targetElement = wrapper.querySelector(".trp-floater-ls-disabled-language.trp-ls-disabled-language"); // find the target element
	if (targetElement) {
	  targetElement.textContent += " - Selected"; // append "current lang" to the existing text
	}
  }
  var parentElement = document.getElementById('trp-floater-ls-current-language'); // get the parent element by ID
  if (parentElement) {
	var targetElement = parentElement.querySelector('.trp-floater-ls-disabled-language.trp-ls-disabled-language'); // find the target element inside the parent
	if (targetElement) {
	  var img = document.createElement('img'); // create new img element
	  img.src = 'https://provo.edu/wp-content/uploads/2024/01/translate.png'; // set src attribute
	  targetElement.innerHTML = ''; // clear the current content
	  targetElement.appendChild(img); // append the new image
	}
  }
};