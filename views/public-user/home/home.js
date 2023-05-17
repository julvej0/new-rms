// animate when scroll
document.addEventListener('DOMContentLoaded', function() {
    var animatedCards = document.querySelectorAll('.card-container');
    var animated = false;

    function animateOnScroll() {
        var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        var windowHeight = window.innerHeight;

        animatedCards.forEach(animateCard => {
            if (!animated && scrollTop + windowHeight >= animateCard.offsetTop) {
                animateCard.classList.add('animate__animated', 'animate__fadeIn');
                animated = true;
            }
        })
    }
    window.addEventListener('scroll', animateOnScroll);
});