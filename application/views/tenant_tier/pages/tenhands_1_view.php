<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
      <head>
          <title>TenHands Getting Started</title>
          <link href="https://www.tenhands.net/css/bootstrap.min.css" rel="stylesheet">
          <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
          <script type="text/javascript" src="https://www.tenhands.net/js/tenhands.loader.v2.0.js"></script>
          <script>
              function onVideoServiceLoad(videoService) {
                  gVideoService = videoService; // Store reference to videoService

                  gVideoPlayer = gVideoService.getDefaultVideoPlayer({}); // Get a handle to the default videoPlayer

                  // Add a connectionEventHandler
                  gVideoService.registerConnectionEventHandler(function(connectionStatus) {
                      console.log(connectionStatus);
                      if (connectionStatus.signedIn) {
                          $("#callBtn").removeAttr("disabled");
                          $("#loginStatus").html("Signed In as " + user.email);
                          console.log("Signed In");
                      } else {
                          console.log("Signed out");
                      }
                  });
              };

             $(function() {
                 // plugin in the user object from your /signIn call
                 user = <?= $session_data['ten_hands']; ?>;

                 TenHands.videoService({videoContainerId: "THVideoContainer",
                                       user: user,
                                       onSuccess:onVideoServiceLoad});

                 $("#callBtn").click(function(e) {
                    e.preventDefault();
                    var callee = $("#callee").val();
                    var coreService = gVideoPlayer.coreService();
                    coreService.getParticipantName(callee, function(name) {
                        gVideoPlayer.launchOutgoingCall({remoteEmail:callee, callLabel: name, audio: true, video: true});
                    });
                });
                   

             });

          </script>
      </head>
      <body>
          <div id="THVideoContainer"
                  style="position:absolute; top:0px; left:0px; height: 100%; width: 100%; visibility: hidden;">
          </div>
         <form class="well">
             <h3>Point 2 Point Call</h3>
             <div id="loginStatus"></div><br>
             <input type="text" id="callee" class="input-large search-query" style="height: 28px">
             <button type="submit" class="btn" id="callBtn" disabled>Place a Call</button>
         </form>
            

      </body>
</html>
