
//menuburger
jQuery(document).ready(function($){

  var MburgerMenu = $('.se-navbar-mainmenu-mobile-burger');
  var MnavMenu = $('.se-navbar-mainmenu-mobile');
  var MnavLayer = $('.se-navbar-mainmenu-mobile-style-layer');
  var MnavMoEv = $('#moEv-mobile-trigger');
  var MnavInfo = $('#info-mobile-nav-trigger');
  var MMenuTriggerCount = 0;
  var MoEvBtnCounter = 0;
  var vertiLine = $('#moEv-mobile-trigger-line');

  var TLMMenu = new TimelineMax({paused:true});
  TweenMax.set(MnavLayer, { css:{borderRadius: "100%", y: '100%', scaleY: 0, scaleX: 0.5}  });
  TweenMax.set(MnavMenu, { css:{borderRadius: "100%", y: '100%', scaleY: 0, scaleX: 0.5, autoAlpha: 0}  });
  TweenMax.set(MnavMenu.find('.se-navbar-mainmenu-mobile-container'), {  autoAlpha:0});
  TweenMax.set(MnavMoEv, {autoAlpha:0, scaleY: 0, scaleX: 0.5, y:'10%' });

  TLMMenu.to(MnavLayer, 0.6, { borderRadius: "0px", y: '0%', scaleY: 1, scaleX: 1, borderWidth:'2px', ease: Power1.easeOut })
          .to(MnavMenu.find('.se-navbar-mainmenu-mobile-container'), 0.5, { autoAlpha:1 })
         .to(MnavMenu, 0.6, { borderRadius: "0px", y: '0%', scaleY: 1, scaleX: 1, autoAlpha: 1, ease: Power1.easeInOut }, 0.2)

         .to(MnavMoEv, 0.5, {autoAlpha:1, scaleY: 1, y: '0%', scaleX: 1, ease: Back.easeOut.config(0.4)});


  MburgerMenu.on('click', function(){
    if(MMenuTriggerCount%2 == 0){
      MnavMenu.show();
      $('#moEv-mobile-trigger').show();

      TLMMenu.play();

    } else {
      if(MoEvBtnCounter%2 != 0){
        $('.se-more-events-container').fadeOut();
        TweenMax.set(vertiLine, {rotation: '0', transformOrigin: '50% 50%'});
        MoEvBtnCounter++;
      }

      $('#moEv-mobile-trigger').hide();
      TLMMenu.reverse();
      console.log(MoEvBtnCounter);
    }
    MMenuTriggerCount++;
  });

  //MoreEvents

  MnavMoEv.on('click', function(){
    if(MoEvBtnCounter%2 == 0){
      TweenMax.to(vertiLine, 0.8, {rotation: '270', transformOrigin: '50% 50%', ease: Bounce.easeOut});
    } else {
      TweenMax.to(vertiLine, 0.8, {rotation: '0', transformOrigin: '50% 50%', ease: Bounce.easeOut});
    }
    MoEvBtnCounter++;
  });

  //Sidebar
  var MInfoSideBarBtn = $('.se-info-sidebar-btn');
  var MInfoSideBarContainer = $('#se-info-sidebar-container');
  var MInfoSideBarContent = $('.se-info-sidebar');
  var MInfoSideBarCount = 0;
  var MMInfoSideBarTL = new TimelineMax({paused:true});
  TweenMax.set(MInfoSideBarContent, { autoAlpha: 0 });
  MMInfoSideBarTL.to(MInfoSideBarContainer, 0.5, { width: '100%', height: '100%', borderRadius: '0px', ease: Power1.easeInOut })
                 .to(MInfoSideBarContent, 0.5, { display: 'block', autoAlpha: 1});

  function MOpenInfoSideBar(cS) {
    if(cS){ MMInfoSideBarTL.play(); }else{ MMInfoSideBarTL.reverse(); }
  }

  MInfoSideBarBtn.on('click', function(){
    var cS = ( MInfoSideBarCount%2 == 0 ? true : false );
    MOpenInfoSideBar(cS);
    $('.se-info-sidebar').css({'display': 'block', 'transform': 'unset'});
    //if(cS){$('.se-info-sidebar').show();}else{$('.se-info-sidebar').show();}
    MInfoSideBarCount++;
  });

  var MInfoSideBarContainerEl = document.getElementById('se-info-sidebar-container');
  if( MInfoSideBarContainerEl ) {
    var MInfoSideBarBtnHammer = new Hammer(MInfoSideBarContainerEl);

    MInfoSideBarBtnHammer.on('swipeup', function(e){
      console.log('seosadse');
      MOpenInfoSideBar(cS);
    });
  }


  //Image gallery referenten
  var LBclassImg = new LightBox;
  var LBtriggerGallery = $('.se-gallery-pic');
  var DirURL = seDIR.templateUrl;
  var LBImgCloser =' <img src="'+DirURL+'/img/close.svg" class="closer">';

  LBtriggerGallery.on('click', function(){
    LBImgOpen($(this).attr('counter'), $(this).attr('imgsrc'));
    $('body').append(LBImgCloser);
    LBImgCloser = $('.closer');

  });

  $('.closer').parent().on('click', '.closer', function(){
    $('body').find('.se-lb-img-wrapper').remove();
    $(this).remove();
    console.log('close');
  });

  $(document).ajaxComplete(function(){
    $('.closer').parent().on('click', '.closer', function(){
      $('body').find('.se-lb-img-wrapper').remove();
      $(this).remove();
      console.log('close');
    });
    LBtriggerGallery = $('.se-gallery-pic');
    LBtriggerGallery.on('click', function(){
      LBImgOpen($(this).attr('counter'), $(this).attr('imgsrc'));
      $('body').append(LBImgCloser);
      LBImgCloser = $('.closer');
    });
  });

  function LBImgOpen(e, src, dir){
    var slideEf = (dir) ? (dir == 2) ? '50px': '-50px' : '50px';
    $('body').find('.se-lb-img-wrapper').remove();
    LBclassImg.seImageLB(e, src);
    TweenMax.from($('.se-lb-img-wrapper').find('img'), 0.5, {x: slideEf, autoAlpha: 0.8, scale: 0.99 });

    LBIMGGalleryContainer = document.getElementsByClassName('se-img-lb-wrapper');
    if(LBIMGGalleryContainer){
      var LBIMGGalleryCount = $('.se-img-lb-wrapper').attr('ocounter');
      LBIMGGallerySwipe = new Hammer(LBIMGGalleryContainer[0]);
      LBIMGGallerySwipe.on('swipe', function(et){
        LBImgSwipe(et.direction, LBIMGGalleryCount);
      });
    }

  }



  function LBImgSwipe(dir, ele) {
    let aPic = $('.se-gallery-pic').length;
    ele = parseInt(ele) + 1;

    let cEle = ( ele > aPic && dir == 2 ) ? 1 : ( ele <= 2 && dir == 4 ) ? aPic : ( dir == 4 ) ? (ele - 2) : ele ;

    let nextPic = $('[counter="'+cEle+'"]').attr('imgsrc');

    LBImgOpen(cEle, nextPic, dir)
  }


});
