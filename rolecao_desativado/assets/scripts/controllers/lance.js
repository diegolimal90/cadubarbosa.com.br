
crossroads.addRoute('{videoID*}/{depoimentoID*}', function(videoID, depoimentoID) {

    $(document).ready(function(){
    	$('[data-id="' + depoimentoID + '"]').first().click();
    });
    window.currentVideoId = videoID;
});

crossroads.addRoute('{videoID*}', function(videoID) {

	var sectionBt = $('section.button');

    if (videoID == 3) {
    	sectionBt.removeClass('hide');
    } else {
    	sectionBt.addClass('hide');
    }

});

// Setup hasher
var	lastlink;
var closelink = 'closelink';

function parseHash(newHash, oldHash){
  lastlink = oldHash;
  crossroads.parse(newHash);
}

hasher.initialized.add(parseHash); //parse initial hash
hasher.changed.add(parseHash); //parse hash changes
hasher.prependHash = '';
hasher.init(); //start listening for history change
