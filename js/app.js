 var loader = new PIXI.Loader();
  document.querySelectorAll(".slide-img").forEach((img) => {
    loader.add(img.src);
  });

  loader.load(init);

  function init() {
    const slider = document.querySelector(".slider");
    const sliderImgs = slider.querySelectorAll(".slide");
    let sliderWidth = 0;
    let mouseDown = false;
    let mouseStart = { x: 0 };
    let mousePos = { x: 0 };
    let sliderPos = 0;
    let canvasPos = { x: 0 };
    let resolution = { x: window.innerWidth, y: window.innerHeight };
    let time = 0;
    let isScrolling;

    const uniforms = {
      u_mouse: mousePos,
      u_resolution: resolution,
      u_time: time,
      u_strength: 1.0,
    };

    function makeSize() {
      sliderImgs.forEach((slide) => {
        sliderWidth += slide.offsetWidth + 5;
      });
      slider.style.width = sliderWidth + "px";
    }
    makeSize();

    document.addEventListener("mousedown", onMouseDown);
    document.addEventListener("touchstart", onMouseDown);
    document.addEventListener("mousemove", onMouseMove);
    document.addEventListener("touchmove", onMouseMove);
    document.addEventListener("mouseup", onMouseUp);
    document.addEventListener("touchend", onMouseUp);

    window.addEventListener("wheel", function (e) {
      canvasPos.x -= e.deltaY;
      slider.style.transform = "translateX(" + canvasPos.x + "px)";
      window.clearTimeout(isScrolling);

      isScrolling = setTimeout(function () {
        sliderPos = canvasPos.x;
        let newPos = Math.round((sliderPos / sliderWidth) * sliderImgs.length);
        let slideWidth = sliderWidth / sliderImgs.length;
        if (newPos < -1 * (sliderImgs.length - 1)) {
          newPos = -1 * (sliderImgs.length - 1);
        } else if (newPos > 0) {
          newPos = 0;
        }
        gsap.to(canvasPos, 0.3, { x: newPos * slideWidth });
        gsap.to(slider, 0.3, { x: newPos * slideWidth });
        sliderPos = newPos * slideWidth;
      }, 66);
    });

    function onMouseDown(e) {
      e.preventDefault();
      mouseDown = true;
      gsap.to(uniforms, 1, { u_strength: 10.0 });
      mouseStart.x = e.clientX || e.touches[0].clientX;
    }

    function onMouseMove(e) {
      mousePos.x = e.clientX || e.touches[0].clientX;
      if (mouseDown) {
        canvasPos.x = sliderPos + mousePos.x - mouseStart.x;
        slider.style.transform = "translateX(" + canvasPos.x + "px)";
      }
    }

    function onMouseUp() {
      gsap.to(uniforms, 1, { u_strength: 1.0 });
      mouseDown = false;
      sliderPos += mousePos.x - mouseStart.x;
      let newPos = Math.round((sliderPos / sliderWidth) * sliderImgs.length);
      let slideWidth = sliderWidth / sliderImgs.length;
      if (newPos < -1 * (sliderImgs.length - 1)) {
        newPos = -1 * (sliderImgs.length - 1);
      } else if (newPos > 0) {
        newPos = 0;
      }
      gsap.to(canvasPos, 0.3, { x: newPos * slideWidth });
      gsap.to(slider, 0.3, { x: newPos * slideWidth });
      sliderPos = newPos * slideWidth;
    }

    function slideNext() {
      let slideTo = canvasPos.x - sliderWidth / sliderImgs.length;
      if (slideTo > sliderWidth * -1 && slideTo <= 0) {
        sliderPos = slideTo;
        gsap.to(canvasPos, 0.3, { x: slideTo });
        gsap.to(slider, 0.3, { x: slideTo });
      }
    }
    nextBtn.addEventListener("click", slideNext);

    function slidePrev() {
      let slideTo = canvasPos.x + sliderWidth / sliderImgs.length;
      if (slideTo > sliderWidth * -1 && slideTo <= 0) {
        sliderPos = slideTo;
        gsap.to(canvasPos, 0.3, { x: slideTo });
        gsap.to(slider, 0.3, { x: slideTo });
      }
    }
    prevBtn.addEventListener("click", slidePrev);

    var app = new PIXI.Application({ width: resolution.x, height: resolution.y });
    document.body.appendChild(app.view);

    var bg = new PIXI.Sprite(PIXI.Texture.WHITE);
    bg.width = resolution.x;
    bg.height = resolution.y;
    bg.tint = 0xb9b9b9;
    app.stage.addChild(bg);

    var container = new PIXI.Container();
    app.stage.addChild(container);

    sliderImgs.forEach((slide, idx) => {
      const img = slide.querySelector("img");
      const imgRect = img.getBoundingClientRect();
      let pixiImg = PIXI.Sprite.from(img.src);
      pixiImg.width = imgRect.width;
      pixiImg.height = imgRect.height;
      pixiImg.x = imgRect.left;
      pixiImg.y = imgRect.top;
      container.addChild(pixiImg);
      img.style.display = "none";
    });

    var shaderCode = document.getElementById("shader").innerHTML;
    var simpleShader = new PIXI.Filter("", shaderCode, uniforms);
    simpleShader.padding = 200;
    app.stage.filters = [simpleShader];

    app.ticker.add(() => {
      container.x = canvasPos.x;
      time += 0.01;
      uniforms.u_time = time;
    });
  }