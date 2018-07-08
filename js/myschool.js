

  $(document).ready(function () {
      if(window.location.href.indexOf("auth") > -1) {
      $( ".nav-bar a, .nav-bar-user" ).addClass( "hidden-nav" );
      }
      if(window.location.href.indexOf("auth") < -1) {
      $( ".nav-bar a, .nav-bar-user" ).removeClass( "hidden-nav" );
      }
      if(window.location.href.indexOf("home") > -1 ) {
      $(".nav-bar a:nth-of-type(1)").addClass( "selected-screen" );
      }
      if(window.location.href.indexOf("administration") > -1 ) {
      $(".nav-bar a:nth-of-type(2)").addClass( "selected-screen" );
      }


  });
