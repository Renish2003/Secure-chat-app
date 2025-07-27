<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Secured Chat App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/4733528720.js" crossorigin="anonymous"></script>
  <style>
    body {
      background: linear-gradient(to right,rgb(42, 78, 114), #009ffd);
      color: white;
      font-family: 'Poppins', sans-serif;
    }
    h1 {
      text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
      font-weight: 600;
      text-align: center;
    }
    .chat-container {
      max-width: 700px;
      margin: auto;
      padding: 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.3);
      border-radius: 12px;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
    }
    #chat-box {
      height: 400px;
      background: white;
      border-radius: 12px;
      padding: 16px;
      overflow-y: auto;
      box-shadow: inset 0px 2px 6px rgba(0,0,0,0.1);
    }
    .btn-custom {
      border-radius: 30px;
      padding: 10px 20px;
      font-size: 16px;
      background: #28a745;
      color: white;
      border: none;
    }
    .btn-custom:hover {
      transform: scale(1.1);
      background: #218838;
    }
    .message-bubble {
      max-width: 70%;
      padding: 12px 15px;
      border-radius: 20px;
      word-wrap: break-word;
      font-size: 14px;
      margin-bottom: 10px;
      display: inline-block;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .sent-message {
      background: #28a745;
      color: white;
      border-top-right-radius: 0px;
    }
    .received-message {
      background: #f1f1f1;
      color: #333;
      border-top-left-radius: 0px;
    }
    .text-success {
      animation: pulse 1.5s infinite;
    }
    @keyframes pulse {
      0% { opacity: 1; }
      50% { opacity: 0.4; }
      100% { opacity: 1; }
    }
    .dark-mode {
      background: #121212 !important;
      color: #f0f0f0 !important;
    }
    .dark-mode #chat-box {
      background: #1e1e1e;
      color: white;
    }
  </style>
</head>
<body>
  <h1>Secured Chat App</h1>
  <div class="chat-container">
    <div id="chat-box"></div>
    <div id="typing-status" style="font-style:italic; font-size:12px; margin: 5px;"></div>
    <textarea class="form-control" id="message-text" rows="2" placeholder="Type a message..." oninput="onInputText()"></textarea>
    <button class="btn btn-custom mt-2" id="send-button" onclick="sendMessage()">Send <i class="fas fa-paper-plane"></i></button>
    <button class="btn btn-dark mt-2" onclick="toggleDarkMode()">Toggle Theme</button>
    <audio id="notif-sound" src="../resources/sounds/notify.mp3" preload="auto"></audio>
  </div>

  <script>
    function scrollToBottom() {
      const chatBox = document.getElementById("chat-box");
      chatBox.scrollTop = chatBox.scrollHeight;
    }

    function onInputText() {
      document.getElementById("typing-status").innerText = "You are typing...";
      clearTimeout(window.typingTimeout);
      window.typingTimeout = setTimeout(() => {
        document.getElementById("typing-status").innerText = "";
      }, 1500);
    }

    function sendMessage() {
      const text = document.getElementById("message-text").value.trim();
      if (!text) return;
      const messageDiv = document.createElement("div");
      messageDiv.className = "message-bubble sent-message";
      messageDiv.innerText = text;
      document.getElementById("chat-box").appendChild(messageDiv);
      document.getElementById("message-text").value = "";
      scrollToBottom();
      playNotifSound();
    }

    function playNotifSound() {
      document.getElementById("notif-sound").play();
    }

    function toggleDarkMode() {
      document.body.classList.toggle("dark-mode");
    }

    function updateLastSeen() {
      // Simulated status update
      const status = document.getElementById("last-seen");
      if (status) status.innerText = "Last seen: " + new Date().toLocaleTimeString();
    }
    setInterval(updateLastSeen, 60000);
    updateLastSeen();
  </script>
</body>
</html>
