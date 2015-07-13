function nextSlide() {
    i++;
    if ( i <= indexImg ) {
    } else {
        i = 0;
    }
    $img.css('display', 'none'); // on cache les images
    $currentImg = $img.eq(i); // on définit la nouvelle image
    $currentImg.css('display', 'block'); // puis on l'affiche
}

function previousSlide() {
    i--;
    if ( i >= 0 ) {
    } else {
        i = $img.length - 1;
    }
    $img.css('display', 'none');
    $currentImg = $img.eq(i);
    $currentImg.css('display', 'block');
}