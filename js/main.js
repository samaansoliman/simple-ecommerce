let landingPage = document.querySelector(".landing-page");
let imagesArray = ["1.jpeg","2.jpg","3.png","4.jpg","6.jpg","7.jpeg","8.jpeg","9.jpeg","9.jpeg","9.jpeg","10.jpeg","11.jpeg","12.jpeg","13.jpeg","14.jpeg","15.jpeg","16.jpeg","17.jpeg","18.jpeg"];

setInterval(() => {

    let radomNumber = Math.floor(Math.random() * imagesArray.length);
    landingPage.style.backgroundImage ='url("images/' + imagesArray[radomNumber] + '")';

}, 5000);