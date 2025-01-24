/*
=============================================================================================================
Slider controls
=============================================================================================================
*/
jQuery(document).ready(function () {
  jQuery(".slick-wrapper").slick({
    autoplay: true,
    autoplaySpeed: 8000,
    arrows: false,
    pauseOnHover: false,
  });
});
/*
=============================================================================================================
Slider controls
=============================================================================================================
*/
jQuery(document).ready(function () {
  jQuery(".departmentNews").slick({
    autoplay: true,
    autoplaySpeed: 8000,
    arrows: false,
    pauseOnHover: false,
  });
});

/*
=============================================================================================================
Post Featured Gallery Slider controls
=============================================================================================================
*/
jQuery(".featured-for").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: ".featured-nav",
  adaptiveHeight: true,
});
jQuery(".featured-nav").slick({
  slidesToShow: 5,
  slidesToScroll: 1,
  asNavFor: ".featured-for",
  centerMode: true,
  focusOnSelect: true,
});
/*
=============================================================================================================
full Gallery Slider controls
=============================================================================================================
*/
jQuery(".page-gallery-for").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: ".page-gallery-nav",
});
jQuery(".page-gallery-nav").slick({
  slidesToShow: 5,
  slidesToScroll: 1,
  arrows: false,
  asNavFor: ".page-gallery-for",
  centerMode: true,
  focusOnSelect: true,
});

/*
=============================================================================================================
close alert
=============================================================================================================
*/
jQuery("#closeAlert").click(function () {
  jQuery("#alerts").css("display", "none");
});

/*
=============================================================================================================
Directory Live Page Search
=============================================================================================================
*/
jQuery(document).ready(function () {
  jQuery("#filter").keyup(function () {
    // Retrieve the input field text and reset the count to zero
    var filter = jQuery(this).val(),
      count = 0;

    // Loop through the post list
    jQuery(".staff-member-listing .personalvCard").each(function () {
      // If the list item does not contain the text phrase fade it out
      if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
        //jQuery(this).addClass('hide');
        jQuery(this).fadeOut();

        // Show the list item if the phrase matches and increase the count by 1
      } else {
        jQuery(this).show();
        count++;
      }
    });
  });
});
jQuery(document).ready(function () {
  jQuery("#sidebar-filter").keyup(function () {
    // Retrieve the input field text and reset the count to zero
    var filter = jQuery(this).val(),
      count = 0;

    // Loop through the post list
    jQuery(".staff-member-listing .personalvCard").each(function () {
      // If the list item does not contain the text phrase fade it out
      if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
        //jQuery(this).addClass('hide');
        jQuery(this).fadeOut();

        // Show the list item if the phrase matches and increase the count by 1
      } else {
        jQuery(this).show();
        count++;
      }
    });
  });
});
/*
=============================================================================================================
accordion
=============================================================================================================
*/
jQuery(".accordion li").click(function () {
  jQuery(this).toggleClass("active");
});
/*
=============================================================================================================
Auto Link Detection
=============================================================================================================
*/
//first loop to mark list items in the content area
jQuery("#mainContent ul li a:not(:has(img))").each(function () {
  if (jQuery(this).attr("href").match(".pdf")) {
    jQuery(this).parent().addClass("pdf");
  } else if (jQuery(this).attr("href").match(".xls")) {
    jQuery(this).parent().addClass("xls");
  } else if (jQuery(this).attr("href").match("provo.edu")) {
    jQuery(this).parent().addClass("int");
  } else {
    jQuery(this).parent().addClass("ext");
  }
});

//Removes the icon for the directory page
jQuery("#mainContent .personalvCard ul li").each(function () {
  jQuery(this).removeClass("int");
  jQuery(this).removeClass("ext");
  jQuery(this).removeClass("xls");
  jQuery(this).removeClass("pdf");
});
/*
=============================================================================================================
Translation Menu
=============================================================================================================
*/
window.onload = function () {
  var wrapper = document.querySelector(".trp-language-wrap");
  if (wrapper) {
    var newAnchor = document.createElement("a"); // create new anchor element
    newAnchor.href = "https://provo.edu/translations/"; // set href attribute
    newAnchor.textContent = "Request Translation"; // set link text
    wrapper.insertBefore(newAnchor, wrapper.children[1]); //insert new anchor before first child

    var targetElement = wrapper.querySelector(
      ".trp-floater-ls-disabled-language.trp-ls-disabled-language"
    ); // find the target element
    if (targetElement) {
      targetElement.textContent += " - Selected"; // append "current lang" to the existing text
    }
  }
  var parentElement = document.getElementById(
    "trp-floater-ls-current-language"
  ); // get the parent element by ID
  if (parentElement) {
    var targetElement = parentElement.querySelector(
      ".trp-floater-ls-disabled-language.trp-ls-disabled-language"
    ); // find the target element inside the parent
    if (targetElement) {
      var img = document.createElement("img"); // create new img element
      img.src = "https://provo.edu/wp-content/uploads/2024/01/translate.png"; // set src attribute
      img.alt = "Translate"; // set alt attribute
      targetElement.innerHTML = ""; // clear the current content
      targetElement.appendChild(img); // append the new image
    }
  }
};
/*
=============================================================================================================
Collapsible Content
=============================================================================================================
*/
document.addEventListener("DOMContentLoaded", function () {
  var buttons = document.querySelectorAll(".collapsible-button");
  buttons.forEach(function (button) {
    button.addEventListener("click", function () {
      var content = this.nextElementSibling;
      if (content.style.display === "none" || content.style.display === "") {
        content.style.display = "block";
        this.classList.add("exposed");
      } else {
        content.style.display = "none";
        this.classList.remove("exposed");
      }
    });
  });
});
