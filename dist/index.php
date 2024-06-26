<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Welcome to our furniture store. Experience the perfect blend of beauty and comfort with our meticulously crafted chairs. Join us for a journey of timeless elegance and sustainability." />
    <title>Welcome Page</title>
    <link rel="stylesheet" href="./style.css" />
  </head>
  <body>
    <!-- partial:index.partial.html -->
    <!-- Canvas -->
    <canvas class="orb-canvas"></canvas>

    <!-- Overlay inner wrapper -->
    <div class="overlay__inner">
      <!-- Title -->
      <h1 class="overlay__title">
        Welcome to
        <span class="text-gradient">Furniture</span>
      </h1>
      <br />
      <!-- Buttons -->
      <div class="overlay__btns">
        <button class="overlay__btn overlay__btn--transparent">
          <a href="/Furniture/home.php">
            <label for="image-upload" class="text">Go to Home</label>
          </a>
        </button>
        <button class="overlay__btn overlay__btn--transparent register">
          <a href="/Furniture/register_form.php">
            <label for="image-upload" class="text">Register</label>
          </a>
        </button>
      </div>
      <div class="description">
        <p>
          Nestled in Pristina's heart, our shop obsesses over perfecting chairs.
          They marry beauty and comfort flawlessly, promising lasting health
          benefits. Crafted with ancestral wisdom, each curve and joint is a
          testament to our dedication. We source materials responsibly, ensuring
          quality and sustainability. Our chairs aren't mere furniture; they're
          art, evoking tranquility wherever they're placed. In a world of
          disposables, we offer timeless elegance and companionship for life's
          journey.
        </p>
      </div>
    </div>
    <!-- Audio element -->
    <audio id="welcome-audio" src="/Furniture/assets/audio.mp3" preload="auto"></audio>

    <!-- partial -->
    <script type="module" src="./script.js"></script>
    <script>
      window.addEventListener("load", function () {
        const audio = document.getElementById("welcome-audio");
        audio.muted = false;

        // Function to play audio
        const playAudio = () => {
          audio.play().catch((error) => {
            console.error("Audio play failed:", error);
            // Fallback interaction prompt
            document.body.addEventListener("click", () => {
              audio.play();
            });
          });
        };

        // Try to play the audio
        playAudio();

        // Ensure the audio plays on any user interaction
        document.body.addEventListener("click", playAudio);
      });
    </script>
  </body>
</html>
