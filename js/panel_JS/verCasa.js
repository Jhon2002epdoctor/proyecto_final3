


 function VerCasa(){
    const ojos = document.querySelectorAll('.ver');
     ojos.forEach(ojo => {
       ojo.addEventListener('click', function() {
         const id = this.getAttribute('data-id');
         window.location.href = `http://localhost/proyecto_final/Vista/panel_control/MostrasCasa.php?id=${id}`;
       });
     });
}
   