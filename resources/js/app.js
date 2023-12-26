import './bootstrap';
import 'flowbite'; //bibblioteca de componentes talwind 

//para toastr 
import toastr from 'toastr';

window.toastr = toastr;
// Configuración de Toastr (puedes ajustarla según tus necesidades)
toastr.options = {
    closeButton: true,
    debug: false,
    newestOnTop: false,
    progressBar: false,
    positionClass: 'toast-top-right',
    preventDuplicates: true,
    showDuration: '300',
    hideDuration: '1000',
    timeOut: '5000',
    extendedTimeOut: '1000',
    showEasing: 'swing',
    hideEasing: 'linear',
    showMethod: 'fadeIn',
    hideMethod: 'fadeOut',
};

// Importa los estilos de Toastr 
import 'toastr/build/toastr.css';



