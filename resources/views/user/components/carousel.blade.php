<div class="relative w-full flex justify-center">
    <div id="carousel" class="w-full md:w-[95vw] lg:w-[80vw] xl:w-[80vw] max-h-[60vh] overflow-hidden bg-red-500 hidden md:flex justify-center items-start">
        <div class="carousel-wrapper flex transition-all duration-500 ease-in-out">
            <img src="https://curcumaplus.co.id/storage/app/media/uploaded-files/1675861086460.jpeg" alt="Gambar 1" class="w-full flex-shrink-0 object-cover h-full">
            <img src="https://i-cf65.ch-static.com/content/dam/cf-consumer-healthcare/panadol/id_id/homepagecarousel/Panadol%20Extra%20Website%20Banner%202-02.png?auto=format" alt="Gambar 2" class="w-full flex-shrink-0 object-cover h-full">
        </div>
    </div>

    <!-- Navigation -->
    <button onclick="prevSlide()" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full">
        &#10094;
    </button>
    <button onclick="nextSlide()" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full">
        &#10095;
    </button>
</div>

<script>
    let currentIndex = 0;
    const slidesWrapper = document.querySelector('.carousel-wrapper');
    const slides = document.querySelectorAll('.carousel-wrapper img');
    const totalSlides = slides.length;

    function showSlide(index) {
        const offset = -index * 100; // Geser ke kiri sesuai indeks
        slidesWrapper.style.transform = `translateX(${offset}%)`;
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        showSlide(currentIndex);
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        showSlide(currentIndex);
    }

    // Initial display
    showSlide(currentIndex);
</script>
