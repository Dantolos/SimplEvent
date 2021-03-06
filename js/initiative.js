jQuery(document).ready(function($){
  var curLang = $('header').attr('curlang');
  var seLoaderMoreEvent = $('#se-more-event-content').find('.se-loader');

  console.log(curLang);

  //more Event -BAR
  // var moEvImg = $('.se-more-events-button');
  // moEvImg.hover(function(){
  //   moEvImg.find('span').fadeIn();
  // }, function(){
  //   moEvImg.find('span').fadeOut();
  // });

  var moEvO = 1;
  $('.se-more-events-section').on('click', function(){
    OpenMoEventContainer();
  });

  //reset by info
  $('.se-info-sidebar-trigger, .se_navbar_infobutton').on('click', function(){
    if ( (moEvO % 2) == 0) {
      OpenMoEventContainer();
    }
  });


  function OpenMoEventContainer(){

    moEvO++;
    var degrees = 0;
    $('.se-more-events-container').slideToggle();
    if ( (moEvO % 2) == 0) {
      degrees = 135;
    } else {
      degrees = 0;
    }
    moEvButton = $('.se-more-events-button').find('img');
    TweenMax.to(moEvButton, 0.5, {rotation: degrees});
  }

  var moreEventDone = false;
  var moreEventBtn = $('#more-events-button');
  var moreEventBtnPre = $('.se-arrow-pre-event');
  var moreEventBtnNxt = $('.se-arrow-next-event');
  var moreEventContainer = $('#se-more-event-content');

  var moreEventCount;

  moreEventBtn.on("click", function(){
    if(!moreEventDone){
      loadEvents('initiativen?_embed&per_page=100');
    }
  });

  //mobile more button
  $('#moEv-mobile-trigger').on("click", function(){

      loadEvents('initiativen?_embed&per_page=100');
      $('.se-more-events-container').fadeToggle();
  });

  moreEventBtnPre.on('click', function(){
    getNextPrev('prev');
  });
  moreEventBtnNxt.on('click', function(){
    getNextPrev('next');
  });

  //QUERY
  function loadEvents(direction){
    console.log('clicked');

    var iniReq = new XMLHttpRequest();
    var dir = 'https://www.nzz-konferenzen.ch/wp-json/wp/v2/' + direction;


    loadLoader();

    iniReq.open('GET', dir);
    iniReq.onload = function() {

      if(iniReq.status >= 200 && iniReq.status < 400) {
        var data = JSON.parse(iniReq.responseText);
          for (var i = 0; i < data.length; i++) {
            console.log(data[i]);
          }
        createMoreEvents(data);
        $('.se-more-event-content-inner').first().fadeIn();

        seLoaderMoreEvent.css({'display': 'none'});

        moreEventDone = true;
      } else {
        console.log('connection: OK; BUT ERROR');
      }
    }

    iniReq.onerror = function() {
      console.log('connection: ERROR; ');
    }
    iniReq.send();
  }

  //HTML
  function createMoreEvents(eventData) {
    console.log( window.location );
    var eventHTMLstring = '';
    moreEventCount = eventData.length;
    for ( var i = 0; i < eventData.length; i++ ) {

      let mElead;
      let mEdate;
      let mEOrt;
      let webBTN;
      switch (curLang) {
        case 'de':
          mElead = eventData[i].acf.lead;
          mEdate = eventData[i].acf.datum;
          mEOrt = eventData[i].acf.ort;
          webBTN = 'Webseite';
          break;
        case 'en':
          mElead = eventData[i].acf.lead_en;
          mEdate = eventData[i].acf.datum_en;
          mEOrt = eventData[i].acf.ort_en;
          webBTN = 'Website';
          break;
        case 'fr':
          mElead = eventData[i].acf.lead_fr;
          mEdate = eventData[i].acf.datum_fr;
          mEOrt = eventData[i].acf.ort_fr;
          webBTN = 'site Internet';
          break;
        default:
          mElead = eventData[i].acf.lead;
          mEdate = eventData[i].acf.datum;
          mEOrt = eventData[i].acf.ort;
          webBTN = 'Webseite';
      }

      eventHTMLstring += '<div countevent="'+i+'" class="se-more-event-content-inner" style="display:none;">';
      eventHTMLstring += '<div class="se-more-event-content-logo">';
      eventHTMLstring += '<a href="'+eventData[i].acf.webseite+'" target="_blank">';
      eventHTMLstring += '<img src="'+eventData[i].acf.logos.logo_negativ.url+'" alt="' + eventData[i].title.rendered + '" title="' + eventData[i].title.rendered + '"/>';
      eventHTMLstring += '</a>';
      eventHTMLstring += '</div>';
      eventHTMLstring += '<div class="se-more-event-content-text">';
      eventHTMLstring += '<h5>' + eventData[i].title.rendered + '</h5>';
      eventHTMLstring += '<p>' + mEdate + ' | ' + mEOrt + '</p>';
      eventHTMLstring += '<p class="se-more-event-content-lead">' + mElead + '</p>';
      eventHTMLstring += '<a href="'+ eventData[i].acf.webseite +'" target="_blank">';
      eventHTMLstring += '<div class="mc-button-neg se-mc-txt button-border se-more-event-web-btn" style="margin:0; ">';
      eventHTMLstring += webBTN;
      eventHTMLstring += '</div></a>';
      eventHTMLstring += '</div>';
      eventHTMLstring += '</div>';

    }
    moreEventContainer.append(eventHTMLstring);
  }

  function getNextPrev(richtung) {
    loadLoader();
    var currentEvent = $('.se-more-event-content-inner:visible').attr('countevent');
    $('.se-more-event-content-inner[countevent="'+currentEvent+'"]').fadeOut(300);
    if(richtung == 'next') {
      currentEvent++;
      if(currentEvent > (moreEventCount - 1)) {
        currentEvent = 0;
      }

    }else if(richtung == 'prev'){
      currentEvent--;
      if(currentEvent < 0) {
        currentEvent = moreEventCount - 1;
      }
    }
    changeEventAnim(currentEvent, richtung);
    $('.se-more-event-content-inner[countevent="'+currentEvent+'"]').show();
    seLoaderMoreEvent.css({'display': 'none'});
  }

  //change Event animation
  var moreEventTL = new TimelineMax({paused:true});
  function changeEventAnim(c, richting) {
    var r;
    var tr;
    var tl;
    if(richting == 'next') {
      r = c-1;
      tr = '100px';
      tl = '0px';
    } else if (richting == 'prev') {
      r = c+1;
      tr = '-100px';
      tl = '0px';
    }
    let cEv = $('.se-more-event-content-inner[countevent="'+r+'"]');
    let nEv = $('.se-more-event-content-inner[countevent="'+c+'"]');
    console.log(c);
    TweenMax.set($('.se-more-event-content-inner'), {autoAlpha: 1, x: 0});
    moreEventTL.from(nEv, 1, {autoAlpha: 0, x: tr})
      .to(cEv, 1, {autoAlpha: 1, x: tl});
    moreEventTL.play();

  }

  var seMoreEventsContainer = document.getElementById('se-more-events');

  console.log(seMoreEventsContainer);
  var seMoreEventsSwipe = new Hammer(seMoreEventsContainer);

  seMoreEventsSwipe.on('swipeleft', function(e) {
    getNextPrev('next');
  });
  seMoreEventsSwipe.on('swiperight', function(e) {
    getNextPrev('prev');
    console.log('swioeright');
  });

  function loadLoader(){
    seLoaderMoreEvent.css({'display': 'block', 'position': 'relative', 'height': '50%', 'width': '100%' });
    seLoaderMoreEvent.find('svg').css({
      'display': 'block',
      'position': 'absolute',
      'margin': 'auto',
      'top': 0, 'left': 0, 'bottom': 0, 'right': 0
    });
    TweenMax.from(seLoaderMoreEvent.find('svg'), 0.5, { autoAlpha: 0, y: '-80px' });
  }

});
