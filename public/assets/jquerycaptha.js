/*!
 * jquery-captcha-lgh v1.0 (https://github.com/honguangli/jquery-captcha-lgh)
 * Copyright honguangli
 * Licensed under the MIT license
 */
;
let Captcha;
(function($) {
    "use strict";
    // Ã©Â»ËœÃ¨Â®Â¤Ã©â€¦ÂÃ§Â½Â®
    const defaults = {
        element: null, // canvasÃ¨Å â€šÃ§â€šÂ¹
        length: 4, // Ã¦ Â¡Ã©ÂªÅ’Ã§ ÂÃ©â€¢Â¿Ã¥ÂºÂ¦
        code: [], // Ã¦ Â¡Ã©ÂªÅ’Ã§ Â
        autoRefresh: false, // Ã¨Â°Æ’Ã§â€Â¨Ã¦ Â¡Ã©ÂªÅ’Ã¦Å½Â¥Ã¥ÂÂ£Ã¥ÂÅ½Ã¦ËœÂ¯Ã¥ÂÂ¦Ã¨â€¡ÂªÃ¥Å Â¨Ã¥Ë†Â·Ã¦â€“Â°
    };

    const sCode = "A,B,C,E,F,G,H,J,K,L,M,N,P,Q,R,S,T,W,X,Y,Z,1,2,3,4,5,6,7,8,9,0";
    const aCode = sCode.split(",");
    const aLength = aCode.length; //Ã¨Å½Â·Ã¥Ââ€“Ã¥Ë†Â°Ã¦â€¢Â°Ã§Â»â€žÃ§Å¡â€žÃ©â€¢Â¿Ã¥ÂºÂ¦

    Captcha = function(element, options) {
        const self = this;
        self.options = $.extend(true, defaults, options);
        self.element = element;
        self.refresh();
        self.element.on('click', function() {
            self.refresh();
        });
    };

    Captcha.prototype.refresh = function() {
        const self = this;
        const canvas_width = self.element.width();
        const canvas_height = self.element.height();
        const canvas = self.element[0]; //Ã¨Å½Â·Ã¥Ââ€“Ã¥Ë†Â°canvasÃ§Å¡â€žÃ¥Â¯Â¹Ã¨Â±Â¡Ã¯Â¼Å’Ã¦Â¼â€Ã¥â€˜Ëœ
        const context = canvas.getContext("2d"); //Ã¨Å½Â·Ã¥Ââ€“Ã¥Ë†Â°canvasÃ§â€Â»Ã¥â€ºÂ¾Ã§Å¡â€žÃ§Å½Â¯Ã¥Â¢Æ’Ã¯Â¼Å’Ã¦Â¼â€Ã¥â€˜ËœÃ¨Â¡Â¨Ã¦Â¼â€Ã§Å¡â€žÃ¨Ë†Å¾Ã¥ÂÂ°
        canvas.width = canvas_width;
        canvas.height = canvas_height;

        const code = [];
        for (let i = 0; i < self.options.length; i++) {
            const j = Math.floor(Math.random() * aLength); //Ã¨Å½Â·Ã¥Ââ€“Ã¥Ë†Â°Ã©Å¡ÂÃ¦Å“ÂºÃ§Å¡â€žÃ§Â´Â¢Ã¥Â¼â€¢Ã¥â‚¬Â¼
            const deg = Math.random() * 30 * Math.PI / 180; //Ã¤ÂºÂ§Ã§â€Å¸0~30Ã¤Â¹â€¹Ã©â€”Â´Ã§Å¡â€žÃ©Å¡ÂÃ¦Å“ÂºÃ¥Â¼Â§Ã¥ÂºÂ¦
            const txt = aCode[j]; //Ã¥Â¾â€”Ã¥Ë†Â°Ã©Å¡ÂÃ¦Å“ÂºÃ§Å¡â€žÃ¤Â¸â‚¬Ã¤Â¸ÂªÃ¥â€ â€¦Ã¥Â®Â¹
            code.push(txt.toLowerCase());
            const x = 10 + i * 20; //Ã¦â€“â€¡Ã¥Â­â€”Ã¥Å“Â¨canvasÃ¤Â¸Å Ã§Å¡â€žxÃ¥ÂÂÃ¦ â€¡
            const y = 20 + Math.random() * 8; //Ã¦â€“â€¡Ã¥Â­â€”Ã¥Å“Â¨canvasÃ¤Â¸Å Ã§Å¡â€žyÃ¥ÂÂÃ¦ â€¡
            context.font = "bold 23px Arial";

            context.translate(x, y);
            context.rotate(deg);

            context.fillStyle = randomColor();
            context.fillText(txt, 0, 0);

            context.rotate(-deg);
            context.translate(-x, -y);
        }
        self.options.code = code;
        for (let i = 0; i <= 5; i++) {
            context.strokeStyle = randomColor();
            context.beginPath();
            // Ã¦ËœÂ¾Ã§Â¤ÂºÃ§ÂºÂ¿Ã¦ÂÂ¡
            context.moveTo(Math.random() * canvas_width, Math.random() * canvas_height);
            context.lineTo(Math.random() * canvas_width, Math.random() * canvas_height);
            // Ã¦ËœÂ¾Ã§Â¤ÂºÃ¥Â°ÂÃ§â€šÂ¹
            const x = Math.random() * canvas_width;
            const y = Math.random() * canvas_height;
            context.moveTo(x, y);
            context.lineTo(x + 1, y + 1);
            context.stroke();
        }

        //Ã¥Â¾â€”Ã¥Ë†Â°Ã©Å¡ÂÃ¦Å“ÂºÃ§Å¡â€žÃ©Â¢Å“Ã¨â€°Â²Ã¥â‚¬Â¼
        function randomColor() {
            const r = Math.floor(Math.random() * 256);
            const g = Math.floor(Math.random() * 256);
            const b = Math.floor(Math.random() * 256);
            return "rgb(" + r + "," + g + "," + b + ")";
        }
    };

    Captcha.prototype.getCode = function() {
        return this.options.code.join('');
    };

    Captcha.prototype.valid = function(code) {
        const self = this;
        const ans = code.toString().toLowerCase() === self.getCode().toLowerCase();
        if (!ans && self.options.autoRefresh) {
            self.refresh();
        }
        return ans;
    };
})($);