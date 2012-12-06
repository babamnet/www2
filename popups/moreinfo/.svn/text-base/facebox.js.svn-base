/*
 * infobox (for jQuery)
 * version: 1.2 (05/05/2008)
 * @requires jQuery v1.2 or later
 *
 * Examples at http://famspam.com/infobox/
 *
 * Licensed under the MIT:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Copyright 2007, 2008 Chris Wanstrath [ chris@ozmm.org ]
 *
 * Usage:
 *  
 *  jQuery(document).ready(function() {
 *    jQuery('a[rel*=infobox]').infobox() 
 *  })
 *
 *  <a href="#terms" rel="infobox">Terms</a>
 *    Loads the #terms div in the box
 *
 *  <a href="terms.html" rel="infobox">Terms</a>
 *    Loads the terms.html page in the box
 *
 *  <a href="terms.png" rel="infobox">Terms</a>
 *    Loads the terms.png image in the box
 *
 *
 *  You can also use it programmatically:
 * 
 *    jQuery.infobox('some html')
 *
 *  The above will open a infobox with "some html" as the content.
 *    
 *    jQuery.infobox(function($) { 
 *      $.get('blah.html', function(data) { $.infobox(data) })
 *    })
 *
 *  The above will show a loading screen before the passed function is called,
 *  allowing for a better ajaxy experience.
 *
 *  The infobox function can also display an ajax page or image:
 *  
 *    jQuery.infobox({ ajax: 'remote.html' })
 *    jQuery.infobox({ image: 'dude.jpg' })
 *
 *  Want to close the infobox?  Trigger the 'close.infobox' document event:
 *
 *    jQuery(document).trigger('close.infobox')
 *
 *  infobox also has a bunch of other hooks:
 *
 *    loading.infobox
 *    beforeReveal.infobox
 *    reveal.infobox (aliased as 'afterReveal.infobox')
 *    init.infobox
 *
 *  Simply bind a function to any of these hooks:
 *
 *   $(document).bind('reveal.infobox', function() { ...stuff to do after the infobox and contents are revealed... })
 *
 */
(function($) {
  $.infobox = function(data, klass) {
    $.infobox.loading()

    if (data.ajax) fillinfoboxFromAjax(data.ajax)
    else if (data.image) fillinfoboxFromImage(data.image)
    else if (data.div) fillinfoboxFromHref(data.div)
    else if ($.isFunction(data)) data.call($)
    else $.infobox.reveal(data, klass)
  }

  /*
   * Public, $.infobox methods
   */

  $.extend($.infobox, {
    settings: {
      opacity      : 0,
      overlay      : true,
      loadingImage : 'popups/moreinfo/loading.gif',
      closeImage   : 'popups/moreinfo/closelabel.gif',
      imageTypes   : [ 'png', 'jpg', 'jpeg', 'gif' ],
      infoboxHtml  : '\
    <div id="infobox" style="display:none;"> \
      <div class="popup"> \
        <table> \
          <tbody> \
            <tr> \
              <td class="tl"/><td class="b"/><td class="tr"/> \
            </tr> \
            <tr> \
              <td class="b"/> \
              <td class="body"> \
                <div class="content"> \
                </div> \
              </td> \
              <td class="b"/> \
            </tr> \
            <tr> \
              <td class="bl"/><td class="b"/><td class="br"/> \
            </tr> \
          </tbody> \
        </table> \
      </div> \
    </div>'
    },

    loading: function() {
      init()
      if ($('#infobox .loading').length == 1) return true
      showOverlay()

      $('#infobox .content').empty()
      $('#infobox .body').children().hide().end().
        append('<div class="loading"><img src="'+$.infobox.settings.loadingImage+'"/></div>')

      $('#infobox').css({
        top:	56,//getPageScroll()[1] + (getPageHeight() / 10),
        left:	385.5
      }).show()

      $(document).bind('keydown.infobox', function(e) {
        if (e.keyCode == 27) $.infobox.close()
        return true
      })
      $(document).trigger('loading.infobox')
    },

    reveal: function(data, klass) {
      $(document).trigger('beforeReveal.infobox')
      if (klass) $('#infobox .content').addClass(klass)
      $('#infobox .content').append(data)
      $('#infobox .loading').remove()
      $('#infobox .body').children().fadeIn('normal')
      $('#infobox').css('left', $(window).width() / 2 - ($('#infobox table').width() / 2))
      $(document).trigger('reveal.infobox').trigger('afterReveal.infobox')
    },

    close: function() {
      $(document).trigger('close.infobox')
      return false
    }
  })

  /*
   * Public, $.fn methods
   */

  $.fn.infobox = function(settings) {
    init(settings)

    function clickHandler() {
      $.infobox.loading(true)

      // support for rel="infobox.inline_popup" syntax, to add a class
      // also supports deprecated "infobox[.inline_popup]" syntax
      var klass = this.rel.match(/infobox\[?\.(\w+)\]?/)
      if (klass) klass = klass[1]

      fillinfoboxFromHref(this.href, klass)
      return false
    }

    return this.click(clickHandler)
  }

  /*
   * Private methods
   */

  // called one time to setup infobox on this page
  function init(settings) {
    if ($.infobox.settings.inited) return true
    else $.infobox.settings.inited = true

    $(document).trigger('init.infobox')
    makeCompatible()

    var imageTypes = $.infobox.settings.imageTypes.join('|')
    $.infobox.settings.imageTypesRegexp = new RegExp('\.' + imageTypes + '$', 'i')

    if (settings) $.extend($.infobox.settings, settings)
    $('body').append($.infobox.settings.infoboxHtml)

    var preload = [ new Image(), new Image() ]
    preload[0].src = $.infobox.settings.closeImage
    preload[1].src = $.infobox.settings.loadingImage

    $('#infobox').find('.b:first, .bl, .br, .tl, .tr').each(function() {
      preload.push(new Image())
      preload.slice(-1).src = $(this).css('background-image').replace(/url\((.+)\)/, '$1')
    })

    $('#infobox .close').click($.infobox.close)
    $('#infobox .close_image').attr('src', $.infobox.settings.closeImage)
  }
  
  // getPageScroll() by quirksmode.com
  function getPageScroll() {
    var xScroll, yScroll;
    if (self.pageYOffset) {
      yScroll = self.pageYOffset;
      xScroll = self.pageXOffset;
    } else if (document.documentElement && document.documentElement.scrollTop) {	 // Explorer 6 Strict
      yScroll = document.documentElement.scrollTop;
      xScroll = document.documentElement.scrollLeft;
    } else if (document.body) {// all other Explorers
      yScroll = document.body.scrollTop;
      xScroll = document.body.scrollLeft;	
    }
    return new Array(xScroll,yScroll) 
  }

  // Adapted from getPageSize() by quirksmode.com
  function getPageHeight() {
    var windowHeight
    if (self.innerHeight) {	// all except Explorer
      windowHeight = self.innerHeight;
    } else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
      windowHeight = document.documentElement.clientHeight;
    } else if (document.body) { // other Explorers
      windowHeight = document.body.clientHeight;
    }	
    return windowHeight
  }

  // Backwards compatibility
  function makeCompatible() {
    var $s = $.infobox.settings

    $s.loadingImage = $s.loading_image || $s.loadingImage
    $s.closeImage = $s.close_image || $s.closeImage
    $s.imageTypes = $s.image_types || $s.imageTypes
    $s.infoboxHtml = $s.infobox_html || $s.infoboxHtml
  }

  // Figures out what you want to display and displays it
  // formats are:
  //     div: #id
  //   image: blah.extension
  //    ajax: anything else
  function fillinfoboxFromHref(href, klass) {
    // div
    if (href.match(/#/)) {
      var url    = window.location.href.split('#')[0]
      var target = href.replace(url,'')
      $.infobox.reveal($(target).clone().show(), klass)

    // image
    } else if (href.match($.infobox.settings.imageTypesRegexp)) {
      fillinfoboxFromImage(href, klass)
    // ajax
    } else {
      fillinfoboxFromAjax(href, klass)
    }
  }

  function fillinfoboxFromImage(href, klass) {
    var image = new Image()
    image.onload = function() {
      $.infobox.reveal('<div class="image"><img src="' + image.src + '" /></div>', klass)
    }
    image.src = href
  }

  function fillinfoboxFromAjax(href, klass) {
    $.get(href, function(data) { $.infobox.reveal(data, klass) })
  }

  function skipOverlay() {
    return $.infobox.settings.overlay == false || $.infobox.settings.opacity === null 
  }

  function showOverlay() {
    if (skipOverlay()) return

    if ($('infobox_overlay').length == 0) 
      $("body").append('<div id="infobox_overlay" class="infobox_hide"></div>')

    $('#infobox_overlay').hide().addClass("infobox_overlayBG")
      .css('opacity', $.infobox.settings.opacity)
      .click(function() { $(document).trigger('close.infobox') })
      .fadeIn(200)
    return false
  }

  function hideOverlay() {
    if (skipOverlay()) return

    $('#infobox_overlay').fadeOut(200, function(){
      $("#infobox_overlay").removeClass("infobox_overlayBG")
      $("#infobox_overlay").addClass("infobox_hide") 
      $("#infobox_overlay").remove()
    })
    
    return false
  }

  /*
   * Bindings
   */

  $(document).bind('close.infobox', function() {
    $(document).unbind('keydown.infobox')
    $('#infobox').fadeOut(function() {
      $('#infobox .content').removeClass().addClass('content')
      hideOverlay()
      $('#infobox .loading').remove()
    })
  })

})(jQuery);
