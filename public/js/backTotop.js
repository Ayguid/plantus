// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("backToTop").style.display = "block";
    } else {
        document.getElementById("backToTop").style.display = "none";
    }
}


window.onload = function() {
  var backToTopButton = document.getElementById('backToTop');
  backToTopButton.addEventListener("click", function topFunction() {

    window.scrollTo({
    top: 0,
    behavior: "smooth"});
  });

};
