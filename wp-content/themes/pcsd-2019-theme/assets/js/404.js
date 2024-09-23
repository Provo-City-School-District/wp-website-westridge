//Make Array with All images
var imagesArray = new Array();
	imagesArray[0] = 'https://globalassets.provo.edu/image/404/404error1.jpg';
	imagesArray[1] = 'https://globalassets.provo.edu/image/404/404error2.jpg';
	imagesArray[2] = 'https://globalassets.provo.edu/image/404/404error3.jpg';
	imagesArray[3] = 'https://globalassets.provo.edu/image/404/404error4.jpg';
	imagesArray[4] = 'https://globalassets.provo.edu/image/404/404error5.jpg';


	var num = Math.floor(Math.random() * 5);
	document.getElementById("image404").src = imagesArray[num];
