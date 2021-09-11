const ValidarTexto = ( texto, campovacio , invformat , btnenviar ) =>{

  let cerror = 2
  if (texto.length === 0){
    let vacio = '✖ El campo esta vacio.'
    campovacio.innerText = vacio
    campovacio.classList.add('text-danger')
    cerror++
  }else{
    let novacio = '✔  El campo no esta vacio.'
    campovacio.innerText = novacio
    campovacio.classList.remove('text-danger')
    campovacio.classList.add('text-success')
    cerror--
  }

  const regex = /^[A-Z][a-z]+$/gu
    
  if (regex.test(texto) === false){
    let notformat = '✖ Formato incorrecto, solo una palabra con letra capital.'
    invformat.innerText = notformat
    invformat.classList.add('text-danger')
    cerror++
  }else{
    let okformat = '✔  El formato es correcto.'
    invformat.innerText = okformat
    invformat.classList.remove('text-danger')
    invformat.classList.add('text-success')
    cerror--
  }

  if(cerror === 0){
    btnenviar.classList.remove('disabled')
  }else{
    btnenviar.classList.add('disabled')
  }

}

const ValidarNumero = ( numero , campovacio, invformat , btnenviar) => {
  
  let cerror = 2
  if (numero.length === 0){
    let vacio = '✖ El campo esta vacio.'
    campovacio.innerText = vacio
    campovacio.classList.add('text-danger')
    cerror++
  }else{
    let novacio = '✔  El campo no esta vacio.'
    campovacio.innerText = novacio
    campovacio.classList.remove('text-danger')
    campovacio.classList.add('text-success')
    cerror--
  }

  const regex = /^[0-9]{1}$/gu
    
  if (regex.test(numero) === false){
    let notformat = '✖ Formato incorrecto, solo un numero.'
    invformat.innerText = notformat
    invformat.classList.add('text-danger')
    cerror++
  }else{
    let okformat = '✔  El formato es correcto.'
    invformat.innerText = okformat
    invformat.classList.remove('text-danger')
    invformat.classList.add('text-success')
    cerror--
  }

  if(cerror === 0){
    btnenviar.classList.remove('disabled')
  }else{
    btnenviar.classList.add('disabled')
  }
}
