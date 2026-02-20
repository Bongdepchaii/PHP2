document.getElementById('add_variant').addEventListener('click', function(event) {
    alert('click here');
})
fetch('/product/add_variant', {
    method: 'POST',
     headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({
        
    })
});