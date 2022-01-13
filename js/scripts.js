$(document).ready(function(){
    $('.menu-toggle').on('click',function(){
        $('.nav').toggleClass('showing');
        $('.nav ul').toggleClass('showing');
        $('.nav ul li ul').toggleClass('showing');
    });
});



const downloadaspdf = document.querySelector(".download-btn");

downloadaspdf.addEventListener("click", () => {
  window.print();
});

