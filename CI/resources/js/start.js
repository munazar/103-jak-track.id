$(document).ready(function(){
    $(".link").click(function(){
        let link=$(this).data('link')
        window.open(link,'_blank')        
    })    
})