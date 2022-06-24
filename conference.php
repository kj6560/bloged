<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<title>Psychowellness Video Conferencing</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css"/>
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
		<style>
			*{
				box-sizing: border-box;
				margin: 0;
				padding: 0;
			}
			body{
				background: rgb(78, 76, 76);
				width: 100%;
				height: 100vh;
			}
			.top-heading{
				display: flex;
			    justify-content: space-between;
			    padding: 5px;
			    align-items: center;
			    height: 50px;
			}
			.time{
				font-size: 1.5rem;
			}
			.video-confrence{
				background: rgb(17, 17, 17);;
				height: 93vh;
				position: relative;
				/*width: 70%;*/
				
			}
			#localMedia video{
				height: 150px;
			    width: 150px;
			    position: absolute;
			    bottom: 10px;
			    right: 10px;
			    background-image: url(https://www.talktoangel.com/images/profile/profile.png);
			    background-repeat: no-repeat;
			    background-position: center;
			    z-index: 2;
			    box-shadow: 0px 0px 4px var(--gray);
			}
			
			#remoteVideos video{
				background: rgb(39, 34, 34);
			    position: relative;
			    bottom: 0;
			    right: 0;
			    background-image: url(https://www.talktoangel.com/images/profile/profile.png);
			    background-repeat: no-repeat;
			    background-position: center;
			    z-index: 2;
			    
			    height: 92.6vh;
			}
			.remote-single video{
				width: 100%;
			}
			.remote-couple video{
				width: calc(100% - 50.2%);
			}
			.feature{
				display: grid;
			    z-index: 2;
			    position: absolute;
			    left: 0;
			    top: 25%;
			    background: #15748a;
			    width: 60px;
			    place-items: center;
				
			}
			.feature span {
				margin: 5px;
			    font-size: 16px;
			    color: #f3efef;
			    cursor: pointer;
			    border-radius: 5px;
			    padding: 10px;
			    box-shadow: 0px 0px 10px rgb(80 78 78);
			    text-align: center;
				
			}
			/*.feature::after {
			    content: "";
			    width: 10px;
			    height: 10px;
			    position: absolute;
			    right: -20px;
			    border-top: 20px solid transparent;
			    border-bottom: 20px solid transparent;
			    border-left: 20px solid #ff5d7d;
			    cursor: pointer;
			}*/
			.feature::before {
				    content: 'x';
				    color: #fff;
				    font-weight: bolder;
				    font-size: 1.5rem;
				    position: absolute;
				    right: -20px;
				    z-index: -1;
				    background: #272222;
				    border-radius: 25px;
				    width: 30px;
				    height: 30px;
				    text-align: center;
				    cursor: pointer;
				    line-height: 24px;
				}
			/*.chat-confrence {
			    position: absolute;
			    width: 30%;
			    height: 60vh;
			    background: green;
			    top: 0;
			    right: 0;
			    z-index: 2;
			}*/
			.hide{
				display: none;
			}
		</style>
	</head>
	<body>
		<section class="top-heading">
			<img src="https://www.talktoangel.com/images/logo.png" alt="Confrence Room" width="100">
			<p class="text-right text-white time">45:00</p>
		</section>
		<section class="video-confrence" >
			<div id="remoteVideos" class="remote-single">
				<video></video>
				<video></video>
			</div>
			<div id="localMedia" draggable="true">
				<video></video>
			</div>
			<div class="feature">
				<span class="fas fa-phone" title="End Session" onclick="rc.exit()"></span>
				<span class="fas fa-video" title="Start Camera" onclick="rc.produce(RoomClient.mediaType.video, videoSelect.value)"></span>
				<span class="fas fa-video-slash hide" title="Close Camera" onclick="rc.closeProducer(RoomClient.mediaType.video)"></span>
				<span class="fas fa-microphone" title="Start Microphone" onclick="rc.produce(RoomClient.mediaType.audio, audioSelect.value)"></span>
				<span class="fas fa-microphone-slash hide" title="Close Camera" onclick="rc.closeProducer(RoomClient.mediaType.audio)"></span>
				<span class="fas fa-desktop" title="Screen Share" onclick="rc.produce(RoomClient.mediaType.screen)"></span>
				<span class="fas fa-desktop hide" title="Stop Screen Share" onclick="rc.closeProducer(RoomClient.mediaType.screen)"></span>
				<span class="fas fa-comment" title="Chat"></span>
				<span class="fas fa-exclamation" title="Report a Problem"></span>
			</div>
			
		</section>
		<!-- <div class="chat-confrence"></div> -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
		<script>
			let remoteVideos =document.querySelector("#remoteVideos");
			let localMedia =document.querySelector("#localMedia");
			 let dragSrcEl = null;
			setInterval(function(){
				chkremote();
			},1000);
				function chkremote(){
					if(remoteVideos.children.length >1){
						remoteVideos.classList.remove('remote-single');
						remoteVideos.classList.add('remote-couple');
					}else{
						remoteVideos.classList.add('remote-single');
						remoteVideos.classList.remove('remote-couple');
					}
				}

				function handleDragStart(e) {
			    this.style.opacity = '0.4';
			    
			    dragSrcEl = this;

			    e.dataTransfer.effectAllowed = 'move';
			    e.dataTransfer.setData('text/html', this.innerHTML);
			  }

			  function handleDragOver(e) {
			    if (e.preventDefault) {
			      e.preventDefault();
			    }

			    e.dataTransfer.dropEffect = 'move';
			    
			    return false;
			  }

			  function handleDragEnter(e) {
			    this.classList.add('over');
			  }

			  function handleDragLeave(e) {
			    this.classList.remove('over');
			  }

			  function handleDrop(e) {
			    if (e.stopPropagation) {
			      e.stopPropagation(); // stops the browser from redirecting.
			    }
			    
			    if (dragSrcEl != this) {
			      dragSrcEl.innerHTML = this.innerHTML;
			      this.innerHTML = e.dataTransfer.getData('text/html');
			    }
			    
			    return false;
			  }

			  function handleDragEnd(e) {
			    this.style.opacity = '1';
			    
			    localMedia.classList.remove('over');
			  }
				localMedia.addEventListener('dragstart', handleDragStart);
				localMedia.addEventListener('dragover', handleDragOver);
			    localMedia.addEventListener('dragenter', handleDragEnter);
			    localMedia.addEventListener('dragleave', handleDragLeave);
  				localMedia.addEventListener('dragend', handleDragEnd);
  				localMedia.addEventListener('drop', handleDrop);
		</script>
	</body>
</html>