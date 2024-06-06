let app = new PIXI.Application({
  width: 640,
  height: 640,
});
document.body.appendChild(app.view);

let img = new PIXI.Sprite.from("https://i.imgur.com/6trVFvS.jpg");
img.width = 640;
img.height = 640;
app.stage.addChild(img);

const depthMap = new PIXI.Sprite.from("https://i.imgur.com/1SyBPxz.jpg");
app.stage.addChild(depthMap);

const displacementFilter = new PIXI.filters.DisplacementFilter(depthMap);
app.stage.filters = [displacementFilter];
app.stage.width = 640;
app.stage.height = 640;

window.onmousemove = function (e) {
  displacementFilter.scale.x = (640 / 2 - e.clientX) / 30;
  displacementFilter.scale.y = (640 / 2 - e.clientY) / 30;
};
