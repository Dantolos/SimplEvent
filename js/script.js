jQuery(document).ready(function($){


  //allgemein
  //farben
  var seMC = $('header').attr('semc');
  var seSC = $('header').attr('sesc');
  var seWC = $('header').attr('sewc');


  //info Sidebar
  var iSbO = false;
  var infoSidebarWidth = jQuery('.se-info-sidebar').width();
  var infoBarPos = -Math.abs(infoSidebarWidth);
  jQuery('.se-info-sidebar').css({'right': infoBarPos + 'px' });
  jQuery(window).on('resize', function(){
    infoSidebarWidth = jQuery('.se-info-sidebar').width();
    infoBarPos = -Math.abs(infoSidebarWidth);
    jQuery('.se-info-sidebar').css({'right': infoBarPos + 'px' });
  });

  jQuery('.se_navbar_infobutton').on('click', function(){
    if( ! iSbO ) {
      jQuery('.se-info-sidebar').show();
      jQuery('.se-info-sidebar').animate({ 'right': '0px' });

      iSbO = true;
    } else {

      jQuery('.se-info-sidebar').animate({ 'right': infoBarPos + 'px' });
      jQuery('.se-info-sidebar').fadeOut();
      iSbO = false;
    }

  });

  //Social Media Icons
  var SMIcon = $('.se-sm-icon-anim');
  SMiconAnim(SMIcon);
  $( document ).ajaxComplete(function(){
    SMiconAnim($('.se-sm-icon-anim'));
  });
  function SMiconAnim(e) {
    e.on('mouseenter', function(){
      TweenMax.to($(this), 0.5, {scale: 1.2, ease:Power1.easeOut});
    }).on('mouseleave', function() {
      TweenMax.to($(this), 0.5, {scale: 1, ease:Power1.easeOut});
    });
  }


  //--linkicon
  LinkIconAnim();
  $( document ).ajaxComplete(function(){
    LinkIconAnim();
  });
  function LinkIconAnim() {
    let LinkIcon = $('.se-link');
    let LinkIconArrow = LinkIcon.find('.se-arrow');
    let LinkIconArrowNE = LinkIcon.find('.se-arrow-n');
    LinkIcon.find('path').css({'fill': seMC});
    TweenMax.set(LinkIconArrowNE, { x: -40 });

    LinkIcon.on('mouseover', function(){
      let ThisLinkIconArrow = $(this).find('.se-arrow');
      let ThisLinkIconArrowNE = $(this).find('.se-arrow-n');
      TweenMax.to(ThisLinkIconArrow, 0.3, {x: 40});
      TweenMax.to(ThisLinkIconArrowNE, 0.3, {x: 0});
    });
    LinkIcon.on('mouseout', function(){
      let ThisLinkIconArrow = $(this).find('.se-arrow');
      let ThisLinkIconArrowNE = $(this).find('.se-arrow-n');
      TweenMax.to(ThisLinkIconArrow, 0.3, {x: 0});
      TweenMax.to(ThisLinkIconArrowNE, 0.3, {x: -40});
    });
  }


  //--downloadicon
  let DLicon = $('.se-dnl');
  let DLiconBar = DLicon.find('.load');
  let DLiconTL;
  TweenMax.set(DLiconBar, {autoAlpha: 1});

  function DLtimeline(e) {
    e = e.find('.load');
    DLiconTL = new TimelineMax({paused:true, onComplete:function() {
      this.restart()}
    });
    DLiconTL.staggerTo(e, 0.05, {autoAlpha: 0, ease:Power1.easeOut}, 0.05)
            .staggerTo(e, 0.05, {autoAlpha: 1, ease:Power1.easeOut}, 0.05);
  }


  DLicon.on('mouseover', function(){
    DLtimeline($(this));
    DLiconTL.play();
    $(this).find('path').css({'fill': seMC});
    $(this).find('polygon').css({'fill': seMC});
    $(this).find('.se-dnl-text').removeClass('se-wc-txt');
    $(this).find('.se-dnl-text').addClass('se-mc-txt');
  });
  DLicon.on('mouseout', function(){
    DLiconTL.stop();
    TweenMax.set(DLiconBar, {autoAlpha: 1});
    $(this).find('path').css({'fill': 'dedede'});
    $(this).find('polygon').css({'fill': 'dedede'});
    $(this).find('.se-dnl-text').removeClass('se-mc-txt');
    $(this).find('.se-dnl-text').addClass('se-wc-txt');
  });

  //header
  var headerElement = $('.se-navbar-container');
  var headerPH = $('.header-placeholder');
  var HeaderBig = true;

  var HeaderLogo = $('.se-header-logo');
  var HeaderIcon = $('.se-header-icon');
  var HeaderTL = new TimelineMax({paused:true});
  TweenMax.set(HeaderIcon, {autoAlpha: 0, y: '-50px'});
  HeaderTL.to(HeaderLogo, 0.2, { autoAlpha: 0, y: '-50px',  display:'none', ease:Power1.easeOut})
          .to(HeaderIcon, 0.2, { autoAlpha: 1, y: '0px',  display:'block', ease:Power1.easeOut});
  $(window).scroll(function(){
    var scrollPos = $(document).scrollTop();

    if(scrollPos > 50 && HeaderBig == true) {
      HeaderMin();
      HeaderBig = false;

    } else if(scrollPos < 20 && HeaderBig == false) {
      HeaderMax();
      HeaderBig = true;
    } else {

    }

  });

  function HeaderMin() {
    headerElement.animate({'height': '40px'}, 100);
    headerPH.animate({'height': '40px'});
    $('.se-more-events-button').animate({'margin-top': '8px'});
    $('.se-subnav-container').animate({'top': '40px'});
    $('.se-more-events-container').animate({'top': '40px'});
    $('.se-info-sidebar').animate({'margin-top': '40px'});
    $('.se-navbar-language').hide();
    HeaderTL.play();
  }

  function HeaderMax() {
    headerElement.animate({'height': '120px'});
    headerPH.animate({'height': '120px'});
    $('.se-more-events-button').animate({'margin-top': '50px'});
    $('.se-subnav-container').animate({'top': '120px'});
    $('.se-more-events-container').animate({'top': '120px'});
    $('.se-info-sidebar').animate({'margin-top': '120px'});
    $('.se-navbar-language').fadeIn();
    HeaderTL.reverse();
  }


  //LAYOUT Column-Height
  var allColumns = jQuery('.se-col-1, .se-col-2, .se-col-3, .se-col-4, .se-col-5, .se-col-6, .se-col-7, .se-col-8, .se-col-9, .se-col-10, .se-col-11, .se-col-12' );
  var arrP =[];
  var checkArr = [];
  allColumns.each(function(){
    cP = $(this).parent();
    if ( checkArr.indexOf(cP[0]) == -1 ) {
      arrP.push(cP);
      checkArr.push(cP[0]);
    }
  });
  var tempID = 0;
  var heightarr = [];
  jQuery.each(arrP, function(){

    cE = jQuery(this).find(allColumns);
    var heighest = 0;
    var colMax = 0;

    cE.each(function(){
      if ( colMax === 12 ) {
        tempID++;
        colMax = 0;
        heighest = 0;
      }
      jQuery(this).attr('tempID', tempID);
      className = jQuery(this).attr('class').split(' ');
      colCount = parseInt(className[0].replace('se-col-', ''));
      colMax = colMax + colCount;

      actHeight = jQuery(this).innerHeight();
      if ( actHeight > heighest ) {
        heighest = actHeight;
        hd1 = heighest;
      }
      if ( colMax === 12 ) {
        heightarr.push(heighest);
      }
    });

    cE.each(function(){
      tI = jQuery(this).attr('tempID');
      $(this).css({'height': heightarr[tI] });
    });

    tempID++;
  });

  $(window).on('resize', function(){
    allColumns.each(function(){
      cP = $(this).parent();
      if ( checkArr.indexOf(cP[0]) == -1 ) {
        arrP.push(cP);
        checkArr.push(cP[0]);
      }
    });
    var tempID = 0;
    var heightarr = [];
    jQuery.each(arrP, function(){

      cE = jQuery(this).find(allColumns);
      var heighest = 0;
      var colMax = 0;

      cE.each(function(){
        if ( colMax === 12 ) {
          tempID++;
          colMax = 0;
          heighest = 0;
        }
        jQuery(this).attr('tempID', tempID);
        className = jQuery(this).attr('class').split(' ');
        colCount = parseInt(className[0].replace('se-col-', ''));
        colMax = colMax + colCount;

        actHeight = jQuery(this).innerHeight();
        if ( actHeight > heighest ) {
          heighest = actHeight;
          hd1 = heighest;
        }
        if ( colMax === 12 ) {
          heightarr.push(heighest);
        }34
      });

      cE.each(function(){
        tI = jQuery(this).attr('tempID');
        jQuery(this).css({'height': heightarr[tI] });
      });

      tempID++;
    });
  });

  //GSAP SELoader
  var dots = $('#Ebene_1 circle')
      tlLoad = new TimelineMax({repeat:-1});

  tlLoad
    .staggerTo(dots, 0.3, {y: '-6px', fill: '#dedede', stroke: '#dedede',  scale: 1.2, ease:Power1.easeIn}, 0.2)
    .staggerTo(dots, 0.3, {y: '0px', fill: '#fff', stroke: '#dedede',   scale: 1, ease:Power1.easeOut}, 0.2, "-=0.5");


  //BUTTONS
  //Negative Logos
  var negBtn = $('.mc-button-neg, .mc-button-neg-icon');
  $( document ).ajaxComplete(function(){
    var negBtn = $('.mc-button-neg, .mc-button-neg-icon');
    negBtn.hover(function(){
      TweenMax.to($(this), 0.2, {'border-radius': '10px', y: '-2px', ease:Power1.easeInOut});
    }, function(){
      TweenMax.to($(this), 0.4, {'border-radius': '20px', y: '0px', ease:Power1.easeInOut});
    });
  });
  negBtn.hover(function(){
    TweenMax.to($(this), 0.2, {'border-radius': '10px', y: '-3px', ease:Power1.easeInOut});
  }, function(){
    TweenMax.to($(this), 0.4, {'border-radius': '20px', y: '0px', ease:Power1.easeInOut});
  });


  //Layout Sessions
  $('.se-strip-session').each(function(){
    let Sheight = $(this).find('.se-session-txt').innerHeight() + 50;
    if(Sheight < 500){
      Sheight = 500;
    }
    $(this).css({'height': Sheight + 'px'});
    $(this).find('.se-picture-session').css({'height': Sheight + 'px'});
  });

  $(window).on('resize', function(){
    $('.se-strip-session').each(function(){
      let Sheight = $(this).find('.se-session-txt').innerHeight() + 50;
      if(Sheight < 500){
        Sheight = 500;
      }
      $(this).css({'height': Sheight + 'px'});
      $(this).find('.se-picture-session').css({'height': Sheight + 'px'});
    });
  });

  $( document ).ajaxComplete(function(){
    $('.se-strip-session').each(function(){
      let Sheight = $(this).find('.se-session-txt').innerHeight() + 50;
      if(Sheight < 500){
        Sheight = 500;
      }
      $(this).css({'height': Sheight + 'px'});
      $(this).find('.se-picture-session').css({'height': Sheight + 'px'});
    });
  });

  //NAVBAR MENU

  //navipunkte
  //var navPos = jQuery('#NAVaktuell').position('left');
  //var navWidth = jQuery('#NAVaktuell').innerWidth();
  //jQuery('.nav-layer').css({'width': navWidth });
  //jQuery('#NAVaktuell').removeClass('aagi-wc-txt').addClass('aagi-w-txt');
  jQuery('.se-main-navi').mouseover(function(){
    jQuery('.nav-layer').fadeIn();
  }).mouseleave(function(){
    jQuery('.nav-layer').fadeOut();
  });
  function navBGslide( e ) {
    navPos = jQuery(e).position().left;
    navWidth = jQuery(e).innerWidth();
    jQuery('.aagi-navbar-menu-point').removeClass('aagi-w-txt').addClass('aagi-wc-txt');
    jQuery('.nav-layer').stop().animate({'width': navWidth, 'left': navPos }, 300);
    jQuery(e).removeClass('aagi-wc-txt').addClass('aagi-w-txt');
  }

  $('.se-main-navi').find('a').mouseover(function(){
    navBGslide($(this));
  });

  //subnav
  var navEle = $('a.se-navelement');
  var subEle = $('.se-subnav-container');
  TweenMax.set(subEle, {x: '100px',autoAlpha: 0});
  navEle.on('click', function(){
    var navID = $(this).attr('nav');
    var subNav = $('.se-subnav-container[subnav="'+navID+'"]');
    var subNavTL = new TimelineMax();

    subNavTL.to(subEle, 0.2, {x: '100px',autoAlpha: 0, ease: Power1.easeInOut})
            .to(subNav, 0.2, {x: '0px', autoAlpha: 1, ease: Power1.easeInOut});
  });








  //----------------------------------------------------
  //----speaker-----------------------------------------
  //----------------------------------------------------

  //// REVIEW:
  //video
  let revVID = $('.se-speaker-review-video');
  revVID.css({'height': (revVID.innerWidth() / 16 * 9) + 'px' });
  $(document).ajaxComplete(function(){
    revVID = $('.se-speaker-review-video');
    revVID.css({'height': (revVID.innerWidth() / 16 * 9) + 'px' });
  });
  //gallery
  let revIMG = $('.se-gallery-pic');
  revIMG.css({'width': (100 / revIMG.length) + '%' });
  revIMG.on('click', function(){
    reviewGallery($(this));
  });

  $(document).ajaxComplete(function(){
    revIMG = $('.se-gallery-pic');
    revIMG.css({'width': (100 / revIMG.length) + '%' });
    revIMG.on('click', function(){
      reviewGallery($(this));
    });
  });

  function reviewGallery(b) {
    revIMG.each(function(){
      if($(this).attr('counter') !== b.attr('counter')) {
        $(this).animate({'width': (29.9 / (revIMG.length - 1)) + '%' });
        $(this).css({'opacity': '0.2'});
        }
    });
    b.css({'opacity': '1'});
    b.animate({'width': '70%'});
  }


  //----------------------------------------------------
  //----partner-----------------------------------------
  //----------------------------------------------------
  var pLogo = $('.se-partner-logo');

  pLogo.css({'height': (pLogo.width() / 10 * 9) });
  $(window).on('resize', function(){ pLogo.css({'height': (pLogo.width() / 10 * 9) }) });

  TweenMax.staggerFrom(pLogo, 0.5, {y: '30px', autoAlpha: '0', ease:Power1.easeOut}, 0.1);


  //----------------------------------------------------
  //----programm-----------------------------------------
  //----------------------------------------------------
  var prigrammLines = $('.se-programm-row');
  var programmLink = $('.se-programm-row').find('img');
  TweenMax.staggerFrom(prigrammLines, 0.5, {y: '300px', autoAlpha: '0', ease:Power1.easeOut}, 0.1);
  TweenMax.set(programmLink, {autoAlpha: '0', x: '5px'})
  prigrammLines.mouseenter(function(){
    TweenMax.to($(this), 0.2, {x: '0px', scale: 0.99, ease:Power1.easeOut});
    programmLink = $(this).find('img');
    TweenMax.to(programmLink, 0.7, {x: '0', autoAlpha: '1', ease:Power1.easeOut});
  }).mouseleave(function(){
    TweenMax.to($(this), 0.2, {x: '0px', scale: 1, ease:Power1.easeOut});
    TweenMax.to(programmLink, 0.2, {autoAlpha: '0', x: '5px'});
  });

  //----------------------------------------------------
  //----Award-----------------------------------------
  //----------------------------------------------------

  var awarContainer = $('.se-award-jahr-container');
  var awardBox = $('.se-award-box-container');

  var awardBoxHeight = awardBox.innerWidth() / 100 * 85;

  awardBox.css({'height': awardBoxHeight});
  awarContainer.css({'height': awardBoxHeight + 20 });
  $(window).on('resize', function(){
    awardBoxHeight = awardBox.innerWidth() / 100 * 85;
    awardBox.css({'height': awardBoxHeight});
    awarContainer.css({'height': awardBoxHeight + 20 });
  });


  //overlay
  var awardInfoContainer = $('.se-award-info-container');
  var awardInfoTL = new  TimelineMax({paused:true});

  TweenMax.set(awardInfoContainer, {y: '500px', autoAlpha: '0'});

  awardBox.mouseenter(function(){
    TweenMax.to($(this).find('.se-award-info-container'), 0.5, {y: '0', autoAlpha: '1'});
  }).mouseleave(function(){
    TweenMax.to($(this).find('.se-award-info-container'), 0.5, {y: '500px', autoAlpha: '0'});
  });

  //----------------------------------------------------
  //----Footer-----------------------------------------
  //----------------------------------------------------
  function doFooterPosition() {
    let footerPos = $('.se-footer-container').offset().top;
    let windowHeight = $(window).height();
    if(windowHeight > footerPos){
      $('.se-footer-container').css({'position': 'fixed', 'bottom':0});
    }
  }
  doFooterPosition();
  // $(window).on('resize', function(){ doFooterPosition();});
   $( document ).ajaxStop(function(){ doFooterPosition(); });
});

//JS------
