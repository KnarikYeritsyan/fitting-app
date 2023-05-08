let n = document.getElementById("top__bar");

// console.log(window.scrollX, window.scrollY, window.scrollbars)

document.addEventListener('scroll', function(e) {

    if (window.scrollY > 20 ) {

        n.classList.add("active");

    } else {
        n.classList.remove("active");
    }

});

let x = document.getElementById("check__menu");
let y = document.getElementById("top__bar");


x.addEventListener('click', () => {
    if (x.checked) {
        y.style.cssText = 'position:fixed; background: rgba(79, 63, 102, 0.9);';
    }

    else {
        y.style.cssText = 'position:static; background: none;';
    }



});



// let toggle = document.getElementById('container');
// let toggleContainer = document.getElementById('toggle-container');
// let toggleNumber;
//
// toggle.addEventListener('click', function() {
//     toggleNumber = !toggleNumber;
//     if (toggleNumber) {
//         toggleContainer.style.clipPath = 'inset(0 0 0 50%)';
//         toggleContainer.style.backgroundColor = '#D74046';
//     } else {
//         toggleContainer.style.clipPath = 'inset(0 50% 0 0)';
//         toggleContainer.style.backgroundColor = 'dodgerblue';
//     }
//     console.log(toggleNumber)
// });


// $(window).on("load resize ", function() {
//     var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
//     $('.tbl-header').css({'padding-right':scrollWidth});
// }).resize();


// if (!x.checked) {
//     console.log('yoh')
// }


// $('a.active').parents('li').css('color', 'red');

//.multiselect:has(input:checked) .btn-reset {
//     display: block;
// }

//|| (window).width() <= 360
//window.scroll,window.scrollBy,window.scrollTo,


