jQuery(document).ready(function($){


  //allgemein

  //mobile detect
  var isMobile = false; //initiate as false
  // device detection
  if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
      || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
      isMobile = true;
  }

  //embed detect
  $.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
      return null;
    }
    else{
      return results[1] || 0;
    }
  }
  var seEmbed = ($.urlParam('seembed') == '1') ? true : false;
  console.log(seEmbed);
  //farben
  var seMC = $('header').attr('semc');
  var seSC = $('header').attr('sesc');
  var seWC = $('header').attr('sewc');

  //animation on site-load
  $(document).ready(function(){
    var SEInhalt = $('#se-site-loader');
    SEInhalt.css({'opacity': 1});
    console.log(detectIE());
    if(!detectIE()){
      TweenMax.staggerFrom(SEInhalt, .3, {autoAlpha: 0, y: '150', ease:Power1.easeOut}, .2);
    } else {
      var browserText = 'Internet Explorer wird nicht mehr unterstützt.';
      var browserTextIE = 'Als Alternative können wir folgende kostenlose Browser empfehlen: Google Chrome, Opera, Mozilla Firefox';
      $('#se-site-loader').css({'opacity': '1'});
      $('#se-site-loader').html('<div style="height:80vh; margin:0 20%;"><h1 style="position:absolute; margin:auto;">' + browserText + '</h1><p>' + browserTextIE + '</p></div>');
     
    }
    
  });

  //info Sidebar
  var iSbO = false;
  var infoBarTrigger = $('.se-info-sidebar-trigger');
  var infoBar = $('.se-info-sidebar');
  var infoSidebarWidth = infoBar.width();
  var infoBarPos = -Math.abs(infoSidebarWidth);
  //$('.se-info-sidebar').css({'right': infoBarPos + 'px' });
  TweenMax.set(infoBar, { x: infoSidebarWidth });
  $(window).on('resize', function(){
    infoSidebarWidth = infoBar.width();
    infoBarPos = -Math.abs(infoSidebarWidth);

    TweenMax.set(infoBar, { x: infoSidebarWidth });
    return infoSidebarWidth;

  });

  $('.se_navbar_infobutton').on('click', function(){
    OpenInfoBar()
  });
  infoBarTrigger.on('click', function(){
    OpenInfoBar()
  });

  function OpenInfoBar() {
    if( ! iSbO ) {
      infoBar.show();
      TweenMax.to($('.se-info-sidebar'), 0.5, {x: 0, ease:Power1.easeOut});
      TweenMax.to(infoBarTrigger, 0.5, {x: infoBarPos, ease:Power1.easeOut});
      TweenMax.to(infoBarTrigger.find('svg'), 0.7, {rotationY:'+=180', ease:Power1.easeOut});
      iSbO = true;
    } else {
      TweenMax.to(infoBar, 0.5, {x: infoBar.width(), ease:Power1.easeOut});
      TweenMax.to(infoBarTrigger, 0.5, {x: 0, ease:Power1.easeOut});
      TweenMax.to(infoBarTrigger.find('svg'), 0.7, {rotationY:'+=180', ease:Power1.easeOut});
      iSbO = false;
    }
  }

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

  //BM - menuburger Animation
  let BMcntA = 0;
  let BMcntB = 0;
  function BurgerMenuAnimation(e, count){
    var BMstroke = [];
    let BMcc = 2;

    let BMstrokeRev = BMstroke.reverse()
    let BMcloser = e.find('.se_BMstroke[LID="3"]');
    TweenMax.set(BMcloser, ({ y: '-10'}))

    while (BMcc >= 0) {
      BMstroke.push(e.find('.se_BMstroke[LID="'+BMcc+'"]'));
      BMcc--;
    }
    if(count%2 == 0) {
      TweenMax.staggerTo(BMstroke.reverse(), 0.6, {y:'20', ease:Power1.easeInOut}, 0.1);
      TweenMax.to(BMcloser, 0.8, ({ y: '0', ease:Power1.easeInOut}));
    } else {
      TweenMax.to(BMcloser, 0.6, ({ y: '-10', ease:Power1.easeOut}));
      TweenMax.staggerTo(BMstroke.reverse(), 0.6, {y:'0', ease:Power1.easeInOut}, 0.1);
    }
  }

  $('.se-partner-dropdown').on('click', function(){
    BurgerMenuAnimation($(this), BMcntA);
    BMcntA++;
  });

  $('.se-navbar-mainmenu-mobile-burger').on('click', function(){
    BurgerMenuAnimation($(this), BMcntB);
    BMcntB++;
  });

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
  DLicon.find('path').css({'fill': seMC});
  DLicon.find('polygon').css({'fill': seMC});
  $( document ).live(function(){
    DLicon.find('path').css({'fill': seMC});
    DLicon.find('polygon').css({'fill': seMC});
  });

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
  });
  DLicon.on('mouseout', function(){
    DLiconTL.stop();
    TweenMax.set(DLiconBar, {autoAlpha: 1});
  });

  //header
  var headerElement = $('.se-navbar-container');
  var headerPH = $('.header-placeholder');
  var HeaderBig = true;

  var HeaderLogo = $('.se-header-logo');
  var HeaderIcon = $('.se-header-icon');
  var HeaderTL = new TimelineMax({paused:true});

  if(!isMobile){ TweenMax.set(HeaderIcon, {autoAlpha: 0, y: '-50px'}); }

  HeaderTL.to(HeaderLogo, 0.2, { autoAlpha: 0, y: '-50px',  display:'none', ease:Power1.easeOut})
          .to(HeaderIcon, 0.2, { autoAlpha: 1, y: '0px',  display:'block', ease:Power1.easeOut});
  if(!isMobile){ //if mobile dont wrap header

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
  }
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
  var allColumns = $('.se-col-1, .se-col-2, .se-col-3, .se-col-4, .se-col-5, .se-col-6, .se-col-7, .se-col-8, .se-col-9, .se-col-10, .se-col-11, .se-col-12' );
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

  if (!isMobile) {
    $.each(arrP, function(){

      cE = $(this).find(allColumns);
      var heighest = 0;
      var colMax = 0;

      cE.each(function(){
        if ( colMax === 12 ) {
          tempID++;
          colMax = 0;
          heighest = 0;
        }
        $(this).attr('tempID', tempID);
        className = $(this).attr('class').split(' ');
        colCount = parseInt(className[0].replace('se-col-', ''));
        colMax = colMax + colCount;

        actHeight = $(this).innerHeight();
        if ( actHeight > heighest ) {
          heighest = actHeight;
          hd1 = heighest;
        }
        if ( colMax === 12 ) {
          heightarr.push(heighest);
        }
      });

      cE.each(function(){
        tI = $(this).attr('tempID');
        $(this).css({'height': 'auto' }); //heightarr[tI]
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
      $.each(arrP, function(){

        cE = $(this).find(allColumns);
        var heighest = 0;
        var colMax = 0;

        cE.each(function(){
          if ( colMax === 12 ) {
            tempID++;
            colMax = 0;
            heighest = 0;
          }
          $(this).attr('tempID', tempID);
          className = $(this).attr('class').split(' ');
          colCount = parseInt(className[0].replace('se-col-', ''));
          colMax = colMax + colCount;

          actHeight = $(this).innerHeight();
          if ( actHeight > heighest ) {
            heighest = actHeight;
            hd1 = heighest;
          }
          if ( colMax === 12 ) {
            heightarr.push(heighest);
          }
        });

        cE.each(function(){
          tI = $(this).attr('tempID');
          $(this).css({ 'height': 'auto' }); //heightarr[tI]
        });

        tempID++;
      });
    });

  }

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
  function sessionResizing() {
    $('.se-strip-session').each(function(){
      let Sheight = $(this).find('.se-session-txt').innerHeight() + 50;
      if(Sheight < 500){
        Sheight = 500;
      }
      if(isMobile){
        Sheight = Sheight + 250;
      }
      $(this).css({'height': Sheight + 'px'});
      if(isMobile){
        Sheight = 200;
      }
      $(this).find('.se-picture-session').css({'height': Sheight + 'px'});
    });
  }
  sessionResizing();

  $( window ).on('resize', function(){
    sessionResizing();
  });

  $( document ).ajaxComplete(function(){
    sessionResizing();
  });

  //NAVBAR MENU

  //navipunkte
  $('.se-main-navi').mouseover(function(){
    $('.nav-layer').fadeIn();
  }).mouseleave(function(){
    $('.nav-layer').fadeOut();
  });

  var curr = false
  function navBGslide( e, curr ) {
    if( !curr ) {
      navPos = $(e).position().left;
      navWidth = $(e).innerWidth();
      $('.nav-layer').stop().animate({'width': navWidth, 'left': navPos }, 300);
    } else { //for current menu unterstrichen
      navPos = $(e).position().left;
      navWidth = $(e).innerWidth();
      $('.curr-nav-layer').css({'width': navWidth, 'left': navPos, 'display': 'block' });
    }
  }

  $('.se-main-navi').find('a').mouseover(function(){
    navBGslide($(this));
  });

  //subnav
  var navEle = $('a.se-navelement');
  var subEle = $('.se-subnav-container');
  TweenMax.set(subEle, {y: '-15px', scaleY: '0', 'overflow': 'hidden'});
  navEle.on('click', function(){
    var posSubNav = $(this).offset();

    var navID = $(this).attr('nav');
    var subNav = $('.se-subnav-container[subnav="'+navID+'"]');
    var posSubNav = parseInt(posSubNav.left) + 20;

    var subNavTL = new TimelineMax();

    subNavTL.to(subEle, 0.2, {y: '-15px', scaleY: '0',autoAlpha: 0, ease: Power1.easeInOut})
            .to(subNav, 0.2, {y: '0px', scaleY: '1', autoAlpha: 1, ease: Power1.easeInOut});
  });

  subEle.find('a').each(function() {
    var e;
    if( $(this).attr('href') == window.location.href){
      navBGslide( $('.se-navelement[nav="'+$(this).attr('parent')+'"]'), true );
      $(this).css({'font-weight': 700});
      TweenMax.to($(this).parent(), 0.2, {y: '0px', scaleY: '1', autoAlpha: 1});
    } else if (e) {
      console.log(window.location.href);
      navBGslide( $('.se-navelement[href="'+ window.location.href +'"]'), true );
    }
  });


 
  
  

  //----------------------------------------------------
  //----speaker-----------------------------------------
  //----------------------------------------------------

  //// REVIEW: 
  //review tabber
  var ReviewTabber = $('.se-speaker-review-tabs-container');
    
  ReviewTabber.live('click', function(){
    ScrolltoReview($(this));
  });

  function ScrolltoReview(e) {
    var curPosTab = e.position().top - 120;
    window.scroll({
      top: curPosTab,
      behavior: 'smooth'
    });
  }

  //change Tabs
    $(document).ajaxComplete(function(){
    changeTab();
  });

  changeTab();

  function changeTab() {
    let Tabs = $('.se-speaker-review-tabs');
    Tabs.on('click', function() {
      let ClickedTab = $(this).attr('revcon');
      $('.se-speaker-review').hide();
      $('.se-speaker-review-tabs').css({'opacity': '.8' });
      $('.se-speaker-review[revcon="'+ClickedTab+'"]').show();
      $('.se-speaker-review-tabs[revcon="'+ClickedTab+'"]').css({'opacity': '1' });
    });
  }


  //video
  let revVID = $('.se-speaker-review-video');
  revVID.css({'height': (revVID.innerWidth() / 16 * 9) + 'px' });
  $(document).ajaxComplete(function(){
    revVID = $('.se-speaker-review-video');
    revVID.css({'height': (revVID.innerWidth() / 16 * 9) + 'px' });
  });

  //gallery
  if(!isMobile){
    let revGalContainer = $('.se-gallery-container');

    revGalContainer.each(function(){
      let revIMG = $(this).find('.se-gallery-pic');
      revIMG.css({'width': (100 / revIMG.length) + '%' });
      revIMG.on('click', function(){
        reviewGallery($(this), revIMG);
      });
    });


    $(document).ajaxComplete(function(){
      let revGalContainer = $('.se-gallery-container');

      revGalContainer.each(function(){
        var revIMG = $(this).find('.se-gallery-pic');
        revIMG.css({'width': (100 / revIMG.length) + '%' });
        revIMG.on('click', function(){
          reviewGallery($(this), revIMG);
        });
      });
    });

    function reviewGallery(b, img) {
      img.each(function(){
        if($(this).attr('counter') !== b.attr('counter')) {
          $(this).animate({'width': (29.9 / (img.length - 1)) + '%' });
          $(this).css({'opacity': '0.2'});
        }
      });
      b.css({'opacity': '1'});
      b.animate({'width': '70%'});
    }
  }



  //----------------------------------------------------
  //----partner-----------------------------------------
  //----------------------------------------------------
  var pLogoBig = $('.se-partner-logo-big');
  var pLogoSmall = $('.se-partner-logo-small');
  var pLogoHeight = $('.se-partner-logo-big').height();

  pLogoBig.css({'height': (pLogoBig.width() / 10 * 8.9) });
  pLogoSmall.css({'height': (pLogoSmall.width() / 10 * 9)});

  $(window).on('resize', function(){
    pLogoBig.css({'height': (pLogoBig.width() / 10 * 9) })
    pLogoSmall.css({'height': (pLogoSmall.width() / 10 * 9)});
  });

  var pLogoContainer = $('.se-partner-logo-containter');
  var partnerCount = Math.ceil( ( pLogoBig.length + ( pLogoSmall.length / 2 ) ) / 4 );
  PartnerContainerSize(pLogoHeight, partnerCount);

  $( document ).ajaxComplete(function(){
    partnerCount = Math.ceil( ( pLogoBig.length + ( pLogoSmall.length / 2 ) ) / 4 );
    PartnerContainerSize( pLogoHeight, partnerCount);
  });

  function PartnerContainerSize(width, cnt){
    
    let theHeight = cnt * width + (width * 4);
    pLogoContainer.css({'height': theHeight});
    console.log(theHeight);
  }

  
  TweenMax.staggerFrom(pLogoBig, 0.5, {y: '30px', autoAlpha: '0', ease:Power1.easeOut}, 0.1);
  TweenMax.staggerFrom(pLogoSmall, 0.5, {y: '30px', autoAlpha: '0', ease:Power1.easeOut}, 0.1);

  //----------------------------------------------------
  //----programm-----------------------------------------
  //----------------------------------------------------
  var prigrammLines = $('.se-programm-programmpunkt');
  var programmL = $('.se-programm-line');
  var programmLink = $('.se-programm-row').find('img');
  TweenMax.staggerFrom(programmL, 0.5, {y: '300px', autoAlpha: '0', ease:Power1.easeOut}, 0.1);
  TweenMax.set(programmLink, {autoAlpha: '0', x: '5px'})
  prigrammLines.mouseenter(function(){
    TweenMax.to($(this), 0.2, {x: '0px', scale: 0.99, ease:Power1.easeOut});
    programmLink = $(this).find('img');
    TweenMax.to(programmLink, 0.7, {x: '0', autoAlpha: '1', ease:Power1.easeOut});
  }).mouseleave(function(){
    TweenMax.to($(this), 0.2, {x: '0px', scale: 1, ease:Power1.easeOut});
    TweenMax.to(programmLink, 0.2, {autoAlpha: '0', x: '5px'});
  });

  $('.se-programm-zeit').each(function(){
    $(this).css({
      'height': $(this).parent().height() });
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
  //----Peoples-----------------------------------------
  //----------------------------------------------------
  let PplHeight = $('.se-people-portrait-wrapper');
  PplHeight.css({'height': PplHeight.width()});
  $(window).on('resize', function(){ PplHeight.css({'height': PplHeight.width()});})


  var PplPortrait = $('.se-people-portrait-img');
  //TweenMax.staggerFrom($('.se-people-container'), 0.5, {autoAlpha: 0,  y: 50}, 0.1);

  TweenMax.staggerFrom($('.se-people-container *'), 0.5, {y: 50}, 0.01);
  TweenMax.staggerFrom(PplPortrait, 0.2, {scale: 0.5}, 0.1);
  PplPortrait.on('mouseenter', function() {
    TweenMax.to($(this), 0.5, {  'filter': 'grayscale(0%)', '-webkit-filter': 'grayscale(0%)' });
  });
  PplPortrait.on('mouseleave', function() {
    TweenMax.to($(this), 0.5, {  'filter': 'grayscale(60%)', '-webkit-filter': 'grayscale(60%)' });
  });

  //----------------------------------------------------
  //----Tiles-----------------------------------------
  //----------------------------------------------------
  var tile = $('.se-tile-container');

  tile.on('mouseenter', function() {
    TweenMax.to($(this), 0.2, {  scale: 1.03, ease:Power1.easeOut });
  });
  tile.on('mouseleave', function() {
    TweenMax.to($(this), 0.4, {  scale: 1.0, ease:Power1.easeOut });
  });

  //----------------------------------------------------
  //----Footer-----------------------------------------
  //----------------------------------------------------
  if(!isMobile){
    function doFooterPosition() {
      
      let footerPos = $('.se-footer-container').offset().top;
      let windowHeight = $(window).height();
      let contentHeight = $(document).height();
      if(windowHeight > footerPos){
        $('.se-footer-container').css({'position': 'fixed', 'bottom':0});
      } 
      
    }

    if(!seEmbed){
      doFooterPosition();
      // $(window).on('resize', function(){ doFooterPosition();});
      $( document ).ajaxComplete(function(){ doFooterPosition(); });
    }
    
  }


/**
 * detect IE
 * returns version of IE or false, if browser is not Internet Explorer
 */
function detectIE() {
  var ua = window.navigator.userAgent;

  var msie = ua.indexOf('MSIE ');
  if (msie > 0) {
      // IE 10 or older => return version number
      return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
  }

  var trident = ua.indexOf('Trident/');
  if (trident > 0) {
      // IE 11 => return version number
      var rv = ua.indexOf('rv:');
      return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
  }

 

  // other browser
  return false;
}



});

//JS------
