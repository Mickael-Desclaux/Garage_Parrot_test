window.onload = function() {
    let starInputElements = document.querySelectorAll('.star-rating__input');
    starInputElements.forEach((elem) => elem.addEventListener('change', handleStarClick));

    function handleStarClick(e) {
        let checkedValue = e.target.value;
        starInputElements.forEach((elem) => {
            if (elem.value <= checkedValue) {
                elem.nextElementSibling.style.color = "#D92332";
            }
            else {
                elem.nextElementSibling.style.color = "#bbb";
            }
        })
    }
}