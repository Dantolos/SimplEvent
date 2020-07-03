var seREST = function(restAPIURL) 
{

   
     this.callRestAPI = function( restAPIURL, Type='privacy' )
     {
          ourRequest = new XMLHttpRequest();
          ourRequest.open('GET', restAPIURL);
          ourRequest.onload = function() {
               if ( ourRequest.status >= 200 && ourRequest.status < 400 ) 
               {
                    var data = JSON.parse( ourRequest.responseText );
                    switch (Type) {
                         case 'team':
                              doTeam(data);
                              break;
                         case 'privacy':
                              doPrivacy( data );
                              break;
                         default:
                              return data;
                              break;
                    }
               } else 
               {
                    console.log("We connected to the server, but it returned an error.");
               }
          };

          ourRequest.onerror = function() {
               console.log("Connection error");
          };

          ourRequest.send();
          
     }
     
     function doTeam(data)
     {
          console.log( data );
          console.log(globalURL.lang)
     }

     function doPrivacy(data)
     {
          var title, text, output; 
          
          if(globalURL.lang){
               switch (globalURL.lang) {
                    case 'de':
                         console.log(this.langCode)
                         title = data.acf.ds_title_de;
                         text = data.acf.ds_text_de;
                         break;
                    case 'en':
                         console.log(this.langCode)
                         title = data.acf.ds_title_en;
                         text = data.acf.ds_text_en;
                         break;
                    case 'fr':
                         console.log(this.langCode)
                         title = data.acf.ds_title_fr;
                         text = data.acf.ds_text_fr;
                         break;
                    default:
                         title = data.acf.ds_title_en;
                         text = data.acf.ds_text_en;
                         break;
               } 
          }
           
          output = '<div style="margin-bottom:120px;">';
          output += '<h1 style="margin-bottom:20px;">' + title + '</h1>';
          output += text;
          output += '</div>';
          jQuery('#api_target').append( output )
          
     }
     

}
     
console.log('adsfjahsldfk')