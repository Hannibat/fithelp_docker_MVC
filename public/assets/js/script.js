document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('update-exercise-form');

    form.addEventListener('submit', function(event) {
        copyContentToHidden();
    });

    function copyContentToHidden() {
        const intro = document.getElementById('intro').innerHTML;
        const position = document.getElementById('position').innerHTML;
        const movement = document.getElementById('movement').innerHTML;
        const targeted_muscles = document.getElementById('targeted_muscles').innerHTML;

        document.getElementById('intro-hidden').value = intro;
        document.getElementById('position-hidden').value = position;
        document.getElementById('movement-hidden').value = movement;
        document.getElementById('targeted_muscles-hidden').value = targeted_muscles;
    }
});