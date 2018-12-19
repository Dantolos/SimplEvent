<?php


class DownloadIcon {
	public $hover = '<svg version="1.1" id="download-hover" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 viewBox="0 0 67 95" style="enable-background:new 0 0 67 95;" xml:space="preserve">
			<path style="fill:#dedede;" d="M48,0H5.897C2.64,0,0,2.64,0,5.897v83.206C0,92.36,2.64,95,5.897,95h55.206
				C64.36,95,67,92.36,67,89.103V19L48,0z M47.5,3.743L63.257,19.5H51.155c-2.016,0-3.655-1.64-3.655-3.655V3.743z M61.103,92H5.897
				C4.3,92,3,90.7,3,89.103V5.897C3,4.299,4.3,3,5.897,3H44.5v12.845c0,3.669,2.985,6.655,6.655,6.655H64v66.603
				C64,90.7,62.7,92,61.103,92z"/>
			<g id="Pfeil">
				<path style="fill:#dedede;" d="M34.388,82.72c-1.008,0-1.935-0.461-2.543-1.264L13.437,57.194c-0.737-0.973-0.858-2.257-0.315-3.35
					s1.639-1.772,2.859-1.772h3.26V31.192c0-1.76,1.432-3.192,3.192-3.192h23.911c1.761,0,3.193,1.432,3.193,3.192v20.879h3.259
					c1.221,0,2.316,0.679,2.859,1.772s0.422,2.377-0.315,3.35L36.932,81.457C36.323,82.259,35.396,82.72,34.388,82.72z M17.606,56.071
					L34.388,78.19L51.17,56.071h-2.44c-1.761,0-3.192-1.432-3.192-3.192V32H23.24v20.879c0,1.76-1.432,3.192-3.192,3.192H17.606z"/>
			</g>
			<polygon class="load" id="load1" style="fill:#dedede;" points="47,39 21,39 22,31 47,31 "/>
			<polygon class="load" id="load2" style="fill:#dedede;" points="47,47 22,47 21,39 47,39 "/>
			<polygon class="load" id="load3" style="fill:#dedede;" points="47,55 22,55 21,47 47,47 "/>
			<polygon class="load" id="load4" style="fill:#dedede;" points="49,63 20,63 17,55 52,55 "/>
			<polygon class="load" id="load5" style="fill:#dedede;" points="43.8,71 25.2,71 19,63 50,63 "/>
			<polygon class="load" id="load6" style="fill:#dedede;" points="38,79 31,79 27,71 42,71 "/>
		</svg>';
	public $dnlElement;
	public $dnlFilesize;



	public function DownloadLink($dnlText, $dnlLink) {
		//$this->dnlFilesize = size_format($dnlLink, 2);
		$this->dnlElement = '<a href="'.$dnlLink.'" target="blank" title="'.$dnlText.'"><div class="se-dnl clearfix">';
		$this->dnlElement .= $this->hover.'<p class="se-dnl-text se-wc-txt">'.$dnlText.' (';
		$this->dnlElement .= ')</p></div></a>';
		return $this->dnlElement;
	}



}
