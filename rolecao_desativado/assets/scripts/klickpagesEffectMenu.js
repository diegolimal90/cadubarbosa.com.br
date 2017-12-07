var klickpagesEffectMenu = function(){};

klickpagesEffectMenu.prototype.initDropMenu = function(id) {
    jQuery("body").click(function(event){
        jQuery(id+ ' ~ ' + id + '-drop').removeClass("open");
    });

    jQuery(id).click(function(event){
        event.stopPropagation();
        jQuery(id+ ' ~ ' + id + '-drop').toggleClass("open");

    });
};

klickpagesEffectMenu.prototype.initTabMenu = function(id, data, child) {
    this.initToggleMenu(id, child);

    jQuery(id + ' ' + child).click(function(event){

        filter = jQuery(this).attr(data + "-filter");
        jQuery("div[" + data + "-tab]").addClass('hide');
        jQuery("div[" + data + "-tab = "+ filter +"]").removeClass('hide');

    });

};

klickpagesEffectMenu.prototype.initToggleMenu = function(id, child) {

   jQuery(id + ' ' + child).click(function(event){

            jQuery(id + ' ' + child).removeClass('is-active');
            jQuery(id + ' ' + child).addClass('is-not-active');
            jQuery(this).addClass('is-active');
            jQuery(this).removeClass('is-not-active');
    });
};  

klickpagesEffectMenu.prototype.initToggleMenuReset = function(id, child) {

   jQuery(id + ' ' + child).click(function(event){

        if($(this).hasClass('is-active')){

            jQuery(id + ' ' + child).removeClass('is-active');
            jQuery(id + ' ' + child).removeClass('is-not-active');

        }else{

            jQuery(id + ' ' + child).removeClass('is-active');
            jQuery(id + ' ' + child).addClass('is-not-active');
            jQuery(this).addClass('is-active');
            jQuery(this).removeClass('is-not-active');

        }

    });
};

klickpagesEffectMenu.prototype.initToggleItem = function(id, child, data) {

   jQuery(id).click(function(event){

        filter = jQuery(this).attr(data + "-filter");
        
        jQuery(child + "[" + data + "-tab = "+ filter +"]").toggleClass('is-active');

    });
}; 

klickpagesEffectMenu.prototype.insertAttrData = function(filter, tad, prefix) {
    cont = 0;

   jQuery(filter).each(function(){
        cont++;
        data = prefix + "-filter"
        $(this).attr(data , cont);
    });

   cont = 0;
   jQuery(tad).each(function(){
        cont++;
        data = prefix + "-tab"
        $(this).attr(data , cont);
    });
};

klickpagesEffectMenu.prototype.animeAutoHeigth = function(button, id, child, prefix) {
    jQuery(button).click(function(event){

        filter = jQuery(this).attr(prefix + "-filter");
        jQuery(id + "[" + prefix + "-tab = "+ filter +"] " + child).css("max-height", "0");

        jQuery(".is-active" + id + "[" + prefix + "-tab = "+ filter +"] " + child).css("max-height", "none");

        var height = jQuery(".is-active" + id + "[" + prefix + "-tab = "+ filter +"] " + child).outerHeight() + 60;
        jQuery(".is-active" + id + "[" + prefix + "-tab = "+ filter +"] " + child).css("max-height", "0");

        setTimeout(function() {
                jQuery(".is-active" + id + "[" + prefix + "-tab = "+ filter +"] " + child).css("max-height", height);
            }, 1);
    });
};
