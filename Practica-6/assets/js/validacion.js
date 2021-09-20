const ValidarTexto = ( texto, campovacio , invformat ) =>{
    
  if (texto.length === 0){
    let vacio = '✖ El campo esta vacio.'
    campovacio.innerText = vacio
    campovacio.classList.add('text-danger')
    campovacio.classList.remove('text-success')
    
  }else{
    let novacio = '✔  El campo no esta vacio.'
    campovacio.innerText = novacio
    campovacio.classList.remove('text-danger')
    campovacio.classList.add('text-success')
  }

  const regex = /^[A-Z][a-z]+$/gu
    
  if (regex.test(texto) === false){
    let notformat = '✖ Formato incorrecto, solo una palabra con letra capital.'
    invformat.innerText = notformat
    invformat.classList.add('text-danger')
    invformat.classList.remove('text-success')
    
  }else{
    let okformat = '✔  El formato es correcto.'
    invformat.innerText = okformat
    invformat.classList.remove('text-danger')
    invformat.classList.add('text-success')
  }

}

const ValidarNumero = ( numero , campovacio, invformat) => {
  
  
  if (numero.length === 0){
    let vacio = '✖ El campo esta vacio.'
    campovacio.innerText = vacio
    campovacio.classList.add('text-danger')
    campovacio.classList.remove('text-success')
  }else{
    let novacio = '✔  El campo no esta vacio.'
    campovacio.innerText = novacio
    campovacio.classList.remove('text-danger')
    campovacio.classList.add('text-success')
  }

  const regex = /^[0-9]{1}$/gu
    
  if (regex.test(numero) === false){
    let notformat = '✖ Formato incorrecto, solo un numero.'
    invformat.innerText = notformat
    invformat.classList.add('text-danger')
    invformat.classList.remove('text-success')
  }else{
    let okformat = '✔  El formato es correcto.'
    invformat.innerText = okformat
    invformat.classList.remove('text-danger')
    invformat.classList.add('text-success')
  }

}