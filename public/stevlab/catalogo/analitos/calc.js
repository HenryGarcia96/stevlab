var CSRF_TOKEN = $('meta[name="_token"]').attr('content');

/*
    ====================================================
    ================= CALCULATOR LOGIC =================
    ====================================================
*/ 

// get the result element
let result  = document.getElementById("result");

// ICaptura el valor al campo de texto
function input(num){
    let number = result.value;
    result.value = number + num;
}

// Calculator logic
function calc(){
    if(result.value != ""){
        let result2  = result.value;
        result.value = eval(result2)
    } else{
        alert("Erro! Adicione valores válidos.")
    }
}

// Reset button
function reset(){
    result.value = "";
}

// Del button
function del(){
    let result2  = result.value;
    result.value = result2.substring(0, result2.length - 1);
}

// Done
function saveFormula(){
    // Notificacion
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });
    let estudio = document.getElementById('estudioId').value;

    const pending = axios.post('/stevlab/catalogo/verify-disponibilidad', {
        _token: CSRF_TOKEN,
        estudio: estudio,
    }).then(function(response){
        if(response.data.response == true){
            // Obtengo el valor del campo 
            let inputFormula    = document.getElementById('result').value;
            //  Creo un nodo de texto con el valor de la formula 
            let formula         = document.createTextNode(inputFormula);

            //  Creo un elemento <li>
            let lista           = document.createElement('li');
            lista.className     = 'list-group-item';
            lista.appendChild(formula);

            // Creo un elemento button
            let button          = document.createElement('button')
            button.className    ='float-left btn btn-xs btn-danger btn-icon delete';

            // Creo un icono
            let iframe          = document.createElement('i');
            iframe.className    = 'mdi mdi-delete';
            
            // Inserto dentro de cada elemento: <i>  ->  <button>   -> <li>
            button.appendChild(iframe);
            // Añado evento de click
            button.addEventListener('click', removeFormula, false);
            // Añado el button al elemento li
            lista.appendChild(button);

            // Obtengo el campo de entrada de lista
            let listaPadre      = document.querySelector('#analitos-checklist-list');
            // Añado un elemento a la lista
            listaPadre.appendChild(lista);

            Toast.fire({
                icon: 'success',
                title: response.data.msj,
            });

            // Limpieza by jquery
            document.getElementById('result').value = '';
        }else{
            Toast.fire({
                icon: 'error',
                title: response.data.msj,
            });
        }
    }).catch(function(err){
        console.log(err);
    });
}
/*
    ====================================================
    =================== TOGGLE THEME ===================
    ====================================================
*/

// All colors for differents themes
const theme = {
    defaul(){
        root.style.setProperty('--background'          , '#3a4764');
        root.style.setProperty('--background-dark'     , '#232c43');
        root.style.setProperty('--background-very-dark', '#182034');
        
        root.style.setProperty('--key-color-top'       , '#ffffff');
        root.style.setProperty('--key-color-bottom'    , '#3a4764');
        root.style.setProperty('--key-background'      , '#eae3dc');
        root.style.setProperty('--key-background-dark' , '#dfd9d2');
        root.style.setProperty('--key-shadow'          , '#b4a597');

        root.style.setProperty('--key-blue-background' , '#637097');
        root.style.setProperty('--key-blue-shadow'     , '#404e72');

        root.style.setProperty('--key-red-background'  , '#d03f2f');
        root.style.setProperty('--key-red-shadow'      , '#93261a');
    },
    light(){
        root.style.setProperty('--background'          , '#e6e6e6');
        root.style.setProperty('--background-dark'     , '#d3cdcd');
        root.style.setProperty('--background-very-dark', '#eeeeee');
        
        root.style.setProperty('--key-color-top'       , '#3d3d33');
        root.style.setProperty('--key-color-bottom'    , '#3d3d33');
        root.style.setProperty('--key-background'      , '#e5e4e0');
        root.style.setProperty('--key-background-dark' , '#dfd9d2');
        root.style.setProperty('--key-shadow'          , '#b4a597');

        root.style.setProperty('--key-blue-background' , '#388187');
        root.style.setProperty('--key-blue-shadow'     , '#1c6166');

        root.style.setProperty('--key-red-background'  , '#d03f2f');
        root.style.setProperty('--key-red-shadow'      , '#93261a');
    },
    dark(){
        root.style.setProperty('--background'          , '#17062a');
        root.style.setProperty('--background-dark'     , '#1e0836');
        root.style.setProperty('--background-very-dark', '#1e0836');
        
        root.style.setProperty('--key-color-top'       , '#f7de43');
        root.style.setProperty('--key-color-bottom'    , '#f7de43');
        root.style.setProperty('--key-background'      , '#331b4d');
        root.style.setProperty('--key-shadow'          , '#851c9c');

        root.style.setProperty('--key-blue-background' , '#56077c');
        root.style.setProperty('--key-blue-shadow'     , '#851c9c');

        root.style.setProperty('--key-red-background'  , '#00decf');
        root.style.setProperty('--key-red-shadow'      , '#00decf');
    }
}

// Get the root element
var root = document.querySelector(':root');

// Checking the user themes preference
const darkThemeMq  = window.matchMedia("(prefers-color-scheme: dark)");
const lightThemeMq = window.matchMedia("(prefers-color-scheme: light)");

// changing the theme with the results above
if (darkThemeMq.matches) {
    document.getElementById('btnTheme').value = "3";
    theme.dark();
} else if(lightThemeMq.matches){
    document.getElementById('btnTheme').value = "2";
    theme.light();    
} else {
    document.getElementById('btnTheme').value = "1";
    theme.defaul();    
}

// Create a function for recive the value of range input
function myFunction_set(val) {
    // receiving the input type range value
    document.getElementById('btnTheme').value = val; 

    // changing the theme with the results above
    if(val == 1){
        theme.defaul();
    } 
     
    else if(val == 2){
        theme.light();
    }
    
    else{
        theme.dark();
    } 
  
}

