"use strict;"

if (!window.WebSocket) {
  alert('Ваш браузер не поддерживает Веб-сокеты');
}
const webSocket = new WebSocket('ws://chat.ws:8080?channel=' + channel);

document.getElementById('chat_form')
  .addEventListener('submit', function (event) {
    const data = {
      message: this.message.value,
      channel: this.channel.value,
      user_id: this.user_id.value,
    };
    webSocket.send(JSON.stringify(data));
    event.preventDefault();
    return false;
  });


webSocket.onmessage = function (event) {
  const data = event.data;
  const messageContainer = document.createElement('div');
  const textNode = document.createTextNode(data);
  messageContainer.appendChild(textNode);
  document.querySelector('.chat')
    .appendChild(messageContainer);
}

