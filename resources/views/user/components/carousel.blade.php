<div class="relative w-full flex justify-center">
    <div id="carousel" class="w-full md:w-[95vw] lg:w-[80vw] xl:w-[80vw] max-h-[60vh] overflow-hidden bg-red-500 hidden md:flex justify-center items-start rounded-lg">
        <div class="carousel-wrapper flex transition-all duration-500 ease-in-out">
            <img src="https://curcumaplus.co.id/storage/app/media/uploaded-files/1675861086460.jpeg" alt="Gambar 1" class="w-full flex-shrink-0 object-cover h-full rounded-lg">
            <img src="https://i-cf65.ch-static.com/content/dam/cf-consumer-healthcare/panadol/id_id/homepagecarousel/Panadol%20Extra%20Website%20Banner%202-02.png?auto=format" alt="Gambar 2" class="w-full flex-shrink-0 object-cover h-full rounded-lg">
            <img src="https://storage.googleapis.com/tprt0ezsggqjornc7nf1wwluvgulhr/EditorImage/IfVPj/contoh%20iklan%20obat%20woods.webp.webp" alt="gambar 3" class="w-full flex-shrink-0 object-cover h-full rounded-lg">
        </div>
    </div>

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

    // Auto play carousel every 3 seconds
    setInterval(() => {
        nextSlide();
    }, 3000); // Ganti gambar setiap 3 detik
</script>

<style>
    /* Membuat lekukan pada gambar */
    .rounded-lg {
        border-radius: 20px;
    }
</style>
