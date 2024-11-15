document.addEventListener('DOMContentLoaded', function() {
    // Actualizar la cantidad de productos en el enlace del carrito
    function updateCartLink() {
        const cartLink = document.getElementById('cart-link');
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const totalItems = cart.reduce((total, item) => total + item.cantidad, 0);
        cartLink.textContent = `Ver Carrito (${totalItems})`;

        if (totalItems === 0) {
            cartLink.style.display = 'none'; // Ocultar el enlace si no hay productos en el carrito
        } else {
            cartLink.style.display = 'inline'; // Mostrar el enlace si hay productos en el carrito
        }
    }

    // Evento de clic para agregar productos al carrito
    document.querySelectorAll('.agregar-carrito').forEach(button => {
        button.addEventListener('click', function() {
            const imagen = this.parentElement.querySelector('img').getAttribute('src'); // Recuperar la imagen
            const precio = parseFloat(this.dataset.precio);
            const titulo = this.parentElement.querySelector('h2').innerText;

            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            const product = cart.find(item => item.titulo === titulo);

            if (product) {
                product.cantidad++;
            } else {
                cart.push({ imagen, precio, titulo, cantidad: 1 });
            }

            localStorage.setItem('cart', JSON.stringify(cart));

            // Actualizar la cantidad de productos en el enlace del carrito
            updateCartLink();

            // Redirigir a la página del carrito (opcional)
            // window.location.href = 'cart.html';
        });
    });

    // Llamar a la función para actualizar la cantidad de productos en el enlace del carrito
    updateCartLink();
});


