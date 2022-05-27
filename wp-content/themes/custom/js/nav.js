
jQuery(document).ready(function ($) {

  //add down chevron to header section
  let firstID = jQuery('.entry-title')[0].id;
  jQuery('.header-widget').append(`<a id="opening-chevron" href="#${firstID}"><i class="fa fa-chevron-down"></i>`)

  //add class to any element that should be animated to rise
  jQuery('.entry-content, figure, #side-graphic').addClass('animate-rise')

  //smooth scroll to section
  $('a[href^="#"]').on('click', function (e) {
    e.preventDefault()
    console.log('clicked', $(this).attr('href'))
    var navHeight = $('nav').height()
    var sectionScroll = $(this).attr('href')
    var offsetHeight = $(sectionScroll)[0].offsetTop
    window.scroll({ top: (offsetHeight - navHeight), left: 0, behavior: 'smooth' });
  }); 
  
  //scrollspy for active class on nav links
  var mainNavLinks = document.querySelectorAll("#menu-primary li a");
  window.addEventListener("scroll", function(){
    var navHeightScroll = $('nav').height();
    var fromTop = window.scrollY + navHeightScroll + 1;
    mainNavLinks.forEach(link =>{
      var section = document.querySelector(link.hash);
      var liElement = link.closest('li');
      var container = $('#'+section.id).closest('article')[0].offsetHeight;
      if(section.offsetTop <= fromTop && section.offsetTop + container > fromTop) {
        liElement.classList.add("active");
      } else {
        liElement.classList.remove("active");
      }
    })
    //update class on navbar when first section reached
    var header = $('.site-header').height()
    if(header < window.scrollY){
      $('nav').addClass('inplay');
      $('.header-widget').addClass('below-header');
    }else{
      $('nav').removeClass('inplay');
      $('.header-widget').removeClass('below-header');
    }
    //animation for section rise
    let bottomToTop = jQuery(window).height() + jQuery(window).scrollTop();
    let riseAnimated = document.querySelectorAll('.animate-rise')
    var i = 0;
    while(i<riseAnimated.length){
      let sectionAnimated = riseAnimated[i].offsetTop;
      if(sectionAnimated + 180 < bottomToTop ){
        riseAnimated[i].classList.add('current');
        i++;
      }else{
        return;
      }
    }
  })
});
// //top of element to top of document
// jQuery('.entry-content')[0].offsetTop
// (js) document.querySelectorAll("#welcome").offetTop

// //height of element
// jQuery('.entry-content')[0].offsetHeight

// //height of viewport
// jQuery(window).height()
// (js) window.innerHeight

// //height of entire document
// jQuery(document).height()

// //top of viewport to top of document
// jQuery(window).scrollTop()
// (js) window.pageYOffset

// //bottom of viewport tp top of documment
// jQuery(window).height() + jQuery(window).scrollTop() 

