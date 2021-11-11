
    function googleTranslateElementInit() {
      new google.translate.TranslateElement(
	{
	  pageLanguage: 'en', 
	  autoDisplay: false,
	  layout: google.translate.TranslateElement.FloatPosition.BOTTOM_LEFT,
	  gaTrack: false,
	  
	}, 
	  'google_translate_element',
	  
	  );
    }

	function triggerHtmlEvent(element, eventName) {
	  var event;
	  if (document.createEvent) {
		event = document.createEvent('HTMLEvents');
		event.initEvent(eventName, true, true);
		element.dispatchEvent(event);
	  } else {
		event = document.createEventObject();
		event.eventType = eventName;
		element.fireEvent('on' + event.eventType, event);
	  }
	}

	jQuery('.lang-select').click(function() {
	  var theLang = jQuery(this).attr('data-lang');
	  jQuery('.goog-te-combo').val(theLang);


	  //alert(jQuery(this).attr('href'));
	  window.location = jQuery(this).attr('href');
	  //document.getElementById("google_translate_element").style.display="none"
	  location.reload();
	  

	});