
class LightBox {

  constructor () {
    this.seLoaderDIV = '<div class="se-loader" style="height:100vh;"><svg version="1.1" id="dots" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="125.812px" height="125.812px" viewBox="0 0 125.812 125.812" enable-background="new 0 0 125.812 125.812" xml:space="preserve"><circle class="load-d1" fill="#FFFFFF" stroke="#dedede" stroke-width="1" stroke-miterlimit="10" cx="13.666" cy="63.24" r="8.282"/> <circle class="load-d2" fill="#FFFFFF" stroke="#dedede"stroke-width="1" stroke-miterlimit="10" cx="46.42" cy="63.24" r="8.282"/><circle class="load-d3" fill="#FFFFFF" stroke="#dedede" stroke-width="1" stroke-miterlimit="10" cx="79.173" cy="63.24" r="8.282"/><circle class="load-d4" fill="#FFFFFF" stroke="#dedede" stroke-width="1" stroke-miterlimit="10" cx="111.928" cy="63.24" r="8.282"/></svg></div> ';

    this.DirURL = seDIR.templateUrl;
    this.dots;
    this.tlLoader;
    console.log('hallo');
  }

  seOpenLB(){
    var seLBCon = document.createElement('div');
    seLBCon.className = "se-lb-wrapper";
    seLBCon.innerHTML += '<div id="se-lb-con" class="se-lightbox-container" style="opacity:1"><img src="'+this.DirURL+'/img/close.svg" alt="" class="closer">'+this.seLoaderDIV+'</div>';
    document.body.appendChild(seLBCon);
    this.dots = document.getElementById('dots').getElementsByTagName('*');

    var seLoader = document.getElementsByClassName("se-loader");
    seLoader[0].classList.add("se-loader-center");
    seLoader[0].style.display = 'block';

    this.tlLoader = new TimelineMax({repeat:-1});
    this.tlLoader
      .staggerTo(this.dots, 0.3, {y: '-6px', fill: '#dedede', stroke: '#dedede',  scale: 1.2, ease:Power1.easeIn}, 0.2)
      .staggerTo(this.dots, 0.3, {y: '0px', fill: '#fff', stroke: '#dedede',   scale: 1, ease:Power1.easeOut}, 0.2, "-=0.5");
    this.tlLoader.play();
  }


  seLoadLB(data){
    let LBcontainer = document.getElementById('se-lb-con');
    LBcontainer.innerHTML += '<div class="se-lb-frame">'+data+'</div>';
    this.tlLoader.paused();
  }

  seCloseLB(){
    var ele = document.getElementById('se-lb-con')
    ele.removeChild(ele.childNodes[0]);
  }

  seImageLB(count, src){
    var seLBCIMGon = document.createElement('div');
    seLBCIMGon.className = "se-lb-img-wrapper";
    seLBCIMGon.innerHTML += '<div class="se-img-lb-wrapper" ocounter="'+count+'"><img src="'+src+'" style=""></div>';
    document.body.appendChild(seLBCIMGon);
    console.log('lb img');
  }

}
