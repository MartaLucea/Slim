document.addEventListener('DOMContentLoaded', () => {

    const vinilo = document.querySelector('.vinilo');
    const audio = vinilo.querySelector('audio')

    vinilo.addEventListener('click', () => {
        
        if (audio.paused){
            audio.play();
            vinilo.classList.add('playing');
        }else{
            audio.pause()
            vinilo.classList.remove('playing');
        }
    });
});
