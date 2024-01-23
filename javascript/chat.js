const phoneCallBtn = document.getElementById('phone-call');
const videoCallBtn = document.getElementById('video-call');
const userInfoBtn = document.getElementById('info');
const form = document.querySelector(".typing-area");
const cameraBtn = document.getElementById('camera');
const imageBtn = document.getElementById('image');
const inputField = form.querySelector(".input-field");
const sendBtn = form.querySelector(".send");
const chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
    e.preventDefault();
}


sendBtn.addEventListener("click", () => {
    //Ajax
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                inputField.value = ""; // wehn insert into db then leave blank
                scrollToBottom();
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
})

chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
}
chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
}

setInterval( () => {
    //Ajax
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")) {
                    scrollToBottom();
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}, 500); //this function will run frequently after 500ms

const scrollToBottom = () => {
    chatBox.scrollTop = chatBox.scrollHeight;
}