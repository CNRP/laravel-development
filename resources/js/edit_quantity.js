document.addEventListener('DOMContentLoaded', function() {
    var editQuantitiesBtns = document.querySelectorAll('.edit-quantities-btn');

    editQuantitiesBtns.forEach(function(editQuantitiesBtn) {
        editQuantitiesBtn.addEventListener('click', function() {
            var container = this.parentNode.nextElementSibling;
            var quantityInfo = this.parentNode.querySelector('.quantity-info');

            container.classList.toggle('hidden');
            quantityInfo.classList.add('hidden');
            this.classList.add('hidden');
        });
    });
});
