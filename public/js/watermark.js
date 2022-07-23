// Inisialisasi variabel
let val = "";
let textValue = "";
let textObj = {};
let startX;
let startY;
let selectedText = 0;
let angle = 0;
let isDownloadable = false;
let src = "";

const img = new Image();

img.addEventListener("load", function () {
    const canvas = ctx.canvas;
    const hRatio = canvas.width / img.width;
    const vRatio = canvas.height / img.height;
    const ratio = Math.min(hRatio, vRatio);
    const centerShift_x = (canvas.width - img.width * ratio) / 2;
    const centerShift_y = (canvas.height - img.height * ratio) / 2;

    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.drawImage(
        img,
        0,
        0,
        img.width,
        img.height,
        centerShift_x,
        centerShift_y,
        img.width * ratio,
        img.height * ratio
    );
    draggable();
});

// Inisialisasi element
const inputFile = document.querySelector("#inputFile");
const draggableFile = document.querySelector(".draggable-file");
const labelFile = document.querySelector(".label-file");

const closeBtn = document.querySelector(".close-btn");
const navBar = document.querySelector(".nav-bar");

// Section Canvas
const canvas = document.querySelector("#canvas");
const ctx = canvas.getContext("2d");

let canvasOffset = canvas.getBoundingClientRect();
let offsetX = canvasOffset.left;
let offsetY = canvasOffset.top;
let scrollX = canvas.scrollLeft;
let scrollY = canvas.scrollTop;

// Section file reader
let reader = new FileReader();

reader.addEventListener("load", function (event) {
    img.src = event.target.result;
    src = event.target.result;
    canvas.classList.add("show");

    isDownloadable = true;
});

// Section Event Listener

// Pada saat window browser di resize
window.addEventListener("resize", () => {
    canvasOffset = canvas.getBoundingClientRect();
    offsetX = canvasOffset.left;
    offsetY = canvasOffset.top;
    scrollX = canvas.scrollLeft;
    scrollY = canvas.scrollTop;
});

// Pada saat window di click

// Pada saat semua dom element telah selesai dimuat
window.addEventListener("DOMContentLoaded", () => {
    inputFile.addEventListener("change", handleImage, false);

    canvas.addEventListener("click", function (e) {
        selectedText = 1;
        mouseXY(e);
        setTimeout(() => {
            selectedText = 0;
        }, 1);
    });

    canvas.addEventListener("pointerdown", mouseDown, false);
    canvas.addEventListener("pointermove", mouseXY, false);
    canvas.addEventListener("pointerup", mouseXY, false);

    canvas.addEventListener("mousedown", mouseDown, false);
    canvas.addEventListener("mousemove", mouseXY, false);
    document.body.addEventListener("mouseup", mouseUp, false);

    inputFile.addEventListener("change", function () {
        const filename = this.value.split("\\").pop();

        inputFile.nextElementSibling.innerHTML = `<span class="truncate-text">${filename}</span>`;

        if (document.querySelector(".truncate-text").innerHTML === "") {
            labelFile.innerHTML = "Pilih Gambar";
        }

        draggableFile.style.display = "none";
    });

    draggableFile.addEventListener("dragover", dragOverHandler, false);
    draggableFile.addEventListener("drop", dropHandler, false);
});

// Section fungsi-fungsi
const isWMEmpty = () => elementText.value.replace(/^\s+|\s+$/g, "") === "";

function mouseUp() {
    canvas.classList.add("grab");
    canvas.classList.remove("grabbing");
    selectedText = 0;
    mouseXY();
}

function mouseDown() {
    canvas.classList.add("grabbing");
    canvas.classList.remove("grab");
    selectedText = 1;
    mouseXY();
}

function mouseXY(e) {
    try {
        e.preventDefault();
        canvasX = e.pageX - canvas.offsetLeft;
        canvasY = e.pageY - canvas.offsetTop;
        changePosXY(canvasX, canvasY);
    } catch (error) {}
}

function changePosXY(x, y) {
    if (selectedText) {
        textObj.x = x;
        textObj.y = y;
        draggable();
    }
}

function draggable(img, text_x = 0, text_y = 0) {
    let y = text_x > 0 ? text_x : canvas.height / 3;
    let x = text_y > 0 ? text_y : canvas.width / 2;

    /*     const color = "#000";

    const font = elementFont.value;
    const fontSize = selectFontSize.value; */

    if (textObj.x && textObj.y) {
        y = textObj.y;
        x = textObj.x;
    }

    let text = {
        text: textValue,
        x,
        y,
    };

    /*  angle = elementRotate.value;
    const opacity = elementOpacity.value;

    const rgbaCol = `rgba(${parseInt(color.slice(-6, -4), 16)},

    ${parseInt(color.slice(-4, -2), 16)},
    ${parseInt(color.slice(-2), 16)},
    ${opacity})`;

    const metrics = ctx.measureText(textValue);
    const actualHeight = Math.ceil(
        metrics.actualBoundingBoxAscent + metrics.actualBoundingBoxDescent
    );

    ctx.font = `${fontSize}px ${font}`;
    ctx.fillStyle = rgbaCol;
    ctx.textAlign = "center";
    text.width = Math.ceil(ctx.measureText(textValue).width);
    text.height = actualHeight;

    textObj = text; */
    theimg();
}

function theimg() {
    const acanvas = ctx.canvas;
    const hRatio = acanvas.width / img.width;
    const vRatio = acanvas.height / img.height;
    const ratio = Math.min(hRatio, vRatio);
    const centerShift_x = (acanvas.width - img.width * ratio) / 2;
    const centerShift_y = (acanvas.height - img.height * ratio) / 2;

    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.drawImage(
        img,
        0,
        0,
        img.width,
        img.height,
        centerShift_x,
        centerShift_y,
        img.width * ratio,
        img.height * ratio
    );
    ctx.save();

    const text = textObj;

    ctx.textAlign = "center";
    ctx.translate(text.x, text.y);
    ctx.rotate(angle * (Math.PI / 180));

    /*     const splitedText = text.text.split("\n");
    const fontSize = selectFontSize.value; */

    // splitedText.forEach((text, i) => ctx.fillText(text, 0, fontSize * (i + 1)));

    ctx.restore();
}

function validateImage() {
    var img = inputFile.value.toLowerCase();
    regex = new RegExp("(.*?).(jpg|jpeg|png)$");
    if (!regex.test(img)) {
        alert("Format gambar yang Anda masukan salah");
        inputFile.value = "";
        return false;
    } else {
        return true;
    }
}

function handleImage(e) {
    if (validateImage(e.target.files[0])) {
        reader.readAsDataURL(e.target.files[0]);
    }
}

function dispatchEvent(element, eventName) {
    if ("createEvent" in document) {
        const event = document.createEvent("HTMLEvents");
        event.initEvent(eventName, false, true);

        element.dispatchEvent(event);
    } else {
        element.fireEvent(eventName); // only for backward compatibility (older browsers)
    }
}

function dropHandler(ev) {
    ev.preventDefault();
    if (ev.dataTransfer.items) {
        for (const item of ev.dataTransfer.items) {
            if (item.kind === "file") {
                const file = item.getAsFile();

                if (file.type.includes("image/")) {
                    reader.readAsDataURL(file);
                    draggableFile.style.display = "none";
                }
            }
        }
    } else {
        for (const file of ev.dataTransfer.files) {
            reader.readAsDataURL(file);
        }
    }
}

function dragOverHandler(ev) {
    ev.preventDefault();
}
