


 function VerCasa(){
    const ojos = document.querySelectorAll('.ver');
     ojos.forEach(ojo => {
       ojo.addEventListener('click', function() {
         const id = this.getAttribute('data-id');
         window.location.href = `${BASE_URL}/Vista/panel_control/MostrasCasa.php?id=${id}`;
       });
     });
}
   