document.addEventListener('keyup', function (e){
    if (e.target.value !== '' && e.key !== 'Backspace'){
        let nextIDInt = parseInt(e.target.id) + 1
        let nextEl = document.getElementById(nextIDInt.toString())
        if (nextEl){
            nextEl.focus();
        }
    }
    if (e.key === 'Backspace'){
        let prevIDInt = parseInt(e.target.id) - 1
        let prevEl = document.getElementById(prevIDInt.toString())
        if (prevEl){
            prevEl.focus();
        }
    }
})