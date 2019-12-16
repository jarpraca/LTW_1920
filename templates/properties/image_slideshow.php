<div class="slideshow-container">
    <?php $pictures=getHabitationPictures($habitation['idHabitacao']); ?>

    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <!-- The dots/circles -->
    <div class="row" style="text-align:center">
    </div>
</div>

<script>
    let slideshow = document.getElementsByClassName("slideshow-container")[0];
    let row = slideshow.getElementsByClassName("row")[0];
    let pictures = <?php echo json_encode($pictures)?>;
    let button = document.getElementsByClassName("prev")[0];

    for (let i=0; i<pictures.length; i++){

        let img = document.createElement("img");
        img.setAttribute("src", pictures[i]['urlImagem']);
        img.setAttribute("style", "width:100%");
        img.setAttribute("alt", pictures[i]['legenda']);

        let numberText = document.createElement("div");
        numberText.setAttribute("class", "numbertext");
        numberText.innerHTML = i + " / " + pictures.length;
        numberText.appendChild(img);

        let div = document.createElement("div");
        div.setAttribute("class", "mySlides fade");
        div.appendChild(numberText);
        slideshow.insertBefore(div, button);

        let span = document.createElement("span");
        span.setAttribute("class", "dot");
        span.setAttribute("onclick", "currentSlide(" + i + ")");
        row.appendChild(span);
    }

    var slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
    showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
    showSlides(slideIndex = n);
    }

    function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    }
</script>