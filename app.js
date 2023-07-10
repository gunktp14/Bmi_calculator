var closeBtn = document.querySelector('#close-btn')

if(closeBtn){
    const modal = document.querySelector('.modal')
    closeBtn.addEventListener('click',function(){
        isActive = modal.classList.contains('active')
        if(isActive){
            modal.classList.remove('active')
            
        }else{
            modal.classList.add('active')
        }
    })
}
