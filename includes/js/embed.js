var rzy_iframe=document.getElementById('sa-embed');var embed_url=document.getElementById('sa-embed').getAttribute('data-url');rzy_iframe.innerHTML = "<iframe id='rzy_iframe_object' width='100%' src='"+embed_url+"&if=y'  onload='resizeCrossDomainIframe();' onscroll='resizeCrossDomainIframe();'></iframe>";function resizeCrossDomainIframe(other_domain) {    var iframe = document.getElementById('rzy_iframe_object');	var other_domain = document.getElementById('rzy_iframe_object').getAttribute('src');    window.addEventListener('message', function(event) {			   if (other_domain.indexOf(event.origin)=='-1') return;		       if (isNaN(event.data)) return;       var height = parseInt(event.data) + 50;       iframe.height = height + "px";    }, false);}